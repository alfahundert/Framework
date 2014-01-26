<?php

class Bootstrap_Alert {
	
	/**
	 * Alert type
	 * @var string
	 */
	static private $_type		= NULL;
	
	/**
	 * Alert headline
	 * @var string
	 */
	static private $_headline	= NULL;
	
	/**
	 * Alert content
	 * @var string
	 */
	static private $_content	= NULL;
	
	/**
	 * Create Bootstrap alert box
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @param string $type
	 * @param string $headline
	 * @param string $content
	 *
	 * @return void
	 */
	static public function Create($type, $headline, $content) {
		self::$_type		= $type;
		self::$_headline	= $headline;
		self::$_content		= $content;
		
		// Render alert
		self::_render();
	}
	
	/**
	 * Render
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @return void
	 */
	static private function _render() {
		echo '<div class="alert alert-' . self::$_type . '"><b>' . self::$_headline . '</b><br/>' . self::$_content . '</div>';
	}
	
}