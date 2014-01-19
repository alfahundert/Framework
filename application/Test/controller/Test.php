<?php

class TestController extends AbstractController {
	
	public function index() {
		print 'test/index method';
		$this->view->pagetitle	= 'Test/Index View';
		
		$this->view->Render();
	}
	
}