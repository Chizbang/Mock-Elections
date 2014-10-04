<?php
require_once("class/class_party.php");

$parties = new Party();

echo json_encode($parties->getAllParties());
