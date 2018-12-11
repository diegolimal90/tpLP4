<?php
namespace controller\app;

use lib\Controller;
use helper\Seguranca;
use api\login\ApiLogin;
use object\login\Login;

class loginController extends Controller {
    
    public function __construct(){
        parent::__construct();

        // new Seguranca();
    }

	public function index(){
		$this->view();
	}

	public function logar(){
        $login = new Login();
        $login->user = $_POST['user'];
        $login->password = $_POST['password'];

        $api = new ApiLogin();
        $retorno = $api->get($login);

        if(is_object($retorno)){
            $_SESSION['LOGADO'] = "TRUE";
            header('location:/' . APP_ROOT . '/app/contato');
        }else{
            header('location:/' . APP_ROOT . '/app/login');
        }
    }

    public function sair(){
        unset($_SESSION['LOGADO']);
        header('location:/' . APP_ROOT . '/app/sessao');
	}
}