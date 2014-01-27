<?php

abstract class Controller {
	
	/**
	 * Controller view
	 * @var View
	 */
	protected $view	= NULL;
	
	/**
	 * Init view for controller
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		$this->view	= new View();
	}
	
}