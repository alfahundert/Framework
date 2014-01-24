<?php

abstract class Model {
	
	protected $db	= NULL;
	
	public function __construct() {
		$this->db	= new Database();
	}
}