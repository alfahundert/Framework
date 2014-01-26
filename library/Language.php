<?php

class Language {
	
	/**
	 * Translation segments
	 * @var DOMElement
	 */
	static private $_segments	= array();
	
	/**
	 * Load language from file
	 * 
	 * @author Adrian Fischer
	 * @since 26.01.2014
	 *
	 * @param string $lang
	 * 
	 * @return void
	 */
	static private function _loadLanguage($lang) {
		$xml			= new DomDocument('1.0');
		$document_path	= PATH_LANGUAGES . strtolower($lang) . '.xml';
		$xml->load($document_path);		
		$segments		= $xml->getElementsByTagName('segment');
		
		foreach($segments as $segment) {
			self::$_segments[$segment->getAttribute('id')]	= $segment->firstChild->nodeValue;
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
	static public function Get($label, $return=false) {
		self::_loadLanguage(Bootstrap::GetLanguage());
		
		if($return) {
			return self::$_segments[$label];
		}
		
		echo self::$_segments[$label];		
	}
	
	/**
	 * Get geolocation from ip
	 * 
	 * @author Adrian Fischer
	 * @since 26.01.2014
	 * 
	 * @return string
	 */
	static public function GetGeoLocationFromIp() {
		$client 	= @$_SERVER['HTTP_CLIENT_IP'];
		$forward	= @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote		= $_SERVER['REMOTE_ADDR'];
		
		if(filter_var($client, FILTER_VALIDATE_IP)) {
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
			$ip = $forward;
		}
		else {
			$ip = $remote;
		}
	
		$ip_data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
	
		if($ip_data && $ip_data['geoplugin_countryCode'] != null) {
			$result	= $ip_data['geoplugin_countryCode'];
		} else {
			$result	= "unknown";
		}
		
		if($result != DEFAULT_LANGUAGE) {
			return 'en';
		} else {
			return DEFAULT_LANGUAGE;
		}
	}
	
}