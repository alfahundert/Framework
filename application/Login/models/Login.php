<?php

class LoginModel extends Model {
	
	public function InsertUser() {
		$this->db->Insert('user', array('user_name' => 'admin'));
	}
	
	public function GetUser() {
		$result	= $this->db->Select('SELECT * FROM user WHERE user_name = ?', array('admin'));
		return $result[0];
	}
}