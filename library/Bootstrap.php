<?php

class Bootstrap {
	
	/**
	 * Controller
	 * @var string
	 */
	private $_controller			= NULL;
	
	/**
	 * Action/Method
	 * @var string
	 */
	private $_action				= 'index';
	
	/**
	 * Additional params
	 * @var array
	 */
	private $_params				= array();
	
	/**
	 * Counted params in URL
	 * @var int
	 */
	private $_counted_params		= 0;
	
	/**
	 * Autoloader class
	 * @var Autoloader
	 */
	private $_autoloader			= NULL;

/*
 * INIT
 */
	
	/**
	 * Init class
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		$this->_loadConfigs();		
		$this->_initAutoloader();
		include_once '../library/Functions.php';
		spl_autoload_register(array('Autoloader' , 'Loader'));
		set_exception_handler("ExceptionHandler::catchException");
	}

	/**
	 * Init URL and process params
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	public function Init() {
		
		$url	= URI::GetParam('url');
		
		if(is_null($url)) {
			// Call controller ans method
			Language::Set();
			URI::Redirect();
		} else {
			
			$url	= explode("/", rtrim($url, "/"));
			Language::Set();
			
			if(isset($url[0])) {
				Language::Set((strtolower($url[0])));
			}
			
			if(isset($url[1])) {
				$this->_controller	= ucfirst(strtolower($url[1])) . "Controller";
			} else {
				$this->_controller	= DEFAULT_CONTROLLER;
			}
				
			if(isset($url[2])) {
				$this->_action		= strtolower($url[2]);
			}
			
			unset($url[0]); // Language
			unset($url[1]); // Controller
			unset($url[2]); // Action
			
			// Check if parameters exist
			if(count($url) > 1) {
				foreach($url as $param) {
					$this->_params[]	= $param;
				}
			}
			
			// Count params
			$this->_counted_params		= count($this->_params);
			
			// Call controller and method
			$this->_callControllerMethod();
		}
	}
	
	/**
	 * Init Autoloader
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @return void
	 */
	private function _initAutoloader() {
		require_once 'Autoloader.php';
		
		$this->_autoloader	= new Autoloader();
	}
	
/*
 * CALLS
 */
	
	/**
	 * Call controller and method
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	private function _callControllerMethod() {
		// Check if method exist
		
		if(!method_exists($this->_controller, $this->_action)) {
			URI::ShowHttpError('404');
		}
		
		$controller	= new $this->_controller();
		
		switch($this->_counted_params) {
			case 0:
				$controller->{$this->_action}();
				break;
			case 1:
				$controller->{$this->_action}($this->_params[0]);
				break;
			case 2:
				$controller->{$this->_action}($this->_params[0], $this->_params[1]);
				break;
			case 3:
				$controller->{$this->_action}($this->_params[0], $this->_params[1], $this->_params[2]);
				break;
			default:
				// Redicrect to default controller
				URI::Redirect();
				break;
				
		}
	}
	
	/**
	 * Call standard controller and method
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	private function _callStandardControllerMethod() {
		$this->_controller		= DEFAULT_CONTROLLER . 'Controller';
		$this->_action			= 'index';
		$this->_counted_params	= 0;
		
		$controller	= new $this->_controller();
		$controller->{$this->_action}();
	}

/*
 * LOADER
 */
	
	/**
	 * Load config files
	 *
	 * @author Adrian Fischer
	 * @since 23.01.2014
	 *
	 * @return void
	 */
	private function _loadConfigs() {
		$files	= scandir(PATH_ROOT . DS . 'configs');
		unset($files[0]);
		unset($files[1]);
	
		foreach($files as $file) {
			include_once PATH_ROOT . DS . 'configs' . DS . $file;
		}
	}
	
}