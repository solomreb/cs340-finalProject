<?php
include 'storedInfo.php';
//header('Location: index.php');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
else{
	console.log( "connection successful");
	}


define("ERR_INVALID_FNAME", "1");
define("ERR_INVALID_LNAME", "2");
define("ERR_INVALID_PHONE", "3");
define("ERR_INVALID_EMAIL", "4");
define("ERR_INVALID_USERNAME", "5");
define("ERR_EXISTING_USERNAME", "6");
define("ERR_INVALID_PASSWORD", "7");
define("ERR_DIFFERENT_PASSWORDS", "8");


$errors = array ();

if (isset ($_POST["userName"])) {
    $username = $_POST["userName"];
    $len = strlen ($username);
    if ($len < 2 || $len > 20) {
        array_push ($errors, ERR_INVALID_USERNAME);
    }
    else {            // check the name of registered users
        $query = "select username from `solomreb-db`.`walkers` where username = ? ";
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

if (isset ($_POST["fname"])) {
    $fname = $_POST["fname"];
    $len = strlen ($fname);
    if ($len < 1) {
        array_push ($errors, ERR_INVALID_FNAME);
    }
}
if (isset ($_POST["lname"])) {
    $lname = $_POST["lname"];
    $len = strlen ($lname);
    if ($len < 1) {
        array_push ($errors, ERR_INVALID_LNAME);
    }
}
if (isset ($_POST["phone"])) {
    $phone = $_POST["phone"];
    $len = strlen ($phone);
    if((preg_match("/[^0-9]/", '', $phone)) && strlen($phone) == 10){
        array_push ($errors, ERR_INVALID_PHONE);
    }
}

if (isset ($_POST["email"])) {
    $email = $_POST["email"];
    $len = strlen ($email);
    if ($len < 7 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push ($errors, ERR_INVALID_EMAIL);
    }
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
    // 2 secs delay
sleep (2);

echo ($response);
?>