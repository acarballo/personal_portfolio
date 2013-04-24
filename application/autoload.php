<?php

/**
 * __autoload
 * @param string $className
 * @throws Exception
 */
function __autoload($className) 
{
	try{
		$classPath = APPLICATION_PATH.'/'.str_replace('_', '/', $className).'.php';
		if(file_exists($classPath))
			require_once $classPath;
		else 
			throw new Exception("Class file not found");
	}catch(Exception $e){
		echo '$classPath : '.$classPath."\n";
		echo 'autoload exception: ', $e->getMessage(), "\n";
	}	
}