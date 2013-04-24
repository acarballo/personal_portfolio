<?php

/**
 * frontController
 * @author Andres
 *
 */
class controllers_frontController{
	
	protected $config;
	
	public function __construct($router){
		
		$route = $router->getRoute();				
		$this->config = $_SESSION['register']['config'];
		
		$controller = "controllers_".$route['controller']."Controller";
		$action = $route['action']."Action";
				
		$controller = new $controller;
		$controller->$action();		
		$controller->render();
	}

	public function __destruct(){
	}
	
}