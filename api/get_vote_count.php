<?php
	require_once("class/class_party.php");

	$party = new Party();

	$allCount = $party->getAllPartyVoteCount();

	echo json_encode($allCount);
	

?>
