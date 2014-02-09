<?php

class HomeController extends Controller {
	
	public function index() {
		$model	= new HomeModel();
		
		$this->view->pagetitle	= 'Home/Index View';
		$this->view->Render();
	}
	
	/**
	 * Check if user already exist
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @return string
	 */
	public function checkuser() {
		$username			= URI::GetParam('username');
		$model				= new HomeModel();
		$result_user		= $model->GetUserByUsername($username);
		$result_blacklist	= $model->GetBlacklistUserByUsername($username);
		
		if(isset($result_user[0]) || isset($result_blacklist[0])) {
			echo '0';
		} else {
			echo '1';
		}
		
	}
	
	/**
	 * Check if mail already exist
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @return string
	 */
	public function checkmail() {
		$mail		= URI::GetParam('mail');
		$model		= new HomeModel();
		$result		= $model->GetUserByMail($mail);
		
		if(isset($result[0])) {
			echo '0';
		} else {
			echo '1';
		}
		
	}
	
	/**
	 * Process user registration
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @return return_type
	 */
	public function process() {
		$username			= URI::GetParam('username');
		$adress				= URI::GetParam('mail');
		$password			= URI::GetParam('password');
		$tou				= URI::GetParam('tou');
		$tou_accepted		= 0;
		$activation_token	= Security::GenerateActivationToken($username);
		$password_hash		= Security::GeneratePasswordHash($password);
		
		if($tou	== 'on') {
			$tou_accepted	= 1;
		}
		
		// Check given values if empty
		if(!empty($username) && preg_match("#^([a-zA-Z0-9_])*$#", $username) && !empty($adress) && !empty($password) && !empty($tou)) {
			$model	= new HomeModel();
			$result	= $model->InsertUser($username, $adress, $password_hash, $tou_accepted, $activation_token);
			
			// Construct mail
			$mail	= new Mail();
			$mail->SetFromName('Browsergame');
			$mail->SetFromMail('nopeply@adrian-fischer.net');
			$mail->SetSubject('Willkommen ' . $username);
			$mail->SetTo($adress);
			$mail->SetContent(URI::GenerateUrl('home', 'activate', array($activation_token), true));
			
			// Send mail
			$mail->Send();
			
			// Return for javascript
			if($result) {
				echo '1';
			} else {
				echo '0';
			}
		} else {
			echo '0';
		}
	}
	
	/**
	 * Activate user
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @return void
	 */
	public function activate($token) {
		echo $token;
	}
		
}