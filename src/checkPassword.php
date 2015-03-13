<?php 
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

define("ERR_INVALID_USERNAME", "5");



$errors = array ();

//username is set
if (isset ($_POST["userName"])) {
//username is set. check if it exists in the db
    $username = $_POST["userName"];

	$query = "select username from users where username = ? ";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param('s',$username);
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($stmt->num_rows<=0){
	//username does not exist in db
		array_push ($errors, ERR_INVALID_USERNAME);
	}	
	$stmt->close();  
}

else {
//no username entered
    array_push ($errors, ERR_INVALID_USERNAME);
}


if (isset ($_POST["password"])) {
//password is set. check if matches for username
    $password = $_POST["password"];
    
    $query = "select username from users where username = ? AND pwd = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param('ss', $username, $password);
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($stmt->num_rows<=0){
		//username/password combo does not exist in db
		array_push ($errors, ERR_INVALID_USERNAME);
	}
	$stmt->close();

}
else {
    array_push ($errors, ERR_INVALID_PASSWORD);
}

$response = "";
if (sizeof ($errors) > 0) {
    $response = implode (",", $errors);
}
else {
        // start session for given username ...
    
    $response = "ok";
}

echo ($response);	

?>