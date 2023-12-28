<?php

namespace App\Models;

use System\Model\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function seDadoNaoPertenceAEmpresaEditado($nomeDoCampo, $valor, $idEmpresa)
    {
        $dadoEmpresa = $this->findBy("{$nomeDoCampo}", $valor);
        if ($dadoEmpresa && $idEmpresa != $dadoEmpresa->id) {
            return true;
        }

        return false;
    }

    public function verificaSeEmailExiste($email)
    {
        if (!$email) {
            return false;
        }

        $query = $this->query("SELECT * FROM empresas WHERE email = '{$email}'");
        if (count($query) > 0) {
            return true;
        }

        return false;
    }

    public function selecionaEmpresa($idEmpresa)
    {
        return $this->query("SELECT
        empresas.nome AS nomeEmpresa,
        empresas.email AS email,
        empresas.telefone AS telefone,
        clientes_segmentos.descricao AS nomeSegmento
        FROM empresas
        INNER JOIN clientes_segmentos ON empresas.id_segmento = clientes_segmentos.id
        WHERE empresas.id = {$idEmpresa}")[0];
    }
}
