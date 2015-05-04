<?php

ini_set('display_errors', 'On');
include 'functions.php';

session_start();


if ($_POST) {
	//prepare a statement to delete a num
 	if (!($stmt = $mysqli->prepare("DELETE FROM events WHERE e_num=?"))) { //and username = seshname
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	$num = htmlspecialchars($_REQUEST["number2"]);	
	
    //bind the parameters received from the form
    if(!($stmt->bind_param("s",$num))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
    }
		
    //execute the statement
    if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
		
	echo 'Success';
		
    $stmt->close();
}
?>

