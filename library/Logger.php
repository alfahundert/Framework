<?php

class Logger {
	
	/**
	 * Print debug informations
	 *
	 * @author Adrian Fischer
	 * @since 24.01.2014
	 *
	 * @param mixed $var
	 *
	 * @return void
	 */
	static public function debug($var) {
		if(is_array($var)) {
			echo '<pre>';
			print_r($var);
			echo '</pre>';
		}
		
		if(is_string($var)) {
			echo $var;
		}
	}
}