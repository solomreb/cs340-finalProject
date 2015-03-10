<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

<script type="text/javascript">
    function validateForm(formName)
    {
        var field = document.getElementById(formName).elements;
        for(var i = 0; i < field.length-1; i++)
        {
        	if (field[i].value == null || field[i].value == ''){
        		alert(field[i].name + " must be filled in. ");
        		return false;
        	}
        } 

    }
</script>
</head>
<body>
	<h2>Dog Database</h2>
	<fieldset style="width:250px">
	<legend> Login </legend>
    <form method="post" action="sessions.php" id="loginForm" name="loginForm" onsubmit=" return validateForm(this.id);">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><b>
        <br />
        <input type="submit" value="Login" " /> 
    </form>
    </fieldset>
</body>
</html>
