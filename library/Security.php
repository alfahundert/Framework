<?php
class Security {
	
	/**
	 * Generate hash with password and salt
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $password
	 *
	 * @return string
	 */
	static public function GeneratePasswordHash($password) {
		$string	= SALT . $password;
		// 128
		return hash('sha512', $string);
	}
	
	/**
	 * Generate token for activation
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $username
	 *
	 * @return string
	 */
	static public function GenerateActivationToken($username) {
		$string	= time() . $username;
		// 64
		return hash('sha256', $string);
	}
	
	/**
	 * Get user IP
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @return string
	 */
	static public function GetUserIp() {
		if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip	= $_SERVER['REMOTE_ADDR'];
		} else {
			$ip	= $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		
		return $ip;
	}
	
}