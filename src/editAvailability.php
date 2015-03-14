<?php
session_start();
include 'storedInfo.php';
//header('Location: index.php');

//$username= $_SESSION["username"];
//$walker_id = $_SESSION["walker_id"];

//establish connection
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }     
    
    
//delete previous entries for this usern
$sqlQuery= "DELETE from walkers_time WHERE walker_id = '$walker_id'";
$stmt = $mysqli->prepare($sqlQuery);
$stmt->execute();
$stmt->close();

$sqlQuery= "INSERT INTO  walkers_time(walker_id, time_id) VALUES ('$walker_id', ?);";	

foreach ($_GET as $name){
	$avail = $name;
	echo $name . " " . $avail . "<br>";
	$stmt = $mysqli->prepare($sqlQuery);
	$stmt->bind_param('i', $avail);
	$stmt->execute();
	$stmt->close();
}

//execute prepared statement

echo "<br>";
printf("%d Row inserted.\n", $stmt->affected_rows);

?>
