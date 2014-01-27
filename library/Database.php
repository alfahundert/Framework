<?php

class Database extends PDO {
	
	private $_select	= NULL;
	
	private $_insert	= NULL;
	
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
	
	/**
	 * HERE NEEDS TO BE A DESCRIPTION
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param string $query
	 * @param array $parameters
	 * @param PDO $fetchMode
	 * @param int $column
	 * 
	 * @return mixed
	 */
	public function Select1($query, $params=array(), $fetchMode = PDO::FETCH_ASSOC, $column=NULL) {
		$sth	= $this->prepare($query);
		
		$sth->execute($params);
		if(!is_null($column)) {
			return $sth->fetchAll($fetchMode, $column);			
		}
		
		return $sth->fetchAll($fetchMode);
	}
	
	public function Insert1($table, $params=array()) {
		
		ksort($params);
		
		$fieldNames		= implode('`, `', array_keys($params));
		$fieldValues	= ':' . implode(', :', array_keys($params));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		
		foreach ($params as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		
		$sth->execute();
	}
	
	
	/**
	 * insert
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 */
	public function insert($table, $data)
	{
		ksort($data);
	
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
	
		$sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
	
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
	
		$sth->execute();
	}
	
	/**
	 * update
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 * @param string $where the WHERE query part
	 */
	public function update($table, $data, $where)
	{
		ksort($data);
	
		$fieldDetails = NULL;
		foreach($data as $key=> $value) {
			$fieldDetails .= "`$key`=:$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');
	
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
	
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
	
		$sth->execute();
	}
	
	/**
	 * delete
	 *
	 * @param string $table
	 * @param string $where
	 * @param integer $limit
	 * @return integer Affected Rows
	 */
	public function delete($table, $where, $limit = 1)
	{
		return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
	}
	
}