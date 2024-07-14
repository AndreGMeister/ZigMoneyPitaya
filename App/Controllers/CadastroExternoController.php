<?php

namespace App\Controllers;

use App\Config\ConfigPerfil;
use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\ConfigPdv;
use App\Services\SendEmail\SendEmail;
use Exception;
use System\Controller\Controller;
use System\Get\Get;
use System\HtmlComponents\SendEmailTemplate\SimpleTemplate;
use System\Post\Post;
use System\Session\Session;
class CadastroExternoController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $idEmpresa;
    protected $idUsuarioLogado;
    protected $idPerfilUsuarioLogado;

    protected $diretorioImagemUsuarioNoEnv;
    protected $diretorioImagemUsuarioPadrao;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'login';

        $this->post = new Post();
        $this->get = new Get();
        $this->idEmpresa = Session::get('idEmpresa');
        $this->idUsuarioLogado = Session::get('idUsuario');
        $this->idPerfilUsuarioLogado = session::get('idPerfil');
    }

    public function index()
    {
        $this->view('login/criarConta', $this->layout);
    }

    public function cadastrar()
    {
        $dados = (array) $this->post->data();
        
        $dadosEmpresa['nome'] = $dados['nome'];
        $dadosEmpresa['email'] = $dados['email'];
        $dadosEmpresa['id_segmento'] = 4;

        try {
            $empresa = new Empresa();
            $idEmpresa = $empresa->save($dadosEmpresa);

            # Cadastra um tipo de PDV para a Empresa
            $configPdv = new ConfigPdv();
            $idConfig = $configPdv->save([
                'id_empresa' => $idEmpresa,
                'id_tipo_pdv' => 2
            ]);

            # Cadastra um Usuário para empresa
            $usuario = new Usuario();
            $idUsuario = $usuario->save([
                'id_empresa' => $idEmpresa,
                'nome' => $dados['nome'],
                'email' => $dados['email'],
                'password' => createHash($dados['password']),
                'id_sexo' => 1,
                'status' => 1,
                'id_perfil' => ConfigPerfil::adiministrador(),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            # Simula um rollback
            if (!$idUsuario || !$idEmpresa || !$idConfig) {
                $configPdv->hardDelete($idConfig);
                $empresa->hardDelete($idEmpresa);
                Session::flash('error', 'Erro ao Cadastrar Empresa! <br> Tente novamente.');
                return $this->get->redirectTo("/criarConta/index");
            }
            
            Session::flash('success', 'Empresa cadastrada com sucesso! <br> Faça o login para acessar o sistema.');
            return $this->get->redirectTo("/login");

        } catch (Exception $e) {
            echo json_encode(['status' => false]);
        }
    }

    public function verificaSeEmailExiste($email)
    {
        $email = out64($email);
        $empresa = new Empresa();

        if ($empresa->verificaSeEmailExiste($email)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }
}
