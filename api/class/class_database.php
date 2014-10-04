<?php
require_once("mysql.php");

class Database{
	public function __construct(){
		$this->database = $GLOBALS['database'];
	}

	public function query($query, $array){
		$query = $this->database->prepare($query);
		
		$result = $query->execute($array);
		
		return $result;
	}

	public function fetchAllFromTable($table){
		$fetchAllQuery = $this->database->query("SELECT * FROM " . $table);
		
		$result = $fetchAllQuery->execute();
		$result = $fetchAllQuery->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function fetchFromTable($table, $where, $equals){
		$fetchFrom = $this->database->prepare("SELECT * FROM ". $table ." WHERE ". $where . " = ?");
		
		$result = $fetchFrom->execute(array($equals));
		$result = $fetchFrom->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function fetchAllWhere($table, $where){
		$fetchAllWhere = $this->database->query("SELECT * FROM " . $table . " WHERE " . $where);
		
		$result = $fetchAllWhere->execute();
		$result = $fetchAllWhere->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}