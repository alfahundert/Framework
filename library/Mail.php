<?php
class Mail {
	
	/**
	 * Send mail to
	 * @var string
	 */
	private $_to		= NULL;
	
	/**
	 * Send copy to
	 * @var string
	 */
	private $_cc		= NULL;
	
	/**
	 * Send unknown copy to
	 * @var string
	 */
	private	$_bcc		= NULL;
	
	/**
	 * Send mail from name
	 * @var string
	 */
	private $_from_name	= NULL;
	
	/**
	 * Send mail from mail adress
	 * @var string
	 */
	private	$_from_mail	= NULL;
	
	/**
	 * Reply to
	 * @var string
	 */
	private	$_reply_to	= NULL;
	
	/**
	 * Mail subject
	 * @var string
	 */
	private $_subject	= NULL;
	
	/**
	 * Mail content
	 * @var string
	 */
	private	$_content	= NULL;

/*
 * SETTER
 */
	
	/**
	 * Set mail to
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $to
	 * 
	 * @return void
	 */
	public function SetTo($to) {
		$this->_to	= $to;
	}
	
	/**
	 * Set copy to
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $cc
	 *
	 * @return void
	 */
	public function SetCc($cc) {
		$this->_cc	= $cc;
	}
	
	/**
	 * Set unknown copy to
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $bcc
	 *
	 * @return void
	 */
	public function SetBcc($bcc) {
		$this->_bcc	= $bcc;
	}
	
	/**
	 * Set mail from name
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $name
	 *
	 * @return void
	 */
	public function SetFromName($name) {
		$this->_from_name	= $name;
	}
	
	/**
	 * Set mail from mail adress
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $mail
	 *
	 * @return void
	 */
	public function SetFromMail($mail) {
		$this->_from_mail	= $mail;
	}
	
	/**
	 * Set reply to
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $reply_to
	 *
	 * @return void
	 */
	public function SetReplyTo($reply_to) {
		$this->_reply_to	= $reply_to;
	}
	
	/**
	 * Set subject
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $subject
	 *
	 * @return void
	 */
	public function SetSubject($subject) {
		$this->_subject	= $subject;
	}
	
	/**
	 * Set content
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @param string $content
	 *
	 * @return void
	 */
	public function SetContent($content) {
		$this->_content	= $content;
	}
	
/*
 * PROCESS
 */	

	/**
	 * Send mail
	 *
	 * @author Adrian Fischer
	 * @since 09.02.2014
	 *
	 * @return void
	 */
	public function Send() {
		// Headers
		$header	= 'From: ' . $this->_from_mail . ' <' . $this->_from_mail . ">\r\n";
		
		if(!is_null($this->_cc)) {
			$header	.= 'Cc: ' . $this->_cc . "\r\n";
		}
		
		if(!is_null($this->_bcc)) {
			$header	.= 'Bcc: ' . $this->_bcc . "\r\n";
		}
		
		if(!is_null($this->_reply_to)) {
			$header	.= 'Reply-To: ' . $this->_reply_to . "\r\n";
		}
		
		mail($this->_to, $this->_subject, $this->_content, $header);
	}
	
}