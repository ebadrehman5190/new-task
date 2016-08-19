<!doctype html>
<html>
<head>

<title>
Sign up form
</title>

</head>
<body>
    <script src="http://localhost/php/newtask/signup_validation.js"></script>

<?php    
$user=$fullname=$email=$pwd=$country=$birthday=$gender=$admin=$message="";
?>    

<a href="login1.php">Back</a>    
    <form name="Registration" class="form_title" action="" method="POST" onSubmit="return validation()">
	<fieldset class="field_set">
	<legend><h1>Sign up form</h1></legend>
		<table>
			<tr>
                <td>Username:</td>
                <td><input type="text" name="user" id="user"></td>
				<td><span id="var_user" style="color:red;"></span></td>
            </tr>
            <tr>
                <td>FullName:</td>
                <td><input type="text" name="name" id="name"></td>
				<td><span id="var_name" style="color:red;"></span></td>
            </tr>
             <tr>
                <td>Email:</td>
                <td><input type="email" name="email" id="email"></td>
				<td><span id="var_email" style="color:red;"></span></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password"></td>
				<td><span id="var_password" style="color:red;"></span></td>
            </tr>
            <tr>
                <td>ConfirmPassword:</td>
                <td><input type="password" name="cpassword" id="cpassword"></td>
				<td><span id="var_cpassword" style="color:red;"></span></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><input type="radio" name="gender" id="gender" value="Male">Male
                    <input type="radio" name="gender" id="gender1" value="Female">Female</td>
				<td><span id="var_gender" style="color:red;"></span></td>	
            </tr>
            <tr>
				<td>Admin type:</td>
				<td><input type="radio" name="admin" id="admin" value="Admin">Admin
					<input type="radio" name="admin" id="admin2" value="User">User</td>
				<td><span id="var_admin" style="color:red;"></span></td>	
			</tr>
            <tr>
				<td><input type="submit" value="submit" ></td>
			</tr>
        </table> 
		<?php
		
		if($_POST){
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "test";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				//$select = mysqli_select_db('test');
				mysqli_select_db($conn,"test");
				$new = "INSERT INTO selected_members (User, Member_name, Email, Password, Gender, Admin)
				VALUES ('".$_POST['user']."','".$_POST['name']."', '".$_POST['email']."', '".$_POST['password']."', '".$_POST['gender']."', '".$_POST['admin']."')";

				if ($conn->query($new) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

		echo "<br>";
		echo $user;
		echo "<br>";
		echo $fullname;
		echo "<br>";
		echo $email;
		echo "<br>";
		echo $pwd;
		echo "<br>";
		echo $cpwd;
		echo "<br>";
		echo $gender;
		echo "<br>";
		echo $admin;
		echo "<br>";
		
		$conn->close();

		}
				
		?>
    </fieldset>
</form>                       
</body> 
</html>   