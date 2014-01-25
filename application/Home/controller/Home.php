<?php

class HomeController extends Controller {
	
	public function index() {
		$this->view->pagetitle	= 'Home/Index View';
		$this->view->SetParams(array('test', 'TEST'));
		$this->view->Render();
	}
		
}