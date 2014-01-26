<?php
class Translation {
	
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
	static public function Get($label, $params=array(), $return=false) {
		Language::LoadFile(Language::GetLanguage());
		
		// Replace placeholders
		if(count($params) > 0) {
			$segment		= Language::GetSegment($label);
			foreach($params as $key => $value) {
				$placeholder	= '$';
				$placeholder	.= $key+1;
				$segment		= str_replace($placeholder, $value, $segment);
			}
		}
		
		// Return result
		if($return) {
			return $segment;
		}
		
		// Echo result
		echo $segment;
	}
	
}