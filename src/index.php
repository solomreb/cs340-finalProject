<?php
include 'storedInfo.php';
session_start();
$walker_id = $_SESSION['walker_id'];
$username = $_SESSION['username'];
echo "Logged in as " . $username . "<br>";
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
?>

<!DOCTYPE html>
<html>
<!-- index.php -->
<head>
  	<title>Dog Walking Database</title>
  	<meta charset="utf-8">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
      <h2>Dog Walking Database</h2>

        <p class="navbar-text navbar-right"><a href="logout.php" class="navbar-link">Log out</a></p>       

    </div>
<div class="container-fluid">
<?php

$query = "SELECT time_id FROM walkers_time WHERE walker_id = '$walker_id'";

	if (!($stmt = mysqli_query($mysqli, $query))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
echo <<<END
<form name="walkerAvailabiity" method="get" action="editAvailability.php">
	<table>
		<thead><h3>Select your availability</h3>
			<tr style="height: 30px">
				<th style="width: 10%;"></th>
				<th style="width: 10%;">Sunday</th>
				<th style="width: 10%;">Monday</th>
				<th style="width: 10%;">Tuesday</th>
				<th style="width: 10%;">Wednesday</th>
				<th style="width: 10%;">Thursday</th>
				<th style="width: 10%;">Friday</th>
				<th style="width: 10%;">Saturday</th>
			</tr>
		</thead>
		<tbody> 
END;
	echo "<tr height='25px'><td>Morning</td>";
$avail = [];
while ($row = mysqli_fetch_array($stmt)) {
	$slot = $row['time_id'];
	$avail[$slot] = 1;
}
for($i=1; $i<22; $i+=3){
	if (array_key_exists($i, $avail)){
		echo "<td><input type='checkbox' checked name='" . $i . "' value='" . $i . "'></td>";
	}
	else {
		echo "<td><input type='checkbox' name='" . $i . "' value='" . $i . "'></td>";
	}
}
	echo "</tr><tr height='25px'><td>Afternoon</td>";
for($i=2; $i<22; $i+=3){
	if (array_key_exists($i, $avail)){
		echo "<td><input type='checkbox' checked name='" . $i . "' value='" . $i . "'></td>";
	}
	else {
		echo "<td><input type='checkbox' name='" . $i . "' value='" . $i . "'></td>";
	}
}
	echo "</tr><tr height='25px'><td>Evening</td>";
for($i=3; $i<22; $i+=3){
	if (array_key_exists($i, $avail)){
		echo "<td><input type='checkbox' checked name='" . $i . "' value='" . $i . "'></td>";
	}
	else {
		echo "<td><input type='checkbox' name='" . $i . "' value='" . $i . "'></td>";
	}
}
echo <<<END
				</tr><tr height='35px'>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</tbody>
	</table>
</form>
</div>
END;
?>

</div>
</body>
</html>