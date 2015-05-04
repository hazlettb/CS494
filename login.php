<?php  
session_start(); 

//Turn on error reporting
ini_set('display_errors', 'On');

include_once 'functions.php';
?>
<!DOCTYPE html>
<!--
CS494 Final Project
Barbara Hazlett
8/31/2014
-->
<html>
<head>
<title>CS494 Final Project - Login Page</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="livevalidation_standalone.compressed.js"></script>
</head>

<body>
<div class ='wrapper'>
<div class = "logo"></div>
<h3>Marys River Rowing Club</h3>
<div class = 'main'><h2>Please enter your details to log in:</h2></div>
<form method = 'POST' action = 'login.php'>
<span class = 'fieldname'>Username</span><input type = 'text'
	 name = 'uname' id = 'uname' /><br>
<span class = 'fieldname'>Password</span><input type = 'password'
	 name = 'password' id = 'password'  />
<br><br>
<button type="button" class = "bttn" id = "Login">Log In</button><br>
</form><br>
<div id = 'error' class = 'errorfield'></div><br><br>

<a href="account.php" >Create a new account</a><br>

<script src="jquery.js"></script>

<script type= "text/javascript">

//code for button click
$('#Login').on('click',function()
  {
	$.ajax({
             url:"val_login.php",
             type:"POST",
             data: {password:$("#password").val(),uname:$("#uname").val(),           
			}	
			 
    }).done(function(result, info){
		var result=trim(result);
		if(result == 'Success') {
			window.location = "home.php";
			$('#error').empty();
			$('#error').append('yeah!');
		}
		else {
		$('#error').empty();
		$('#error').append(result);
		$('#uname').empty();
		$('#password').empty();
		}
	}).fail(function(jqXHR, statusCode, errorThrown) {
		$('#error').empty();
		$('#error').append('The error message is: '+ errorThrown + "");
		
   });       
});

var val_name = new LiveValidation('uname',{validMessage: 'Good', wait:500}); 
val_name.add(Validate.Presence, {failureMessage: 'Must be at least 4 characters.'});
val_name.add(Validate.Length, {minimum: 4, maximum: 12});

var val_pw1 = new LiveValidation('password', {validMessage: 'Good', wait:500});
val_pw1.add(Validate.Presence, {failureMessage: "Must be at least 8 characters."}); 
val_pw1.add(Validate.Length, {minimum: 8, maximum: 12});

function trim(str){
var str=str.replace(/^\s+|\s+$/,'');
return str;
}
</script>
</div>
</body>
</html>

