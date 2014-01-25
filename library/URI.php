<?php

class URI {
	
	/**
	 * Get given parameter from url
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @param string $param
	 *
	 * @return mixed | NULL
	 */
	static public function GetParam($param) {
		if(isset($_GET[$param])) {
			return $_GET[$param];
		}
		
		if(isset($_POST[$param])) {
			return $_POST[$param];
		}
		
		return NULL;
	}
	
	/**
	 * Get all parameters from url
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @return mixed | NULL
	 */
	static public function GetAllParameters() {
		if(isset($_GET)) {
			return $_GET;
		}
		
		if(isset($_POST)) {
			return $_POST;
		}
		
		return NULL;
	}
	
	/**
	 * Redirect to given URL
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @param string $controller
	 * @param string $action
	 * @param array $params
	 *
	 * @return void
	 */
	static public function Redirect($controller=DEFAULT_CONTROLLER, $action=NULL, $params=array()) {
		$path	= '/' . strtolower($controller) . '/';
		
		// add action
		if(!is_null($action)) {
			$path	.= $action . '/';
		}
		
		if(is_array($params) && count($params) != 0) {
			foreach($params as $param => $value) {
				$path	.= $param . '/' . $value;
			}
		}
		
		// Process redirect
		header("Location: ". $path);
	}
	
}