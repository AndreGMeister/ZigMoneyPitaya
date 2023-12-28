<?php

namespace App\Models;

use System\Model\Model;

class Venda extends Model
{
    protected $table = 'vendas';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function seJaExisteCodigoDeVenda($codigo, $idEmpresa)
    {
        $query = $this->query("SELECT * FROM vendas WHERE codigo_venda = '{$codigo}' AND id_empresa = {$idEmpresa}");
        if (count($query) > 0) {
            return true;
        }

        return false;
    }

    public function ultimasVendasRealizadas($idEmpresa, $quantidade)
    {
        return $this->query(
            "SELECT vendas.id AS idVenda, usuarios.nome AS nomeUsuario, codigo_venda,
            id_meio_pagamento, legenda as meioPagamento,
            vendas.quantidade_parcela, vendas.valor_parcela, vendas.id_meio_pagamento,
            SUM(valor) AS total, valor_recebido, DATE_FORMAT(vendas.created_at,'%d/%m %h:%m') AS data,
            valor_recebido - SUM(valor) AS troco FROM vendas
            INNER JOIN meios_pagamentos ON vendas.id_meio_pagamento = meios_pagamentos.id
            INNER JOIN usuarios ON vendas.id_usuario = usuarios.id
            WHERE vendas.id_empresa = {$idEmpresa}
            AND vendas.deleted_at IS NULL
            AND DATE_FORMAT(vendas.created_at, '%Y-%m-%d') = CURRENT_DATE
            GROUP BY codigo_venda
            ORDER BY vendas.id DESC LIMIT {$quantidade}"
        );
    }

    /**
     * Retorna todas as vendas agrupadas por codigo da venda
     * @param  int $idVenda
     * @return array
     */
    public function vendasAgrupadasPorCodigoDaVenda($idVenda)
    {
        $venda = $this->find($idVenda);
        $codigoVenda = $venda->codigo_venda;

        return $this->query(
            "SELECT vendas.id,
             vendas.quantidade AS quantidadeVendida,
             vendas.preco,
             vendas.valor,
             vendas.valor_recebido,
             vendas.troco,
             vendas.quantidade_parcela,
             vendas.valor_parcela,
             clientes.nome AS nomeCliente,
             clientes.cpf,
             clientes.cnpj,
             clientes.id_cliente_tipo,
             DATE_FORMAT(vendas.created_at,'%d/%m/%Y %h:%m') AS data,
             produtos.nome,
             meios_pagamentos.legenda AS meioPagamento,
             meios_pagamentos.id AS idMeioPagamento
             FROM vendas
             INNER JOIN produtos ON vendas.id_produto = produtos.id
             INNER JOIN meios_pagamentos ON vendas.id_meio_pagamento = meios_pagamentos.id
             LEFT JOIN clientes ON vendas.id_cliente = clientes.id
             WHERE vendas.codigo_venda = '{$codigoVenda}'"
        );
    }
}
