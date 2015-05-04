<?php  
session_start(); 

//Turn on error reporting
ini_set('display_errors', 'On');

include_once 'functions.php';


	if (array_key_exists("uname", $_REQUEST) && array_key_exists("password", $_REQUEST)) {
		
		
		 //prepare a statement searching for where a username and password combo exist
       	if (!($stmt = $mysqli->prepare("SELECT l_name, l_password FROM login WHERE l_name=? AND l_password=?"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		$user_name = htmlspecialchars($_REQUEST["uname"]);
		$user_pword = htmlspecialchars($_REQUEST["password"]);
		
        //bind the parameters received from the form
        if(!($stmt->bind_param("ss",$user_name ,$user_pword))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }
		
        //execute the statement
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        //bind results to variables
        if (!$stmt->bind_result($user_name, $user_pword)) {
            echo "Error binding result: (" . $stmt->errno . ") " . $stmt->error;
        }

        //if I am able to fetch this row, then set my session id and session name from correct variables
        if($stmt->fetch()) {
            $_SESSION['seshname'] = $user_name;
			echo "Success";
		}
        //else echo that that password/username combo is invalid
        else {
			
            echo "Invalid username or password.  Please try again or create a new account.";
        }
		
	}
    
?>	
 