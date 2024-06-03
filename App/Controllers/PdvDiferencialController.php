<?php

namespace App\Controllers;

use App\Models\MeioPagamento;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Empresa;
use App\Models\Cliente;
use App\Repositories\VendasEmSessaoRepository;
use App\Rules\AcessoAoTipoDePdv;
use App\Rules\Logged;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class PdvDiferencialController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $idEmpresa;
    protected $idUsuario;
    protected $idPerfilUsuarioLogado;
    protected $vendasEmSessaoRepository;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'default';

        $this->post = new Post();
        $this->get = new Get();
        $this->idEmpresa = Session::get('idEmpresa');
        $this->idUsuario = Session::get('idUsuario');
        $this->idPerfilUsuarioLogado = Session::get('idPerfil');

        $this->vendasEmSessaoRepository = new VendasEmSessaoRepository();

        $logged = new Logged();
        $logged->isValid();

        $acessoAoTipoDePdv = new AcessoAoTipoDePdv();
        $acessoAoTipoDePdv->validate();
    }

    public function index()
    {
        $meioPagamento = new MeioPagamento();
        $meiosPagamentos = $meioPagamento->all();

        $produto = new Produto();
        $produtos = $produto->produtosNoPdv($this->idEmpresa);

        $this->view('pdv/diferencial', $this->layout,
            compact(
                'meiosPagamentos',
                'produtos'
            ));
    }

    public function saveVendasViaSession()
    {
        if (!isset($_SESSION['venda']) ||empty($_SESSION['venda'])) {
            return;
        }

        $status = false;
        $meioDePagamento = $this->post->data()->id_meio_pagamento;
        $dataCompensacao = '0000-00-00';

        # só adiciona caso seja um boleto
        if ($meioDePagamento == 4) {
            $dataCompensacao = $this->post->data()->data_compensacao;
        }

        # Opcao de cartao de credito parcelado
        $parcelas = !is_null($this->post->data()->quantidade_parcela) ? $this->post->data()->quantidade_parcela : 0;
        $valorParcela = 0;
        if ($meioDePagamento == 2) {
            $totalVenda = (double) json_decode(
                $this->vendasEmSessaoRepository
                ->obterValorTotalDosProdutosNaMesa()
            )->total;

            $valorParcela = $totalVenda / $parcelas;
        }

        /**
         * Gera um código unico de venda que será usado em todos os registros desse Loop
        */
        $codigoVenda = uniqid(rand(), true).date('s').date('d.m.Y');

        $valorRecebido = formataValorMoedaParaGravacao($this->post->data()->valor_recebido);
        $troco = formataValorMoedaParaGravacao($this->post->data()->troco);

        foreach ($_SESSION['venda'] as $produto) {
            $modelProduto = new Produto();
            $dadoProduto = $modelProduto->find($produto['id']);
            
            # Verifica se o produto tem desconto e se está dentro do periodo de desconto
            $descontoEstadentroDoPeriodo = $modelProduto->descontoEstadentroDoPeriodo(
                $dadoProduto->data_inicio_desconto, 
                $dadoProduto->data_fim_desconto
            );
            
            # Se o produto tiver desconto e estiver dentro do periodo de desconto
            if (!is_null($dadoProduto->valor_desconto) && $descontoEstadentroDoPeriodo) {
                $produto['preco'] = $dadoProduto->preco - $dadoProduto->valor_desconto;
            }

            $dados = [
                'id_usuario' => $this->idUsuario,
                'data_compensacao' => $dataCompensacao,
                'id_empresa' => $this->idEmpresa,
                'id_produto' => $produto['id'],
                'preco' => $produto['preco'],
                'quantidade' => $produto['quantidade'],
                'valor' => $produto['total'],
                'codigo_venda' => $codigoVenda,
                'id_meio_pagamento' => $this->post->data()->id_meio_pagamento,
                'quantidade_parcela' => $parcelas,
                'valor_parcela' => $valorParcela,
                'valor_desconto' => $dadoProduto->valor_desconto,
            ];

            if (isset($_SESSION['cliente']['id_cliente'])) {
                $dados['id_cliente'] = $_SESSION['cliente']['id_cliente'];
            }

            if ( ! empty($valorRecebido) && ! empty($troco)) {
                $dados['valor_recebido'] = $valorRecebido;
                $dados['troco'] = $troco;
            }

            $venda = new Venda();
            try {
                $venda = $venda->save($dados);
                $status = true;

                $produto = new Produto();
                $produto->decrementaQuantidadeProduto((int) $dados['id_produto'], (int) $dados['quantidade']);

                unset($_SESSION['venda']);
                unset($_SESSION['cliente']);

            } catch (\Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
                return false;
            }
        }

        echo json_encode(['status' => $status, 'idVenda' => $venda]);
    }

    public function colocarProdutosNaMesa($idProduto)
    {
        return $this->vendasEmSessaoRepository->colocarProdutosNaMesa($idProduto);
    }

    public function obterProdutosDaMesa($posicaoProduto)
    {
        echo $this->vendasEmSessaoRepository->obterProdutosDaMesa($posicaoProduto);
    }

    public function alterarAquantidadeDeUmProdutoNaMesa($idProduto, $quantidade)
    {
        $produto = new Produto();
        $dadosProduto = $produto->find($idProduto);

        if ($dadosProduto->ativar_quantidade && $quantidade > $dadosProduto->quantidade) {
            echo json_encode(['quantidade_insuficiente' => true, 'unidades' => $dadosProduto->quantidade]);
            return false;
        }

        $this->vendasEmSessaoRepository->alterarAquantidadeDeUmProdutoNaMesa($idProduto, $quantidade);
        echo json_encode(['quantidade_insuficiente' => false]);
    }

    public function retirarProdutoDaMesa($idProduto)
    {
        $this->vendasEmSessaoRepository->retirarProdutoDaMesa($idProduto);
    }

    public function obterValorTotalDosProdutosNaMesa()
    {
        echo $this->vendasEmSessaoRepository->obterValorTotalDosProdutosNaMesa();
    }

    public function calcularTroco($valorRecebido)
    {
        $valorRecebido = out64($valorRecebido);
        $valorRecebido = explode('R$', $valorRecebido);
        if (array_key_exists(1, $valorRecebido)) {
            $valor = $valorRecebido[1];
        } else {
            $valor = $valorRecebido[0];
        }

        echo $this->vendasEmSessaoRepository->calcularTroco(formataValorMoedaParaGravacao($valor));
    }

    public function parcelamentoDeCartao()
    {
        if (!isset($_SESSION['venda']) || empty($_SESSION['venda'])) {
            return;
        }

        echo $this->vendasEmSessaoRepository->parcelamentoDeCartao();
    }

    public function pesquisarProdutoPorNome($nome = false)
    {
        $nome = mb_convert_encoding(out64($nome), 'UTF-8');

        $produto = new Produto();
        $produtos = $produto->produtosNoPdv($this->idEmpresa, $nome);

        $this->view('pdv/produtosAvenda', null, compact('produtos'));
    }

    public function pesquisarProdutoPorCodeDeBarra($codigo = false)
    {
        $codigo = mb_convert_encoding(out64($codigo), 'UTF-8');

        $produto = new Produto();
        $produtos = $produto->produtosNoPdvFiltrarPorCodigoDeBarra($this->idEmpresa, $codigo);

        $this->view('pdv/produtosAvenda', null, compact('produtos'));
    }

    public function ultimasVendasRealizadas($quantidade)
    {
        $venda = new Venda();
        $vendas = $venda->ultimasVendasRealizadas($this->idEmpresa, $quantidade);
        echo json_encode($vendas);
    }

    public function gerarCupomFiscal($idVenda)
    {
        $venda = new Venda();
        $empresa = new Empresa();

        $dadosDaEmpresa = $empresa->selecionaEmpresa($this->idEmpresa);
        $dadosDaVenda = $venda->vendasAgrupadasPorCodigoDaVenda($idVenda);

        $this->view('pdv/cupomFiscal', null, compact('dadosDaEmpresa', 'dadosDaVenda'));
    }

    /**
     * @param $idCliente
     */
    public function associarClienteAVenda($idCliente)
    {
        $this->vendasEmSessaoRepository->associarClienteAVenda($idCliente);
        echo json_encode(['cliente_id' => $idCliente]);
    }

    /**
     * @param $idCliente
     */
    public function desassociarClienteAVenda($idCliente)
    {
        try {
            $this->vendasEmSessaoRepository->desassociarClienteAVenda($idCliente);
            echo json_encode(['status' => true]);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @return bool
     */
    public function jaExisteClienteAssociado()
    {
        if (isset($_SESSION['cliente']['id_cliente'])) {
            $cliente = new Cliente();
            $cliente = $cliente->find($_SESSION['cliente']['id_cliente']);

            echo json_encode([
                'status' => true,
                'cliente_tipo' => $cliente->id_cliente_tipo,
                'cpf' => ($cliente->id_cliente_tipo == 1) ? $cliente->cpf : false,
                'cnpj' => ($cliente->id_cliente_tipo == 2) ? $cliente->cnpj : false,
            ]);

            return false;
        }

        echo json_encode(['status' => false]);
    }
}
