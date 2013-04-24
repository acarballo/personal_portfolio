<?php

/**
 * controllers_helpers_actionHelpers
 * @author Andres
 *
 */
class controllers_helpers_actionHelpers
{

	static function debug($data, $label='', $die=FALSE)
	{
		echo("<pre>");
		echo("file:".__FILE__."<br/>");
		echo("line:".__LINE__."<br/>");
		//echo("function:".__FUNCTION__."<br/>");
		echo("data:".$label."<br/>");
		print_r($data);
		echo("</pre>");
		if($die) die;
	}
	//controllers_helpers_actionHelpers::debug();
}


