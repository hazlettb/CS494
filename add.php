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
  <title>Add Event Page</title>
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

echo "<a href = 'add.php'>Refresh Table</a>";
?>

<h2>Add Event</h2>
<form action ="add.php" method = "POST"> 
<span class = 'fieldname'>Number:</span><input type = "text" name = "number" id = "number"><br>
<span class = 'fieldname'>Event:</span><input type = "text" name = "event" id = "event"><br>
<span class = 'fieldname'>Time:</span><input type = "text" name = "time" id = "time"><br>
<span class = 'fieldname'>Date:</span><input type = "text" name = "date" id = "date"><br>
<span class = 'fieldname'>Location:</span><input type = "text" name = "location" id = "location"><br><br>
<input class = 'fieldname' type = "submit" name = "submit" value = "Add"></form><br><br>
<script>
var val_num = new LiveValidation('number',{validMessage: 'ok', wait:500}); 
val_num.add(Validate.Presence);

var val_event = new LiveValidation('event', {validMessage: 'ok', wait:500});
val_event.add(Validate.Presence, {failureMessage: "Must be at least 4 characters."}); 
val_event.add(Validate.Length, {minimum: 4, maximum: 24});

var val_time = new LiveValidation('time', {validMessage: 'ok', wait:500});
val_time.add(Validate.Presence); 

var val_date = new LiveValidation('date', {validMessage: 'ok', wait:500});
val_date.add(Validate.Presence, { failureMessage: "Must enter a date."} ); 

var val_location = new LiveValidation('location', {validMessage: 'ok', wait:500});
val_location.add(Validate.Presence, { failureMessage: "Must enter a location."} ); 
val_location.add(Validate.Length, {minimum: 2, maximum: 24});

</script>
<?php
//php for adding an event/activity
if(isset($_POST['submit'])){
	
if (!($stmt = $mysqli->prepare("INSERT INTO events(e_num, e_name, e_event, e_time, e_date, e_location) VALUES (?, ?, ?, ?, ?, ?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$num = htmlspecialchars($_POST['number']);
$event = htmlspecialchars($_POST['event']);
$time = htmlspecialchars($_POST['time']);
$date = htmlspecialchars($_POST['date']);
$location = htmlspecialchars($_POST['location']);


if (!$stmt->bind_param("ssssss", $num, $uname, $event, $time, $date, $location)) {
	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
		
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
echo ' '. $num.', '.$event.', '.$time. ', '. $date. ', '. $location.' has been successfully added to the database.<br><br>';

$stmt->close();

}
?>
<script>
</div>
</body>
</html>