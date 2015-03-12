<?php 
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$username = trim($_POST["username"]);

//check if username is blank
if ($username == "") {
	echo "Username must be filled in"; 
}

//if not blank, check the database for that username
else {

	$query = "select username from users where username = ? ";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param('s',$username);
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;

 	if($numRows > 0)
		echo "Sorry, username \"".$username."\" is already in use";
	else
		echo "Username \"".$username."\" is available";
}


	

?>