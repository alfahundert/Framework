<?php

class Bootstrap_Alert {
	
	static private $_type		= NULL;
	
	static private $_headline	= NULL;
	
	static private $_content	= NULL;
	
	static public function Create($type, $headline, $content) {
		self::$_type		= $type;
		self::$_headline	= $headline;
		self::$_content		= $content;
		
		self::_render();
	}
	
	static private function _render() {
		echo '<div class="alert alert-' . self::$_type . '"><b>' . self::$_headline . '</b><br/>' . self::$_content . '</div>';
	}
	
}