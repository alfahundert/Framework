<?php

class ExceptionHandler extends Exception {

	/**
	 * Exception message
	 * @var string
	 */
	static private $_message		= NULL;
	
	/**
	 * Exception previous
	 * @var string
	 */
	static private $_previous		= NULL;
	
	/**
	 * Exception code
	 * @var int
	 */
	static private $_code			= NULL;
	
	/**
	 * Exception file
	 * @var string
	 */
	static private $_file			= NULL;
	
	/**
	 * Exception line
	 * @var int
	 */
	static private $_line			= NULL;
	
	/**
	 * Exception trace
	 * @var array
	 */
	static private $_trace			= NULL;
	
	/**
	 * Exception trace as string
	 * @var string
	 */
	static private $_traceAsString	= NULL;
	
	/**
	 * Catch exception
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 * 
	 * @param Exception $exception
	 *
	 * @return void
	 */
	static public function catchException($exception) {
		self::$_message			= $exception->getMessage();
		self::$_previous		= $exception->getPrevious();
		self::$_code			= $exception->getCode();
		self::$_file			= $exception->getFile();
		self::$_line			= $exception->getLine();
		self::$_trace			= $exception->getTrace();
		self::$_traceAsString	= $exception->getTraceAsString();
		
		self::_render();
	}
	
	/**
	 * Render exception message
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @return void
	 */
	static private function _render() {
		$errorCode	= uniqid();
		
		switch(ENVIRONMENT) {
			case 'development':
				$content	= '<b>Message:</b> ' . self::$_message . '<br/>';
				$content	.= '<b>Code:</b> ' . self::$_code . '<br/>';
				$content	.= '<b>File:</b> ' . self::$_file . '<br/>';
				$content	.= '<b>Line:</b> ' . self::$_line . '<br/>';
				$content	.= '<b>Trace:</b> <br/>' . str_replace("\n", "<br/>", self::$_traceAsString);
				break;
				
			case 'live':
				$content	= '<b>Message:</b> ' . self::$_message . '<br/>';
				$content	.= '<b>Fehlercode:</b> ' . $errorCode;
				break;
		}
		
		// Log error to exception file
		if(ENVIRONMENT != 'development') {
			self::_logError($errorCode);
		}
		
		// Show exception
		Bootstrap_Alert::Create('danger', 'An error has occured!', $content);
		
	}
	
	/**
	 * Write exception to file
	 *
	 * @author Adrian Fischer
	 * @since 25.01.2014
	 *
	 * @param unknown $errorCode
	 *
	 * @return return_type
	 */
	static private function _logError($errorCode) {
		$content	= "Fehlercode: " . $errorCode . " 	\r\n";
		$content	.= "Message: " . self::$_message . "\r\n";
		$content	.= "Code: " . self::$_code . "\r\n";
		$content	.= "File: " . self::$_file . "\r\n";
		$content	.= "Line: " . self::$_line . "\r\n";
		$content	.= "Trace: \r\n" . self::$_traceAsString;
		
		file_put_contents(PATH_EXCEPTION_LOG, $content, FILE_APPEND);
	}
	
}
