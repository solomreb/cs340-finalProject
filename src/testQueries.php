INSERT INTO dogs_walkers VALUES ((SELECT walkers.walker_id, dogs. FROM ), (SELECT dogs.dog_id) FROM );


SELECT w.walker_id, t.time_id, d.dog_id FROM walkers w 
	INNER JOIN walkers_time wt ON w.walker_id = wt.walker_id 
	INNER JOIN time_slots t ON wt.time_id = t.time_id
	INNER JOIN dogs_time dt ON t.time_id = dt.time_id
	INNER JOIN dogs d ON dt.dog_id = d.dog_id
	WHERE wt.time_id = dt.time_id
	
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
			<tr style="height: 30px">
				<td>Morning</td>
				<td><input type="checkbox" name="a" value="1"/></td>
				<td><input type="checkbox" name="b" value="4"/></td>
				<td><input type="checkbox" name="c" value="7"/></td>
				<td><input type="checkbox" name="d" value="10"/></td>
				<td><input type="checkbox" name="e" value="13"/></td>
				<td><input type="checkbox" name="f" value="16"/></td>
				<td><input type="checkbox" name="g" value="19"/></td>
			</tr>
			<tr style="height: 30px">
				<td>Afternoon</td>
				<td><input type="checkbox" name="h" value="2"/></td>
				<td><input type="checkbox" name="i" value="5"/></td>
				<td><input type="checkbox" name="j" value="8"/></td>
				<td><input type="checkbox" name="k" value="11"/></td>
				<td><input type="checkbox" name="l" value="14"/></td>
				<td><input type="checkbox" name="m" value="17"/></td>
				<td><input type="checkbox" name="n" value="20"/></td>
			</tr>
			<tr style="height: 30px">
				<td>Evening</td>
				<td><input type="checkbox" name="o" value="3"/></td>
				<td><input type="checkbox" name="p" value="6"/></td>
				<td><input type="checkbox" name="q" value="9"/></td>
				<td><input type="checkbox" name="r" value="12"/></td>
				<td><input type="checkbox" name="s" value="15"/></td>
				<td><input type="checkbox" name="t" value="18"/></td>
				<td><input type="checkbox" name="u" value="21"/></td>
			</tr>
				<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="submit"/></td>
			</tr>
		</tbody>
	</table>
</form>
</div>


<?php
function displayTable($avail){	
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
	echo "<tr><td>Morning</td>";
for($i=1; $i<22; $i+=3){
	if (array_key_exists($i, $avail)){
		echo "<td><input type='checkbox' checked name='time" . $i . "value=" . $i . "/></td>";
	}
	else {
		echo "<td><input type='checkbox' name='time" . $i . "value=" . $i . "/></td>";
	}
}
	echo "</tr><tr><td>Afternoon</td>"
for($i=2; $i<22; $i+=3){
	if (array_key_exists($i, $avail)){
		echo "<td><input type='checkbox' checked name='time" . $i . "value=" . $i . "/></td>";
	}
	else {
		echo "<td><input type='checkbox' name='time" . $i . "value=" . $i . "/></td>";
	}
}
	echo "</tr><tr><td>Evening</td>"
for($i=3; $i<22; $i+=3){
	if (array_key_exists($i, $avail)){
		echo "<td><input type='checkbox' checked name='time" . $i . "value=" . $i . "/></td>";
	}
	else {
		echo "<td><input type='checkbox' name='time" . $i . "value=" . $i . "/></td>";
	}
}
echo <<<END
				</tr><tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="submit value='Save'"/></td>
			</tr>
		</tbody>
	</table>
</form>
</div>
END;
}
displayTable($avail);
?>