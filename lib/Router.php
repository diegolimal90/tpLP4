<?php

namespace lib;

class Router{
	
	protected $routers = array(
		'' => 'home',
		'app' => 'app',
		'contato' => 'app'
	);
	
	private $urlBase = APP_ROOT;
	
	protected $routerOnRaiz = 'app';
	
	protected $onRaiz = true;
}