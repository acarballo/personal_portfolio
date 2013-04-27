<?php

/**
 * errorController
 * @author Andres
 *
 */
class controllers_errorController implements controllers_interfaceController{

	protected $content;

	public function __construct()
	{
	}

	public function indexAction()
	{
	}

	public function no_controllerAction()
	{
		//$render = new controllers_helpers_render();
		//$this->content = $render->renderView('index/index.php');
		$this->content = 'no_controllerAction';
	}
	
	public function no_actionAction()
	{
		$this->content = 'no_actionAction';
	}
	
	public function errorAction()
	{
	}
	
	public function debugAction()
	{
	}
	
	public function render()
	{
		$layoutVars=array('content'=>$this->content,
				'title'=>"Mi aplicacion");
		$render = new controllers_helpers_render();
		$layout = $render->renderlayout('layout.phtml',$layoutVars);

		echo $layout;
	}
	
}