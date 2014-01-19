<?php

class View {
	
	/**
	 * Title of the page
	 * @var string
	 */
	public $pagetitle	= DEFAULT_PAGETITLE;
		
	public function Render($view='index', $custom_header=FALSE, $custom_footer=FALSE, $controller=NULL) {
		if($custom_header && !is_null($controller)) {
			include_once PATH_ROOT . PATH_APPLICATION . $controller . "/views/header.phtml";
		} else {
			include_once PATH_ROOT . PATH_APPLICATION . PATH_VIEW_HEADER;
		}
		
		include_once PATH_ROOT . PATH_APPLICATION . "Home/views/" . $view . ".phtml";
		
		if($custom_footer && !is_null($controller)) {
			include_once PATH_ROOT . PATH_APPLICATION . $controller . "/views/footer.phtml";
		} else {
			include_once PATH_ROOT . PATH_APPLICATION . PATH_VIEW_FOOTER;
		}
	}

}