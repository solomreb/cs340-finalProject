<?php 
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

define("ERR_INVALID_USERNAME", "1");
define("ERR_EXISTING_USERNAME", "2");
define("ERR_INVALID_PASSWORD", "3");
define("ERR_DIFFERENT_PASSWORDS", "4");

$errors = array ();

if (isset ($_POST["userName"])) {
    $username = $_POST["userName"];
    $len = strlen ($username);
    if ($len < 2 || $len > 20) {
        array_push ($errors, ERR_INVALID_USERNAME);
    }
    else {

    //if username already exists, send error message
		$query = "select username from users where username = ? ";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param('s',$username);
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($stmt->num_rows>0){
			array_push ($errors, ERR_EXISTING_USERNAME);
		}	  
    }
}
else {
    array_push ($errors, ERR_INVALID_USERNAME);
}

if (isset ($_POST["password"])) {
    $password = $_POST["password"];
    $len = strlen ($password);
    if ($len < 6 || $len > 20) {
        array_push ($errors, ERR_INVALID_PASSWORD);
    }
    else {
        if (!isset ($_POST["repassword"]) || strcmp ($password, $_POST["repassword"]) != 0) {
            array_push ($errors, ERR_DIFFERENT_PASSWORDS);
        }
    }
}
else {
    array_push ($errors, ERR_INVALID_PASSWORD);
}

$response = "";
if (sizeof ($errors) > 0) {
    $response = implode (",", $errors);
}
else {
        // some db operations, save username and password ...
    
    $response = "ok";
}

echo ($response);	

?>