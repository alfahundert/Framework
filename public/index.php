<?php

require_once '../library/Bootstrap.php';
require_once '../library/Database.php';

$bootstrap	= new Bootstrap();
$bootstrap->InitUrl();

// Autoloader
function __autoload($class) {
	if(stristr($class, 'Abstract')) {
		$filepath	= PATH_ROOT . PATH_LIBRARY . strtolower(str_replace('Abstract', '', $class)) . '/' . $class . '.php';
		require_once($filepath);
	}
	elseif(stristr($class, 'Controller')) {
		$filepath	= PATH_ROOT . PATH_APPLICATION . ucfirst(strtolower(str_replace('Controller', '', $class))) . '/controller/' . ucfirst(strtolower(str_replace('Controller', '', $class))) . '.php';
		if(file_exists($filepath)) {
			require_once($filepath);
		} else {
			header("Location: /home");
		}
	}
	elseif(stristr($class, 'Model')) {
		$filepath	= PATH_ROOT . PATH_APPLICATION . ucfirst(strtolower(str_replace('Model', '', $class))) . '/models/' . ucfirst(strtolower(str_replace('model', '', $class))) . '.php';
		require_once($filepath);
	}
	else {
		$filepath	= PATH_ROOT . PATH_LIBRARY . strtolower($class) . '/' . $class . '.php';
		require_once($filepath);
	}
}