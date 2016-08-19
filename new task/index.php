<?php
include('index1.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: Entry.php");
}
?>

<doctype html>
<html>
<head>

	<title>Login Page</title>
	<link rel="stylesheet" href="styles.css">
	<style>
		
		body {
		background-image: url("images/SMWpCenterPinch.png");
		}
		
	</style>
</head>
<body>
<form action="" method="POST" onSubmit="return revalidate()">
	<fieldset class="field_set">
	<h1>Login</h1>
	<table>
		<tr>
			<td><b>User:</td>
			<td><input type="text" name="user" id="user"></td>
		</tr>
		
		<tr></tr>
		
		<tr>
			<td><b>Password:</td>
			<td><input type="password" name="password" id="password"></td>
		</tr>
		
		<tr>
			<td><input type="submit" name="login" value="Login"></td>
            <td><a href="signup.php">Signup</a></td>
        </tr>
        <tr>  
            <td></td>  
			<td><span class="error"><?php echo $error; ?></span></td>
		</tr>
	</table>	
	</fieldset>

	</form>
	</body>
</html>