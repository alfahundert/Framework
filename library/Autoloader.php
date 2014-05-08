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
		include_once get_include_path().$class.AUTOLOAD_EXTENSIONS;
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
			
			// Controller
			case(preg_match('#^[A-Za-z]+Controller$#', $class) ? TRUE : FALSE):
				$class_file	= PATH_APPLICATION . str_replace('Controller', '', $class) . DS . 'controller' . DS . ucfirst(str_replace('Controller', '', $class)) . '.php';
				if(!file_exists($class_file)) {
					URI::ShowHttpError(404);
				}
				include_once $class_file;
				break;
			
			// Models
			case(preg_match('#^[A-Za-z]+Model$#', $class) ? TRUE : FALSE):
				$class_file	= PATH_APPLICATION . str_replace('Model', '', $class) . DS . 'models' . DS . ucfirst(str_replace('Model', '', $class)) . '.php';
				if(!file_exists($class_file)) {
					URI::ShowHttpError(404);
				}
				include_once $class_file;
				break;
			
			// Library Subfolders
			case(preg_match('#[A-Za-z]+_#', $class) ? TRUE : FALSE):
				$folders	= str_replace("_", DS, $class);
				$class_file	= PATH_LIBRARY . $folders . '.php';
				if(!file_exists($class_file)) {
					URI::ShowHttpError(404);
				}
				include_once $class_file;
				break;

			// Library
			default:
				self::_setIncludePath(PATH_LIBRARY);
				self::_load($class);
				break;
		}		
	}
	
}