<?php

class HomeController extends Controller {
	
	public function index() {
		#Translation::Get('test', array('HAHA', 'lol'));
		
		$model	= new HomeModel();
		$user	= $model->GetUser();
		
		$this->view->pagetitle	= 'Home/Index View';
		$this->view->SetParams(array('username' => $user['user_name']));
		$this->view->Render();
	}
		
}