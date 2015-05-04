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
  <title>Get Map Page</title>
  <link href="styles.css" type="text/css" rel="stylesheet" />
  <script type="text/javascript" src="jquery.js"></script>
  <script src="livevalidation_standalone.compressed.js"></script>
<body>

<div class = 'wrapper'>
<div class = "logo"></div>
<h3>Marys River Rowing Club</h3>
<div id="content" class = 'menu'>
<p>
<button type="button" onclick="window.location.href='home.php'">Home</button>
<button type="button" onclick="window.location.href='add.php'">Add Event</button>
<button type="button" onclick="window.location.href='delete.php'">Delete Event</button>
<button type="button" onclick="window.location.href='map.php'">Get Map</button>
<button type="button" onclick="window.location.href='logout.php'">Log Out</button>
</p>
</div>
<h2>Maps for the most popular event locations:</h2>
<form>
<select id='select' class = 'sel'>
<option value='natoma'>Lake Natoma, CA</option>
<option value='burnaby'>Burnaby Lake, Canada</option>
<option value='vancouver'>Vancouver Lake, WA</option>
<option value='wash'>Lake Washington, WA</option>
</select>
</form>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCcXoFIcfCpa6x3jYbmuMIeh5WZjbaAoiI&sensor=false">
</script>

<script>

function createMap()
{
	var loc = $('#select').val();
		
	if (loc == 'natoma'){
		latc = 38.653497;
		lngc = -121.193229;
	}
	else if (loc == 'burnaby'){
		latc = 49.242733;
		lngc = -122.944651;
	}
	else if (loc == 'wash'){
		latc = 47.647594;
		lngc = -122.304225;
	}
	else {
		latc = 45.674657;
		lngc = -122.727935;
	}
	var mapProp = {
		center:new google.maps.LatLng(latc,lngc),
		zoom:12,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map=new google.maps.Map(document.getElementById("googleMap")
	,mapProp);
  
}

</script>

<div><input type = "submit" onclick ="createMap()" value = "Display Map" class = "display"></div><br>
<div id="googleMap" class = 'map' style="width:500px;height:380px;" ></div>


</div>
</body>
</html>

