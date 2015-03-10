<!DOCTYPE html>
<html>

<head>
	<script>
function validateForm() {
	var form = document.forms[0];
	var i;
	for(i=0; i<form.length; i++){
		var field = form.elements[i].value;
		document.write(field.getAttribute('name'));
		if (field == null || field == "") {
			//alert(field.getAttribute('name') + " must be filled out");
			return false;
		}
	}
}
</script>
	<meta charset="UTF-8">
	<title>CS 290 Final Project</title>
	<style>
		table, th, td {
	    	border: 1px solid black;
		}
		.error {color: red;}
	</style>
<h2> Dog Walking Database </h2>
</head>

<body>

<?php
include 'storedInfo.php';
include 'functions.php';
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "solomreb-db", $myPassword,"solomreb-db");
if (!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }

?>

<form  name="addForm" method="get" onsubmit="return validateForm()">
 <fieldset>
  <legend>Add Dog:</legend>
	Name: <input type="text" name="name" id="nameInput">
	Breed: 
	<?php 
	$breeds = mysqli_query($mysqli,'SELECT DISTINCT breed_description FROM breeds ORDER');
	echo "<select name='category'>";
		while ($item = mysqli_fetch_array($breeds)) {
		if ($item['breed_description'] == '')
			break;
		echo "<option value='".$item['breed_description']."'>".$item['breed_description']."</option>";
	}
	echo "</select>";
	?>
	Owner First Name: <input type="text" name="fname" id=ownerFNameInput>
	Owner Last Name: <input type="text" name="lname" id=ownerLNameInput>
    <input type="submit" value="Add">
<br>	
</form>


<?php 
	$dogsClientsquery= "SELECT d.name AS dog_name, c.fname AS client_fname, c.lname AS client_lname, c.address AS address, c.phone AS phone FROM clients c INNER JOIN dogs d ON c.client_id = d.owner_id";
	displayDogs($mysqli, $dogsClientsquery ); 
?>
<form method="get" action="deleteAll.php">
 <fieldset>
  
    <input type="submit" value="edit">
 </fieldset>
	
</form>

</body>
</html>