<?php

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
function debug($var) {
	if(is_array($var)) {
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

	if(is_string($var)) {
		echo $var;
	}
}

/**
 * Get translation
 * 
 * @author Adrian Fischer
 * @since 26.01.2014
 *
 * @param string $label
 * @param array $params
 * @param bool $return
 * 
 * @return string
 */
function Get($label, $params=array(), $return=false) {
	Language::LoadFile(Language::GetLanguage());
	$segment		= Language::GetSegment($label);
	
	$func_arr[]	= $segment;
	
	if(count($params > 0)) {
		foreach($params as $param) {
			$func_arr[]	= $param;
		}
	}
	
	// Return result
	if($return) {
		return call_user_func_array('sprintf', $func_arr);
	}
	
	// Echo result
	echo call_user_func_array('sprintf', $func_arr);
}