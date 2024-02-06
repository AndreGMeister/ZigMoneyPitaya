<?php

namespace App\Repositories;

use App\Models\Venda;
use App\Models\Cliente;

class RelatorioVendaClienteRepository
{
    protected $venda;
    protected $cliente;

    public function __construct()
    {
        $this->venda = new Venda();
        $this->cliente = new Cliente();
    }
    
    /**
     * Retorna o total vendido até o momento
     * 
     * @param int $idCliente
     * @return float
     */
    public function totalVendidoAteOMomento($idCliente)
    {
        $query = $this->venda->query(
            "SELECT SUM(valor) AS totalVendas FROM vendas WHERE id_cliente = {$idCliente} AND vendas.deleted_at IS NULL"
        );

        return $query[0]->totalVendas;
    }

    public function valorDeVendasPorMesNoAno($idEmpresa, $idcliente, $ano)
    {
        $query = $this->venda->query(
            "SELECT SUM(valor) AS valor, month(created_at) AS data FROM vendas WHERE id_empresa = {$idEmpresa}
            AND id_cliente = {$idcliente} AND YEAR(created_at) = '{$ano}' AND vendas.deleted_at IS NULL
            GROUP BY month(created_at)"
        );

        dd($query[0]);

        return $query[0];
    }
}