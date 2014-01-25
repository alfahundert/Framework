<?php

class View {
	
	/**
	 * Title of the page
	 * @var string
	 */
	public $pagetitle	= DEFAULT_PAGETITLE;
	
	/**
	 * Placeholder for creation of dynamic variables
	 * @var array
	 */
	public $data		= array();
	
	/**
	 * Init view
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		$this->RenderHeader();
	}
	
	public function SetParams($vars = array()) {
		foreach($vars as $var => $val) {
			$this->__set($var, $val);
		}
	} 
	
	/**
	 * Get data vars
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @param array $varName
	 *
	 * @return array
	 */
	public function __get($varName){
		if (!array_key_exists($varName, $this->data)) {
			unset($this->data[$varName]);
		} else {
			return $this->data[$varName];
		}
	}
	
	/**
	 * Set data vars
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
	 * Render default header
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @return void
	 */
	public function RenderHeader() {
		include_once PATH_VIEW_HEADER;
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
		include_once PATH_APPLICATION . ucfirst($controller) . DS . 'views' . DS . $view . ".phtml";
		
		include_once PATH_VIEW_FOOTER;
	}
}
