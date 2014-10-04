<?php
require_once("class_database.php");

class User{
	public function __construct(){
		$this->database = new Database();
	}

	public function initSession(){
		$_SESSION['uid'] = uniqid();
	}

	public function hasUserVoted($uid){
		$check = $this->database->fetchFromTable("votes", "uid", $uid);
		$voteCount = count($check);
		return $voteCount >= 1;
	}
}