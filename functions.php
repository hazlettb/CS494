<?php
$dbhost = '';
$dbname = 'hazlettb-db';
$dbuser = 'hazlettb-db';
$dbpass = '';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_error) die($mysqli->connect_error);

function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }
?>