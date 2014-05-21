<!DOCTYPE HTML>
<html lang="en">
  <head>
	<title>Registration Page</title>
    <meta charset="utf-8" />
	<meta name="description" content="Assignment 2" />
	<meta name="keywords" content="PHP programming" />
	<meta name="Author content="Shuxiao Zhang" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- Description: User Registration  -->
	<!-- Author: Shuxiao Zhang -->
	<!-- Date: 20/05/2014 -->
	<!-- Validated: OK 20/05/2014 -->
  </head>
  <body>
  	<h1 align = 'center'>My Status System</h1>
  	<h1 align = 'center'>Registration Page</h1>
  	<br />
	<form action="signup.php" method ="post">
	  Email <input type="text" name = email >
	  <br />
	  Profile Name <input type="text" name = pname >
	  <br />
	  Password <input type="password" name = psw>
	  <br />
	  Confirm Password <input type="password" name = cpsw>
	  <br />
	  <input type="submit" value="Register">
	  <input type="reset" value="Reset">
	</form>
	<br />
 	<?php
 	
 	session_set_cookie_params(3600);
  	session_start();

 	if ((isset($_POST['email']) && $_POST['email']!=NULL)) {
		//connect to database
		$email = $_POST["email"];
		$pname = $_POST["pname"];
		$psw = $_POST["psw"];
		$cpsw = $_POST["cpsw"];
		if (preg_match("/^.+@.+\..{2,3}$/", $email)){
		  if (preg_match("/^[a-zA-z]+$/", $pname)){
			if (preg_match ("/[A-Za-z0-9]+$/", $psw)){
			  if ($psw ===$cpsw){
				$dbConnect = @mysqli_connect("localhost", "root", "zen3zit3"); 
				if (!$dbConnect)
				  die("<p>The database server is not available.</p>"); 
				echo "<p>Successfully connected to the database server.</p>"; 
				$dbSelect = @mysqli_select_db($dbConnect, "s_7493975_db");
				mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', '$email', '$psw', '$pname')");
				$_SESSION['name'] = $pname;
				header('Location: statuspost.php');
			  }
			  else
					echo "Passwords did not match.";	
			}
			else 
				echo "Password must contain only letters and numbers.";
		  }
		  else
			echo "Profile name should be string of letters.";
		}     
		else{    
		  echo "This is not a valid email address"; 
		  } 
	}	
 	?>
 	<br />
 	<a href="index.php">Home</a> 
  </body>
</html>