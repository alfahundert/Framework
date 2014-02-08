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
 * 
 * @return string
 */
function Get($label, $params=array(), $return=false) {
	Language::LoadFile(Language::GetLanguage());
	
	$segment		= Language::GetSegment($label);
	
	// Return result
	if($return) {
		return sprintf($segment, $params);
	}
	
	// Echo result
	echo sprintf($segment, $params);
}