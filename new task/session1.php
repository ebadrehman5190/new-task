<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn = mysqli_connect('localhost','root','','test');
// Selecting Database
		mysqli_select_db($conn,"test");
		session_start();// Starting Session
// Storing Session
		$user_check = $_SESSION['login_user'];
		
// SQL Query To Fetch Complete Information Of User
        $sql=("SELECT * FROM selected_members WHERE User='$user_check' ");

		$ses_sql=mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($ses_sql);
		
			$login_session =$row['User'];
			
			if(!isset($login_session)){
			$conn->close(); // Closing Connection
			header('Location: index.php'); // Redirecting To Home Page
			}


?>