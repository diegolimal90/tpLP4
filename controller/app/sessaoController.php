<?php
namespace controller\app;

use lib\Controller;
// use helper\Seguranca;
// use api\login\ApiLogin;
// use object\login\Login;

class sessaoController extends Controller {

	public function index(){
		header('location:/' . APP_ROOT . '/app/login');
	}
}