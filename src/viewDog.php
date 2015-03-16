<!DOCTYPE html>
<html>
  <head>
    <style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng(45.569612, -122.667468);
  var mapOptions = {
    zoom: 13,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
<?php
session_start();
$walker_id = $_SESSION['walker_id'];
$username = $_SESSION['username'];
?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<div class="container">
<p class="navbar-text navbar-right"><?php echo "Logged in as '" . $username . "' | ";?><a href="logout.php" class="navbar-link">Log out</a></p> 
</div>
<ul class="pager">
        <li class="previous"><a href="index.php">Back</a></li>
</ul>
<div class="container">
<?php
//viewDog.php
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
    
$row = $_GET["dogid"];

if (!($stmt = mysqli_query($mysqli, "SELECT d.name AS Name, b.breed_description as Breed, sn.sn_description as Notes, c.fname as FName, c.lname as LName, c.address as Address, c.phone as Phone FROM dogs d 
 INNER JOIN breeds b ON d.breed_id=b.breed_id 
 INNER JOIN dogs_special_needs dsn ON d.dog_id=dsn.dog_id
 INNER JOIN special_needs sn ON dsn.sn_id=sn.sn_id  
 INNER JOIN clients c ON c.client_id = d.owner_id WHERE d.dog_id='$row'"))) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

echo " <table class='table table-hover'>			
		<thead><h3>Your dogs</h3>	
			<tr style='height: 30px'>	
				<th style='width: 10%;'>Name</th>
				<th style='width: 10%;'>Breed</th>
				<th style='width: 10%;'>Client</th>
				<th style='width: 10%;'>Address</th>
				<th style='width: 10%;'>Phone</th>
				<th style='width: 10%;'>Notes</th>
			</tr>
		</thead>";

while ($row = mysqli_fetch_array($stmt)) {
		
		echo "<tr>";
		echo "<td>" . $row['Name'] . "</td>";
		echo "<td>" . $row['Breed'] . "</td>";
		echo "<td>" . $row['FName'] . " " . $row['LName'] ."</td>";
		echo "<td>" . $row['Address'] . "</td>";
		echo "<td>" . $row['Phone'] . "</td>";
		echo "<td>" . $row['Notes'] . "</td>";
		echo "</tr>";
}

echo "</table>";
?>

<div id="map-canvas"></div>
</div>
</html>