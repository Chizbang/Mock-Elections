<?php
	require_once("class/class_party.php");

	$party = new Party();
	$voteCount = [];

	$allCount = $party->getAllPartyVoteCount();

	echo json_encode($allCount);
	

?>