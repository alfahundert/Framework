<?php

class TestController extends Controller {
	
	public function index() {
		$view				= new View();
		$view->pagetitle	= 'Test/Index View';
		$view->Render('Test');
	}
	
}