<?php
chdir('/var/jamesheald/mockelection/');
require_once("./api/config/conf.php");

$database = new PDO('mysql:host=localhost;dbname='. DBNAME .';charset=utf8', USERNAME, PASSWORD);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
