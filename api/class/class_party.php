<?php
	require_once("class_database.php");

	class Party{
		public function __construct(){
			$this->database = new Database();
		}

		public function getAllParties(){
			$allParties = $this->database->fetchAllFromTable("parties");

			return $allParties;
		}

		public function getPartyByName($name){
			$specificParty = $database->fetchFromTable("parties", "name", $name);

			return $specificParty;
		}

		public function voteForParty($party, $uid, $date){
			$votefor = $this->database->query("INSERT INTO votes (`id`, `party`, `uid`, `date`) VALUES (NULL, ?, ?, ?)", array($party, $uid, $date));
			return $votefor;
		}

		public function getPartyVoteCount($party){
			$votes = $this->database->fetchFromTable("votes", "party", $party);

			return count($votes);
		}

		public function getAllPartyVoteCount(){
			$voteCount = [];
			
			foreach ($this->getAllParties() as $key) {
				$voteCount[] = ["party" => $key['name'], "votes" => $this->getPartyVoteCount($key['name'])];
			}

			return $voteCount;
		}
	}
?>