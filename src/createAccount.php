<?php
include 'storedInfo.php';
//header('Location: index.php');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
    
$username = $_POST["userName"];  
$pwd = $_POST["password"];

echo $username;
echo $pwd;

$sqlQuery= "INSERT INTO  `solomreb-db`.`users` VALUES ( ?, ?);";	
$stmt = $mysqli->prepare($sqlQuery);
$stmt->bind_param('ss',$username, $pwd);


//execute prepared statement
$stmt->execute();
printf("%d Row inserted.\n", $stmt->affected_rows);

?>