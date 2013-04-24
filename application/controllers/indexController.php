<?php

class controllers_indexController implements controllers_interfaceController{

	protected $content;

	public function __construct()
	{
	}

	public function indexAction()
	{
		$gateIndex= new models_index_index();
		$numQuest=$gateIndex->numQuestions();
		
		$viewVars=array('title'=>"index",
				'numQuest'=>$numQuest);
		$render = new controllers_helpers_render();
		$this->content = $render->renderView('index/index.phtml',$viewVars);
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