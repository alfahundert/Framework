<?php

class Autoloader {
	
	public function __construct() {
		
	}
	
	/**
	 * Register autoload function
	 *
	 * @author Adrian Fischer
	 * @since 23.01.2014
	 *
	 * @param string $function
	 * @param Class $throw
	 *
	 * @return return_type
	 */
	public function Register($function, $throw) {
		spl_autoload_register($function, $throw=NULL);
	}
	
	/**
	 * Set file extensions for autoloader
	 *
	 * @author Adrian Fischer
	 * @since 23.01.2014
	 *
	 * @param string $extensions
	 *
	 * @return void
	 */
	public function SetExtensions($extensions=AUTOLOAD_EXTENSIONS) {
		spl_autoload_extensions($extensions);
	}
	
	public function SetIncludePath($path) {
		set_include_path($path);
	}
	
	public function Load($class) {
		spl_autoload($class);
	}
	
}


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

function debug($var) {
	if(is_array($var)) {
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
	
	if(is_string($var)) {
		echo $var;
	}
}