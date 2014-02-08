<?php

class Language {
	
	/**
	 * Translation segments
	 * @var array
	 */
	static private $_segments	= array();
	
	/**
	 * Language
	 * @var string
	 */
	static private $_language	= NULL;
	
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
	static public function LoadFile($lang) {
		$xml			= new DomDocument('1.0');
		$document_path	= PATH_LANGUAGES . strtolower($lang) . '.xml';
		$xml->load($document_path);		
		$segments		= $xml->getElementsByTagName('segment');
		
		foreach($segments as $segment) {
			$segment instanceof DOMNode;
			if($segment->hasChildNodes()) {
				self::$_segments[$segment->getAttribute('id')]	= $segment->firstChild->nodeValue;
			}
		}
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
	
	/**
	 * Get languages
	 *
	 * @author Adrian Fischer
	 * @since 26.01.2014
	 *
	 * @return array
	 */
	static public function GetAvailableLanguages() {
		$files	= scandir(PATH_LANGUAGES);
		unset($files[0]);
		unset($files[1]);
		
		foreach($files as $file) {
			$langs[]	= strtolower(str_replace(".xml", "", $file));
		}
		
		return $langs;
	}
	
	/**
	 * Set or detect language
	 *
	 * @author Adrian Fischer
	 * @since 26.01.2014
	 *
	 * @param string $language
	 *
	 * @return void
	 */
	static public function Set($language=NULL) {
		if(!is_null($language) && in_array(strtolower($language), self::GetAvailableLanguages())) {
			self::$_language		= strtolower($language);
		} else {
			self::$_language		= self::GetGeoLocationFromIp();
		}
	}
	
	/**
	 * Get language
	 *
	 * @author Adrian Fischer
	 * @since 26.01.2014
	 *
	 * @return string
	 */
	static public function GetLanguage() {
		return self::$_language;
	}
	
	/**
	 * Get segments
	 *
	 * @author Adrian Fischer
	 * @since 26.01.2014
	 *
	 * @return array
	 */
	static public function GetSegments() {
		return self::$_segments;
	}
	
	/**
	 * Get segment
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param string $label
	 *
	 * @return string
	 */
	static public function GetSegment($label) {
		// Return label
		if(!key_exists($label, self::$_segments)) {
			return "#" . $label;
		}
		
		// Return segment
		return self::$_segments[$label];
	}
	
}