<?php

class Database extends PDO {
	
	/**
	 * Init class
	 *
	 * @author Adrian Fischer
	 * @since 19.01.2014
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
	}
	
	
	public function Select($query, $parameters = array(), $fetchMode = PDO::FETCH_ASSOC) {
		$sth	= $this->prepare($query);
		$sth->execute($parameters);
		return $sth->fetchAll();
	}
	
	public function Insert() {
	
	}
	
	public function Delete() {
	
	}
}