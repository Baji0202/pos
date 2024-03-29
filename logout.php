<?php
require_once ".\include\connect\dbcon.php";
include_once "admin_side\log.php";
session_start();
$loggeduser = $_SESSION["user_id"];
loghistory($pdoConnect,"Logged out, user_id: $loggeduser");
unset($_SESSION["user_id"]);
$loggeduser = null;
$pdoConnect = null;
session_destroy();

header('location: index.php');
exit;
?>