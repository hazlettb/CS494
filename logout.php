<!--
CS494 Final Project
Barbara Hazlett
8/31/2014
-->

<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'Off');  //On or Off
include_once 'functions.php';

session_start();

if (isset($_SESSION['seshname'])) {
	destroySession();
	echo "<div class = 'main'>You have been logged out.";
}
else echo "<div class = 'main'>You cannot log out because you are not logged in.";

?>
