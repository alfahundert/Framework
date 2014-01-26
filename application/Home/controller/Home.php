<?php

class HomeController extends Controller {
	
	public function index() {
		Language::Get('test');
		
		$this->view->pagetitle	= 'Home/Index View';
		$this->view->SetParams(array('test', 'TEST'));
		$this->view->Render();
	}
		
}