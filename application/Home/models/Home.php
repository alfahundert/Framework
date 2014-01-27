<?php

class HomeModel extends Model {
	
	public function InsertUser() {
		$this->db->Insert1('user', array('user_name' => 'admin'));
	}
	
	public function GetUser() {
		$result	= $this->db->Select1('SELECT * FROM user WHERE user_name = ?', array('admin'));
		return $result[0];
	}
}