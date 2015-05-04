<?php
  session_start();
  if (isset($_SESSION['seshname'])) header("Location: home.php");
?>
<!DOCTYPE html>
<!--
CS494 Final Project
Barbara Hazlett
8/31/2014
-->
<html>
<head>
<title>CS494 Final Project - Create an account Page</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="jquery.js"></script>
<script src="livevalidation_standalone.compressed.js"></script>
</head>
<body>

<div class ='wrapper'>
<div class = "logo"></div>
<h3>Marys River Rowing Club</h3>
<div class = 'main'><h2>Please enter a username (4 characters mininum) and password (8 mininum/12 maximum characters) for your new account:</h2></div>


<form method = 'POST' action = 'account.php'>
<span class = 'fieldname'>Username</span><input type = 'text'
	 name = 'uname' id = 'uname' /><br>
<span class = 'fieldname'>Password</span><input type = 'password'
	 name = 'password' id = 'password'  />
<br>
<span class = 'fieldname'>Confirm Password</span><input type = 'password'
	 name = 'c_password' id = 'c_password'  />
<br><br>
<button type="button" class = "bttn" id = "Account">Create Account</button><br>
</form><br>
<div id = 'error' class = 'errorfield' ></div><br>
</div>
<script>
var val_name = new LiveValidation('uname',{validMessage: 'Length ok', wait:500}); 
val_name.add(Validate.Presence, {failureMessage: "Must be at least 4 characters."});
val_name.add(Validate.Length, {minimum: 4, maximum: 12});

var val_pw1 = new LiveValidation('password', {validMessage: 'Good', wait:500});
val_pw1.add(Validate.Presence, {failureMessage: "Must be at least 8 characters."}); 
val_pw1.add(Validate.Length, {minimum: 8, maximum: 12});

var val_pwc = new LiveValidation('c_password', {validMessage: 'Match', wait:500});
val_pwc.add(Validate.Confirmation, { match: 'password'} ); 

$('#Account').on('click', function() {
$("#error").empty();
if ($('#uname').val().length > 3 && $('#password').val().length > 7 && $('#password').val().length < 13){
  $.ajax({
    type: "POST",
    url: "val_account.php",
    data: {uname: $('#uname').val(),
    password: $('#password').val(),
    }
}).done(function(result, info){
  var result=trim(result);
  if(result == "SUCCESS") {
    window.location = "home.php";
  } else {
    $("#error").empty();
    $("#error").append(result);       
  }
}).fail(function(jqXHR, statusCode, errorThrown) {
  $("#error").empty();
  $("#error").append("The error message was: " + errorThrown + "");
  }); 
 }
/*else
  $("#error").empty();
  $("#error").append('Please fix input errors.'); */	
});

function trim(str){
var str=str.replace(/^\s+|\s+$/,'');
return str;
}

</script>
</body>
</html>