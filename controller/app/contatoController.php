<?php
namespace controller\app;

use lib\Controller;

class contatoController extends Controller {
	
	public function novo(){
		$this->view();
	}

	public function listar(){
		$this->view();
	}

	public function create(){
		var_dump($_POST);
	}

	public function find(){
		echo "rota busca";
	}

	public function update(){
		echo "rota atualização";
	}

	public function delete(){
		echo "rota deleção";
	}
}