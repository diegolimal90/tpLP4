<?php
namespace controller\app;

use lib\Controller;
use helper\Seguranca;
use api\contato\ApiContato;
use object\contato\Contato;

class contatoController extends Controller {
	
	public function __construct(){
        parent::__construct();

        new Seguranca();
	}
	
	public function index(){
		$api = new ApiContato();

		$this->dados = array(
			"list" => $api->getList()
		);

		$this->view();
	}

	public function cadContato(){
		$contato = new Contato();
		$contato->id = $this->getParams(0);

		$api = new ApiContato();
		$api->get($contato);

		$this->dados = array(
			"dados" => $contato
		);
		$this->view();
	}

	public function cadLote(){
		$this->view();
	}

	public function novo(){
		$api = new ApiContato();
		//TODO arrumar essa merda
		$api->save(new Contato('POST'));
		header('location/' . APP_ROOT . '/app/contato');
	}

	public function listar(){
		$this->view();
	}

	public function saveLote(){
		$api = new ApiContato();

		if($api->saveLote()){
			header('location/' . APP_ROOT . '/app/contato');
		}else{
			header('location/' . APP_ROOT . '/app/contato/cadLote');
		}
	}

	public function ver(){
		$contato = new Contato();
		$contato->id = $this->getParams(0);

		$api = new ApiContato();
		$api->get($contato);

		$this->dados = array(
			"dados" => $contato
		);
		$this->view();
	}

	public function delete(){
		$contato = new Contato();
		$contato->id = $this->getParams(0);
		$api = new ApiContato();
		//TODO arrumar essa merda
		print_r($api->deletar($contato));
	}
}