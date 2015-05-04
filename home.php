<?php session_start(); 

//Turn on error reporting
ini_set('display_errors', 'On');

include_once 'functions.php';
if (!isset($_SESSION['seshname'])) {
	header("Location: login.php");	
	
}

?>

<!DOCTYPE HTML>
<!--
CS494 Final Project
Barbara Hazlett
8/31/2014
-->
<html>
<head>
  <meta charset="UTF-8">
  <title>Homepage for Marys River Rowers</title>
  <link href="styles.css" type="text/css" rel="stylesheet" />
  <script type="text/javascript" src="jquery.js"></script>
  <script src="livevalidation_standalone.compressed.js"></script>
<body>

<div class = 'wrapper'>
<div class = "logo"></div>
<h3>Marys River Rowing Club</h3>
<div id="content" class = 'menu' >
<p>
<button type="button" onclick="window.location.href='home.php'">Home</button>
<button type="button" onclick="window.location.href='add.php'">Add Event</button>
<button type="button" onclick="window.location.href='delete.php'">Delete Event</button>
<button type="button" onclick="window.location.href='map.php'">Get Map</button>
<button type="button" onclick="window.location.href='logout.php'">Log Out</button>
</p>
</div>
<?php
echo "<div class = 'welcome'>Welcome ".$_SESSION['seshname']."!</div>";
?>
<h2>Here are the events that you are currently signed up for:</h2>

<?php

$uname = $_SESSION['seshname'];
if (!($stmt = $mysqli->prepare("SELECT e_num, e_event, e_time, e_date, e_location FROM events WHERE e_name='$uname'"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
if (!$stmt->execute()) {
    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$out_num = NULL;
$out_event = NULL;
$out_time = NULL;
$out_date = NULL;
$out_location = NULL;

if (!$stmt->bind_result($out_num, $out_event, $out_time, $out_date, $out_location)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "<table border=1 class = 'tbl'>
<tr>
<th>Number</th>
<th>Event</th>
<th>Time</th>
<th>Date</th>
<th>Location</th>
</tr>";

$sum = 0;

while ($stmt->fetch()) {
echo "<tr>";
echo "<td>".$out_num."</td>";
echo "<td>".$out_event."</td>";
echo "<td>".$out_time."</td>";
echo "<td>".$out_date."</td>";
echo "<td>".$out_location."</td>";
echo "</tr>";

}
echo "</table><br>";

$stmt->close();	

?>
</div>
</body>
</html>

