<?php

abstract class Controller {
	
	protected $view	= NULL;
	
	public function __construct() {
		$this->view	= new View();
	}
	
}