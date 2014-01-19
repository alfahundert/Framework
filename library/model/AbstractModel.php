<?php

abstract class AbstractModel {
	
	protected $db	= NULL;
	
	public function __construct() {
		$this->db	= new Database();
	}
}