<?php

abstract class AbstractController {
	
	/**
	 * View class
	 * @var View
	 */
	protected $view	= NULL;
	
	/**
	 * Init abstract controller
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		$this->view	= new View();
	}
	
}