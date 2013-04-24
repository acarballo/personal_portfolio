<?php

class controllers_comingsoonController implements controllers_interfaceController{

	protected $content;

	public function __construct()
	{
	}

	public function indexAction()
	{
		$viewVars=array('title'=>"index");
		$render = new controllers_helpers_render();
		$this->content = $render->renderView('comingsoon/index.phtml',$viewVars);
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