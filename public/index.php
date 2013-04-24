<?php

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// General defines
define ('NO_ACTION', 'no_action');
define ('NO_CONTROLLER', 'no_controller');

//Include autoloader class
require_once (APPLICATION_PATH.'/autoload.php');

//initialice config path
$configPath=APPLICATION_PATH.'/configs/config.ini';


//Start and run Application
$application = new Application ($configPath, APPLICATION_ENV);
$application->Bootstrap()
			->frontController();