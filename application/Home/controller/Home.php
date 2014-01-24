<?php

class HomeController extends Controller {
	
	public function index() {
		print 'home/index method';
		$this->view->pagetitle	= 'Home/Index View';
		$this->view->Render("index");
	}
		
}