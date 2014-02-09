<?php

class HomeModel extends Model {
	
	/**
	 * Get user by username
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $username
	 *
	 * @return array
	 */
	public function GetUserByUsername($username) {
		return $this->db->Select('SELECT * FROM users WHERE user_name = ? LIMIT 1', array($username));
	}
	
	/**
	 * Get user from blacklist
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $username
	 * 
	 * @return array
	 */
	public function GetBlacklistUserByUsername($username) {
		return $this->db->Select('SELECT * FROM username_blacklist WHERE user_name = ? LIMIT 1', array($username));
	}
	
	/**
	 * Get user by mail adress
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $mail
	 *
	 * @return array
	 */
	public function GetUserByMail($mail) {
		return $this->db->Select('SELECT * FROM users WHERE user_mail = ? LIMIT 1', array($mail));
	}
	
	/**
	 * Insert new user
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $username
	 * @param string $mail
	 * @param string $password_hash
	 * @param int $tou_accepted
	 * @param string $activation_token
	 *
	 * @return array
	 */
	public function InsertUser($username, $mail, $password_hash, $tou_accepted, $activation_token) {
		$params	= array(
						'user_name'				=> $username,
						'user_mail'				=> $mail,
						'user_password'			=> $password_hash,
						'user_registered'		=> date('Y-m-d H:i:s', time()),
						'user_registered_ip'	=> Security::GetUserIp(),
						'user_tou_accepted'		=> $tou_accepted,
						'user_activation_token'	=> $activation_token
		);
		
		return $this->db->Insert('users', $params);
	}
}