<?php

class View {
	
	/**
	 * Title of the page
	 * @var string
	 */
	public $pagetitle	= DEFAULT_PAGETITLE;
	
	/**
	 * Placeholder for create dynamic variables
	 * @var unknown
	 */
	public $data		= NULL;
	
	/**
	 * Init view
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @return void
	 */
	public function __construct($vars = array()) {
		$this->data = $vars;
	}
	
	/**
	 * HERE NEEDS TO BE A DESCRIPTION
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @param array $varName
	 *
	 * @return array
	 */
	public function __get($varName){
		if (!array_key_exists($varName,$this->data)) {
			unset($this->data[$varName]);
		} else {
			return $this->data[$varName];
		}
	}
	
	/**
	 * HERE NEEDS TO BE A DESCRIPTION
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @param string $varName
	 * @param string $value
	 *
	 * @return return_type
	 */
	public function __set($varName, $value){
		$this->data[$varName] = $value;
	}
	
	/**
	 * Render view
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @param array $vars
	 * @param string $view
	 *
	 * @return void
	 */
	public function Render($controller=DEFAULT_CONTROLLER, $view='index') {
		include_once PATH_VIEW_HEADER;
		
		include_once PATH_APPLICATION . ucfirst($controller) . DS . 'views' . DS . $view . ".phtml";
		
		include_once PATH_VIEW_FOOTER;
	}
	
	/*
	public function Render2($view='index', $custom_header=FALSE, $custom_footer=FALSE, $controller=NULL) {		
		if($custom_header && !is_null($controller)) {
			include_once PATH_APPLICATION . $controller . "/views/header.phtml";
		} else {
			include_once PATH_VIEW_HEADER;
		}
		
		include_once PATH_APPLICATION . "Home/views/" . $view . ".phtml";
		
		if($custom_footer && !is_null($controller)) {
			include_once PATH_ROOT . PATH_APPLICATION . $controller . "/views/footer.phtml";
		} else {
			include_once PATH_VIEW_FOOTER;
		}
	}
	*/
}