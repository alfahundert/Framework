<?php

abstract class Model {
	
	/**
	 * Store database class
	 * @var Database
	 */
	protected $db	= NULL;
	
	/**
	 * Init model
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		$this->db	= new Database();
	}
}