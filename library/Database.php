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
	
	/**
	 * Select columns
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
	public function Select($query, $params=array(), $fetchMode = PDO::FETCH_ASSOC, $column=NULL) {
		$sth	= $this->prepare($query);
		
		$sth->execute($params);
		if(!is_null($column)) {
			return $sth->fetchAll($fetchMode, $column);			
		}
		
		return $sth->fetchAll($fetchMode);
	}
	
	/**
	 * Insert values
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param string $table
	 * @param array $params
	 *
	 * @return void
	 */
	public function Insert($table, $params=array()) {
		
		ksort($params);
		
		$fieldNames		= implode('`, `', array_keys($params));
		$fieldValues	= ':' . implode(', :', array_keys($params));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		
		foreach ($params as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		// Execute
		return $sth->execute();
	}
	
	/**
	 * Update column
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param string $table
	 * @param array $params
	 * @param string $where
	 *
	 * @return void
	 */
	public function Update($table, $params, $where) {
		ksort($params);
	
		$fieldDetails	= $this->_buildStringFromParams($params);
		
		// Prepare statement
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
	
		$this->_bindParamValues($sth, $params);
	
		// Execute
		return $sth->execute();
	}
	
	/**
	 * Delete datasets
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param string $table
	 * @param array $params
	 * @param int $limit
	 *
	 * @return void
	 */
	public function Delete($table, $params, $limit=1) {
		$where	= $this->_buildStringFromParams($params);
		$query	= 'DELETE FROM ' . $table . 'WHERE ' . $where . ' LIMIT ' . $limit;
		return $this->exec($query);
	}
	
	/**
	 * Build string from parameters
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param array $params
	 * 
	 * @return string
	 */
	private function _buildStringFromParams($params) {
		$result	= '';
		foreach($params as $key=> $value) {
			$result	.= "`$key`=:$key,";
		}
		$result	= rtrim($result, ',');
		
		return $result;
	}
	
	/**
	 * Bind parameter values to placeholders
	 *
	 * @author Adrian Fischer
	 * @since 27.01.2014
	 *
	 * @param PDO $pdo
	 * @param array $params
	 *
	 * @return void
	 */
	private function _bindParamValues($sth, $params) {
		foreach ($params as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
	}
}
