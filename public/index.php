<?php

require_once '../library/Bootstrap.php';

$bootstrap	= new Bootstrap();
$bootstrap->InitUrl();

function __autoload($class) {
	if(stristr($class, 'Abstract')) {
		$filepath	= PATH_ROOT . PATH_LIBRARY . strtolower(str_replace('Abstract', '', $class)) . '/' . $class . '.php';
		require_once($filepath);
	} else {
		$filepath	= PATH_ROOT . PATH_LIBRARY . strtolower($class) . '/' . $class . '.php';
		require_once($filepath);
	}
}