<?php
namespace App\Controllers;

use App\Models\Produto;
use App\Rules\Logged;
use App\Services\UploadService\UploadFiles;
use Exception;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class ProdutoController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $idEmpresa;
    protected $diretorioImagemProdutoPadrao = 'produtos';

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'default';
        $this->post = new Post();
        $this->get = new Get();
        $this->idEmpresa = Session::get('idEmpresa');

        $logged = new Logged();
        $logged->isValid();
    }

    public function index()
    {
        $produto = new Produto();
        $informacoes = $produto->informacaoesGeraisDosProdutos($this->idEmpresa);

        $this->view('produto/index', $this->layout,compact('informacoes'));
    }

    public function save()
    {
        $produto = new Produto();
        $dados = (array) $this->post->data();

        $dados['id_empresa'] = $this->idEmpresa;
        $dados['preco'] = formataValorMoedaParaGravacao($dados['preco']);
        #$dados['preco_custo'] = formataValorMoedaParaGravacao($dados['preco_custo']);
        
        $dados['mostrar_em_vendas'] = 0;
        if (isset($dados['mostrar_em_vendas'])) {
            $dados['mostrar_em_vendas'] = 1;
        } 

        if (isset($dados['ativar_quantidade']) && $dados['ativar_quantidade'] == 'on') {
            $dados['ativar_quantidade'] = 1;
        } else {
            $dados['ativar_quantidade'] = 0;
        }
        
        if (isset($dados['em_desconto']) && $dados['em_desconto'] == 'on') {
            $dados['em_desconto'] = 1;
            $dados['valor_desconto'] = isset($this->post->data()->valor_desconto) ? formataValorMoedaParaGravacao($this->post->data()->valor_desconto) : null;

            if (isset($this->post->data()->data_inicio_desconto)) {
                $dados['data_inicio_desconto'] = dateFormat($this->post->data()->data_inicio_desconto) . ' 00:00:00';
            }
            
            if (isset($this->post->data()->data_fim_desconto)) {
                $dados['data_fim_desconto'] = dateFormat($this->post->data()->data_fim_desconto) . ' 23:59:59';
            }
        } 
        
        # Valida imagem somente se existir no envio
        if (!empty($_FILES["imagem"]['name'])) {
            $retornoImagem = uploadImageHelper(
                new UploadFiles(),
                imageDirectory($this->diretorioImagemProdutoPadrao),
                $_FILES["imagem"]
            );

            # Verifica de houve erro durante o upload de imagem
            if (is_array($retornoImagem)) {
                Session::flash('error', $retornoImagem['error']);
                return $this->get->redirectTo("produto");
            }
        }

        $dados['imagem'] = $retornoImagem ?? null;


        //dd($dados);
        try {
            $idProduto = $produto->save($dados);
     

            # adiciona codigo de barras se nao existir
            if (empty($dados['codigo'])) {
                $codigoDeBarras = generateRandomCodigoDeBarras($idProduto);
                $produto = new Produto();
                $produto->update(['codigo' => $codigoDeBarras], $idProduto);
            }

            $produto = $produto->getBy($this->idEmpresa, $idProduto);

            return $this->get->redirectTo("produto");

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function update()
    {
        $produto = new Produto();
        $dadosProduto = $produto->find($this->post->data()->id);

        $dados = (array)$this->post->only([
            'nome', 'preco', 'unidade', 'descricao'
        ]);

        if (isset($dados['descricao'])) {
            $dados['descricao'] = nl2br($dados['descricao']);
        }

        if (isset($this->post->data()->mostrar_em_vendas)) {
            $dados['mostrar_em_vendas'] = 1;
        } else {
            $dados['mostrar_em_vendas'] = 0;
        }

        $dados['em_desconto'] = isset($this->post->data()->em_desconto) ? 1 : 0;

        # Trata quantidade
        $dados['ativar_quantidade'] = isset($this->post->data()->ativar_quantidade) ? 1 : 0;
        $dados['quantidade'] = isset($this->post->data()->quantidade) ? $this->post->data()->quantidade : $dadosProduto->quantidade;

        $dados['preco'] = formataValorMoedaParaGravacao($dados['preco']);
        #$dados['preco_custo'] = formataValorMoedaParaGravacao($dados['preco_custo']);

        $dados['valor_desconto'] = isset($this->post->data()->valor_desconto) ? formataValorMoedaParaGravacao($this->post->data()->valor_desconto) : $dadosProduto->valor_desconto;
        if (isset($this->post->data()->data_inicio_desconto)) {
            $dados['data_inicio_desconto'] = dateFormat($this->post->data()->data_inicio_desconto) . ' 00:00:00';
        }
        
        if (isset($this->post->data()->data_fim_desconto)) {
            $dados['data_fim_desconto'] = dateFormat($this->post->data()->data_fim_desconto) . ' 23:59:59';
        }

        if (!empty($_FILES["imagem"]['name'])) {
            if (!is_null($dadosProduto->imagem) && file_exists($dadosProduto->imagem)) {
                # Deleta a imagem anterior
                unlink($dadosProduto->imagem);
            }
     
            $retornoImagem = uploadImageHelper(
                new UploadFiles(),
                imageDirectory($this->diretorioImagemProdutoPadrao),
                $_FILES["imagem"]
            );
            
            # Verifica de houve erro durante o upload de imagem
            if (is_array($retornoImagem)) {
                Session::flash('error', $retornoImagem['error']);
                return $this->get->redirectTo("produto");
            }

            $dados['imagem'] = $retornoImagem;
        }
       
        try {
            $produto->update($dados, $dadosProduto->id);
            return $this->get->redirectTo("produto");

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function modalFormulario($idProduto)
    {
        $produto = false;

        if ($idProduto) {
            $produto = new Produto();
            $produto = $produto->find($idProduto);
        }
        
        $unidades = (new Produto())->unidades();
        $this->view('produto/formulario', null, compact('produto', 'unidades'));
    }

    public function pesquisarProdutoPorNome($nome = false)
    {
        $nome = mb_convert_encoding(out64($nome), 'UTF-8');

        $produto = new Produto();
        $produtos = $produto->produtos($this->idEmpresa, $nome);

        $this->view('produto/produtos', null, compact('produtos','nome'));
    }

    public function pesquisarProdutoPorCodigoDeBarras(string $codigo = null)
    {
        $codigo = $codigo ? mb_convert_encoding(out64($codigo), 'UTF-8') : null;

        $produto = new Produto();
        $produtos = $produto->getBy($this->idEmpresa, 'codigo', $codigo);

        $nome = null;

        $this->view('produto/produtos', null, compact('produtos','nome','codigo'));
    }

    public function excluirProduto($idProduto)
    {
        $produto = new Produto();
        try {
            $produto->update(['deleted_at' => timestamp()], $idProduto);
            echo json_encode(['deletado' => true]);

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function testing()
    {
        $produto = new Produto();
        $produtos = $produto->produtos(1);

        foreach ($produtos as $key => $_produto) {
            $base64Image = explode(',', $_produto->imagem)[1];
            $imagemDecodificada = base64_decode($base64Image);

            // Salvar a imagem como um arquivo JPEG
            $caminhoArquivo = 'public/produtos/imagem_' . $_produto->id . '.jpeg';
            
            $produto = new Produto();
            $produto->update(['url_imagem' => $caminhoArquivo], $_produto->id);

            file_put_contents($caminhoArquivo, $imagemDecodificada);
        }
    }
}
