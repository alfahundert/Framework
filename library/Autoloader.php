<?php

class Autoloader {
	
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
	static private function _setExtensions($extensions=AUTOLOAD_EXTENSIONS) {
		spl_autoload_extensions($extensions);
	}
	
	/**
	 * Set include path
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @param string $path
	 *
	 * @return void
	 */
	static private function _setIncludePath($path) {
		set_include_path($path);
	}
	
	/**
	 * Load class
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @param string $class
	 *
	 * @return void
	 */
	static private function _load($class) {
		spl_autoload($class);
	}
	
	/**
	 * Detect class paths
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @param string $class
	 *
	 * @return void
	 */
	static public function Loader($class) {
		
		self::_setExtensions();
		
		switch(TRUE) {
			case(preg_match('#^[A-Za-z]+Controller$#', $class) ? TRUE : FALSE):
				$class_file	= PATH_APPLICATION . str_replace('Controller', '', $class) . DS . 'controller' . DS . strtolower(str_replace('Controller', '', $class)) . '.php';
				include_once $class_file;
				break;
			case(preg_match('#^[A-Za-z]+Model$#', $class) ? TRUE : FALSE):
				$class_file	= PATH_APPLICATION . str_replace('Model', '', $class) . DS . 'model' . DS . strtolower(str_replace('Model', '', $class)) . '.php';
				include_once $class_file;
				break;
			default:
				self::_setIncludePath(PATH_LIBRARY);
				self::_load($class);
				break;
		}		
	}
	
}

/*
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
*/