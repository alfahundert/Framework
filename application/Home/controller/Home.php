<?php

class HomeController extends Controller {
	
	public function index() {
		$view				= new View();
		$view->pagetitle	= 'Home/Index View';
		$view->Render();
	}
		
}