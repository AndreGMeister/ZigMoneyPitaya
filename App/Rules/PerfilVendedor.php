<?php
namespace App\Rules;

use App\Config\ConfigPerfil;
use System\Get\Get;
use System\Session\Session;

class PerfilVendedor
{
    protected $get;

    public function __construct()
    {
        $this->get = new Get();
    }
    
    /**
     * Se o perfil do usuário logado for vendedor, redireciona para a rota pdvDiferencial
     */
    public function notAllowed()
    {
        if (Session::get('idPerfil') == ConfigPerfil::vendedor()) {
            return $this->get->redirectTo("pdvDiferencial");
        }
    }
}