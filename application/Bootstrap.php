<?php

/**
 * Bootstrap
 * @author Andres
 *
 */
class Bootstrap{
	
	private $configPath;
	private $env;
	private $route;
	
	public function __construct($configPath, $env){	
		
		$this->configPath=$configPath;
		$this->env=$env;
		
		$this->startRegister();
		$this->readConfig();
		$this->route=$this->router($this->configPath);
		$this->route=$this->acl($this->route);
		
		return $this->route;
	}
	
	/**
	 * startRegister
	 * Initialice session
	 */
	protected function startRegister(){
			
		session_start();
		$_SESSION['register']=array();
		//$_SESSION['app']=array();
		if(!isset($_SESSION['app'])){
			$_SESSION['app']['user']='guest';
			$_SESSION['app']['rol']=3;
			$_SESSION['app']['title']='Personal Portfolio';
			$_SESSION['app']['version']="1.0.3b";
		}
	}
	
	/**
	 * readConfig
	 * Load config file in session
	 */
	protected function readConfig(){
		
		$configHeper = new controllers_helpers_config($this->configPath);
		$config = $configHeper->readConfig($this->env);
		$_SESSION['register']['config']=$config;	
	}
	
	/**
	 * router
	 * @return unknown
	 */
	protected function router(){
		
		//Initialice array controllers/actions
		$controllerActions=array(
				'index'=>array('index'),
				'contact'=>array('index'),
				'comingsoon'=>array('index')
		);
		$parse=explode('/',$_SERVER['REQUEST_URI']);
		
		//Read route controller/action from URI
		$route['controller']=(isset($parse[1])&&$parse[1]!=NULL)?$parse[1]:'index';
		$route['action']=(isset($parse[2])&&$parse[2]!=NULL)?$parse[2]:'index';
		
		//Read application info
		if(count($parse)>3){
			for($i=3;$i<sizeof($parse);$i+=2)
			{
				$_REQUEST[$parse[$i]]=$parse[$i+1];
			}
		}
		
		if(!array_key_exists($route['controller'], $controllerActions))
		{
			$route['controller']='error';
			$route['action']=NO_CONTROLLER;
		} 
		else if(!in_array($route['action'],$controllerActions[$route['controller']]))
		{
				$route['controller']='error';
				$route['action']=NO_ACTION;
		}
		
		$this->route=$route;
		return $route;
	}
	
	/**
	 * acl access control list
	 * @return Ambigous <unknown, unknown>
	 */
	protected function acl(){
		
		$route=$this->route;
		
		//1 admin
		//2 user
		//3	guest
		
		$rol=$_SESSION['app']['rol'];
		
		$permissions=array();
		$permissions['index']['index']=3;
		$permissions['contact']['index']=3;
		$permissions['comingsoon']['index']=3;
		
		if(isset($permissions[$route['controller']][$route['action']])){
			$minRol=$permissions[$route['controller']][$route['action']];
			if($rol>$minRol){
				$route['controller']='index';
				$route['action']='index';
			}
		}

		//FIXME Way to configurate cominssoon as page
		//$route['controller']='comingsoon';
		//$route['action']='index';
		$this->route=$route;
		return $this->route;
		
	}
	
	/**
	 * @return the $route
	 */
	public function getRoute() {
		return $this->route;
	}	
	
}