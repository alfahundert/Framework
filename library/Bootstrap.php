<?php

class Bootstrap {
	
	/**
	 * Controller
	 * @var string
	 */
	private $_controller	= NULL;
	
	/**
	 * Action/Method
	 * @var string
	 */
	private $_action		= NULL;
	
	/**
	 * Additional params
	 * @var array
	 */
	private $_params		= array();
	
	
	/**
	 * Init class
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		$this->loadConfigPaths();
		$this->loadConfigDatabase();
	}

	public function InitUrl() {
		if(isset($_GET['url'])) {
			$url	= explode("/", rtrim($_GET['url'], "/"));
			$this->_controller	= $url[0];
			unset($url[0]);
			$this->_action		= $url[1];
			unset($url[1]);
			$this->_params	= $url;
			print_r($this->_params);
		} else {
			// Auf startseite verweisen
		}
	}
	
/*
 * LOADER
 */
	
	/**
	 * Get paths from ini file
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	private function loadConfigPaths() {
		// Parse ini file
		$ini	= parse_ini_file('../configs/paths.ini');

		// Create constants
		define("PATH_APLLICATION", $ini['application']);
		define("PATH_CONFIGS", $ini['configs']);
		define("PATH_LIBRARY", $ini['library']);
		define("PATH_PUBLIC", $ini['public']);
		define("PATH_ROOT", $ini['root']);
	}
	
	/**
	 * Get database login information from ini file
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	private function loadConfigDatabase() {
		// Parse ini file
		$ini	= parse_ini_file('../configs/db.ini');
		
		//Create constants
		define("DB_HOST", $ini['host']);
		define("DB_DATABASE", $ini['database']);
		define("DB_USERNAME", $ini['username']);
		define("DB_PASSWORD", $ini['password']);
	}
}