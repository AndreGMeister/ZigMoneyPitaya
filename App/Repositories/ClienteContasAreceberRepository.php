<?php

namespace App\Repositories;

use App\Models\Venda;
use App\Models\Cliente;

class ClienteContasAreceberRepository
{
    protected $venda;
    protected $cliente;

    public function __construct()
    {
        $this->venda = new Venda();
        $this->cliente = new Cliente();
    }

    public function totalVendasAprazo($idEmpresa)
    {
        $query = $this->venda->query(
            "SELECT SUM(vendas.valor) AS valor, clientes.id, clientes.nome AS nome FROM vendas
            INNER JOIN clientes ON vendas.id_cliente = clientes.id
            WHERE vendas.id_empresa = {$idEmpresa} AND
            vendas.id_meio_pagamento = 6 AND vendas.deleted_at IS NULL
            GROUP BY vendas.id_cliente;"
        );

        return $query;
    }

    public function vendasAprazoPorCliente($idCliente, $idEmpresa)
    {
        $query = $this->venda->query(
            "SELECT SUM(vendas.valor) AS valor, clientes.id, clientes.nome AS nome FROM vendas
            INNER JOIN clientes ON vendas.id_cliente = clientes.id
            WHERE vendas.id_empresa = {$idEmpresa} AND
            vendas.id_meio_pagamento = 6 AND vendas.deleted_at IS NULL
            GROUP BY vendas.id_cliente;"
        );

        return $query;
    }
}