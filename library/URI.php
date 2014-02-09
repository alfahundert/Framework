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
		$params	= array();
		
		if(isset($_GET)) {
			$params	= array_merge($params, $_GET);
		}
		
		if(isset($_POST)) {
			$params	= array_merge($params, $_POST);
		}
		
		return $params;
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
		$url	= self::GenerateUrl($controller, $action, $params);
		
		// Process redirect
		header("Location: ". $url);
		exit;
	}
	
	/**
	 * Generate URL
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param string $controller
	 * @param string $action
	 * @param array $params
	 * @param bool $external
	 * @param string $protocoll
	 *
	 * @return string
	 */
	static public function GenerateUrl($controller, $action=NULL, $params=array(), $external=false, $protocol='http') {
		$url	= '';
		
		if($external) {
			$url	.= $protocol . '://' . DEFAULT_DOMAIN;
		}
		
		$url	.= '/' . Language::GetLanguage() . '/' . strtolower($controller) . '/';
		
		if(!is_null($action)) {
			$url	.= strtolower($action) . '/';
		}
		
		if(is_array($params) && count($params) > 0) {
			foreach($params as $param) {
				$url	.= $param . '/';
			}
		}
		return $url;
	}

	/**
	 * Show Apache error
	 *
	 * @author Adrian Fischer
	 * @since 07.02.2014
	 *
	 * @param int $code
	 * @param bool $show_file
	 *
	 * @return void
	 */
	static public function ShowHttpError($code, $show_file=true) {
		if(empty($code)) {
			throw new Exception('No errorcode set!');
		}
		
		// Show error page
		header("HTTP/1.0 ". $code);
		
		if($show_file) {
			include PATH_PUBLIC . $code . '.php';
		}
		
		exit;
	}
	
}