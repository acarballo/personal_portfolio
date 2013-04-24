<?php

/**
 * helpers_render
 * @author Andres
 *
 */
class controllers_helpers_render{
	
	protected $config;
	protected $title;
	protected $version;
	protected $user;
	protected $rol;
	
	public function __construct()
	{	
		$this->config=$_SESSION['register']['config'];
		$this->title=$_SESSION['app']['title'];
		$this->user=$_SESSION['app']['user'];
		$this->rol=$_SESSION['app']['rol'];
		$this->version=$_SESSION['app']['version'];
	}

	/**
	 * Render view
	 * @param unknown $view
	 * @param string $viewVars
	 * @return string
	 */
	function renderView($view, array $viewVars=null)
	{	
		ob_start();
		include_once($this->config['views.path']."/".$view);
	
		$content=ob_get_clean();
		ob_end_flush();
	
		return $content;
	}
	
	/**
	 *
	 * @param unknown $config
	 * @param string $layout
	 * @param array $layoutVars
	 * @return string
	 */
	function renderlayout($layout=null, array $layoutVars=null)
	{
		if($layout===NULL)
		{
			$layout=$this->config['layout.default'];
		}
		
		if(!ob_start('ob_gzhandler')) ob_start();
		include_once($this->config['layout.path']."/".$layout);
		ob_end_flush();
		
		/*Seem better performance with ob_gzhandler and without return
		 ob_start();
		include_once($this->config['layout.path']."/".$layout);
		$layoutOut=ob_get_contents();
		ob_end_clean();
		*/
		//return $layoutOut;
	}
	
	/**
	 * ob_end_clean_all
	 * @return string
	 */
	function ob_end_clean_all()
	{
		$s = "";
		do{
			$s = ob_get_contents() . $s;
		} while(ob_end_clean());
		return $s;
	}	
}