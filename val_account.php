<?php

ini_set('display_errors', 'On');
include 'functions.php';

session_start();
if ($_POST) {
	if (array_key_exists("uname", $_REQUEST) && array_key_exists("password", $_REQUEST)) {
	
		if (!($stmt = $mysqli->prepare("SELECT l_name FROM login WHERE l_name=?"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$user_name = htmlspecialchars($_REQUEST["uname"]);
		$user_pword = htmlspecialchars($_REQUEST["password"]);
				
		//bind the parameters received from the form
        if(!($stmt->bind_param("s",$user_name))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }
		
        //execute the statement
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        //bind results to variables
        if (!$stmt->bind_result($user_name)) {
            echo "Error binding result: (" . $stmt->errno . ") " . $stmt->error;
        }
		  
		    	
	    if(!$stmt->fetch()) {
			$stmt->close();
			
			//$result = mysqli_query($mysqli, "INSERT INTO login (l_name, l_password) VALUES ('{$user_name}', '{$user_pword}')");
			if (!($stmt = $mysqli ->prepare( "INSERT INTO login (l_name, l_password) VALUES (?,?)"))){
				echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			
			$user_name = htmlspecialchars($_REQUEST["uname"]);
			$user_pword = htmlspecialchars($_REQUEST["password"]);
			
			if(!($stmt->bind_param("ss",$user_name, $user_pword))){
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
		
			//execute the statement
			if (!$stmt->execute()) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			$stmt->close();
			
			 //Start a session with the new username.
		    $_SESSION['seshname'] = $user_name;
		    echo "SUCCESS";
		       
		} 

		else {
			echo "Sorry, that username already exists.";
			    	//return false;
		}
		    
}	
 else {
	header("Location: account.php");	//return user to account.php if no post
	//return false;
}
}
?>