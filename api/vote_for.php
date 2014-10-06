<?php
require_once("class/class_party.php");
require_once("class/class_user.php");

session_start();

$user = new User();

if(!isset($_SESSION['voted'])){
	$_SESSION['voted'] = "true";
	$user->initSession();
} else{
	echo json_encode(["error"=>"already_voted"]);
	return;
}

$partyName = $_GET['vote'];
$party = new Party();
$uid = $_SESSION['uid'];

$party->voteForParty($partyName, $uid, '0000-00-00');
