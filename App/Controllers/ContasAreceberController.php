<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Models\ClienteSegmento;
use App\Models\ClienteTipo;
use App\Repositories\ClienteContasAreceberRepository;
use App\Rules\Logged;
use Exception;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class ContasAreceberController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $idEmpresa;
    protected $idUsuario;
    protected $idPerfilUsuarioLogado;
    protected $clienteContasAreceberRepository;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'default';

        $this->post = new Post();
        $this->get = new Get();
        $this->idEmpresa = Session::get('idEmpresa');
        $this->idUsuario = Session::get('idUsuario');
        $this->idPerfilUsuarioLogado = Session::get('idPerfil');

        $this->clienteContasAreceberRepository = new ClienteContasAreceberRepository();

        $logged = new Logged();
        $logged->isValid();
    }

    public function index()
    {
        $cliente = new Cliente();
        $clientes = $this->clienteContasAreceberRepository->totalVendasAprazo($this->idEmpresa);

        $this->view('contasAreceber/index', $this->layout, compact("clientes"));
    }

    public function cliente($idCliente)
    {
        $cliente = new Cliente();
        $cliente = $cliente->find($idCliente);

        $this->view('contasAreceber/contasPorClientes', $this->layout, compact("cliente"));
    }

    public function modalDividas($idCliente)
    {
        $cliente = new Cliente();
        $cliente = $cliente->find($idCliente);

        $this->view('contasAreceber/modalDividas', null, compact("cliente"));
    }
}