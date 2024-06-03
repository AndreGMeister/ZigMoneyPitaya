<?php

namespace App\Models;

use System\Model\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function unidades()
    {
        return [
            'unidade' => 'Unidade',
            'caixa' => 'Caixa',
            //'kg' => 'Quilograma (kg)',
        ];
    }

    public function produtos($idEmpresa, $nome = false, $mostrarEmVendas = 1)
    {
        $querypesquisaPorNome = false;
        if ($nome) {
            $querypesquisaPorNome = "AND nome LIKE '%{$nome}%'";
        }

        return $this->query(
            "SELECT * FROM produtos WHERE id_empresa = {$idEmpresa}
            AND deleted_at IS NULL {$querypesquisaPorNome}"
        );
    }

    # Seleciona os produtos ordenando pelos mais vendidos
    public function produtosNoPdv($idEmpresa, $nome = false)
    {
        $querypesquisaPorNome = false;

        if ($nome) {
            $querypesquisaPorNome = "AND nome LIKE '%{$nome}%'";
        }

        return $this->query(
            "SELECT p.*, 
                    COUNT(v.id_produto) as total_vendas,
                    CASE 
                        WHEN p.valor_desconto IS NOT NULL 
                             AND p.data_inicio_desconto <= NOW() 
                             AND p.data_fim_desconto >= NOW() 
                        THEN 1 
                        ELSE 0 
                    END as desconto_ativo
             FROM produtos p
             LEFT JOIN vendas v ON p.id = v.id_produto
             WHERE p.id_empresa = {$idEmpresa}
               AND p.deleted_at IS NULL
               AND p.mostrar_em_vendas = 1
               {$querypesquisaPorNome}
             GROUP BY p.id
             ORDER BY total_vendas DESC"
        );
        
        /*"SELECT * FROM produtos WHERE id_empresa = {$idEmpresa}
        AND deleted_at IS NULL AND mostrar_em_vendas = 1 {$querypesquisaPorNome}"*/
    }

    public function produtosNoPdvFiltrarPorCodigoDeBarra($idEmpresa, $codigo = false)
    {
        $querypesquisaPorCodigo = false;

        if ($codigo) {
            $querypesquisaPorCodigo = "AND codigo LIKE '%{$codigo}%'";
        }

        return $this->query(
            "SELECT * FROM produtos WHERE id_empresa = {$idEmpresa}
            AND deleted_at IS NULL AND mostrar_em_vendas = 1 {$querypesquisaPorCodigo}"
        );
    }

    public function getBy(int $idEmpresa, string $column = null, $value = null)
    {
        $sql = "SELECT * FROM produtos WHERE id_empresa = :id_empresa";
        $data = [':id_empresa' => $idEmpresa];
        if ($column !== null && $value !== null) {
            $sql .= " AND $column = :$column";
            $column = ':' . $column;
            $data[$column] = $value;
        }
        $sql .= ' AND deleted_at IS NULL;';
        return $this->prepare($sql, $data);
    }

    public function quantidadeDeProdutosCadastrados($idEmpresa)
    {
        $ativos = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM produtos WHERE id_empresa = {$idEmpresa} AND deleted_at IS NULL
        ");

        $inativos = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM produtos WHERE id_empresa = {$idEmpresa} AND deleted_at IS NOT NULL
        ");

        return (object)[
            'ativos' => $ativos->quantidade,
            'inativos' => $inativos->quantidade
        ];
    }

    public function valorInvestidoEmCompraDeProdutos($idEmpresa)
    {
        return $this->query(
            "SELECT SUM(preco_compra) AS valorInvestido FROM produtos
            WHERE id_empresa = {$idEmpresa}
            AND deleted_at IS NULL"
        )[0];
    }

    public function lucroAtual($idEmpresa)
    {
        return $this->queryGetOne(
            "SELECT SUM(valor) AS lucro FROM vendas WHERE id_empresa = {$idEmpresa} AND deleted_at IS NULL"
        )->lucro;
    }

    public function informacaoesGeraisDosProdutos($idEmpresa)
    {
        return $this->query(
            "SELECT MAX(preco) AS maisCaro, MIN(preco) AS maisBarato
            FROM produtos WHERE id_empresa = {$idEmpresa} AND deleted_at IS NULL"
        )[0];
    }

    public function decrementaQuantidadeProduto(int $idProduto, int $quantidadeVendida)
    {
        $produto = $this->find($idProduto);
        if ($quantidadeVendida <= $produto->quantidade) {
            $quantidadeDecrementada = $produto->quantidade - $quantidadeVendida;
            $this->update(['quantidade' => $quantidadeDecrementada], $idProduto);
        }
    }
    
    /**
     * Verifica se o produto está com desconto
     */
    public function descontoEstadentroDoPeriodo($dataInicioDesconto, $dataFimDesconto)
    {
        $dataAtual = date('Y-m-d H:i:s');
        return ($dataAtual >= $dataInicioDesconto && $dataAtual <= $dataFimDesconto);
    }
}
