<!DOCTYPE HTML>
<html lang="en">
  <head>
	<title>Login Page</title>
    <meta charset="utf-8" />
	<meta name="description" content="Assignment 2" />
	<meta name="keywords" content="PHP programming" />
	<meta name="Author content="Shuxiao Zhang" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- Description: Register user -->
	<!-- Author: Shuxiao Zhang -->
	<!-- Date: 20/05/2014 -->
	<!-- Validated: OK 20/05/2014 -->
  </head>
  <body>
  	<h1 align = 'center'>My Status System</h1>
  	<h1 align = 'center'>Log in Page</h1>
  	<br />
	<form action="login.php" method ="post">
	  Email <input type="text" name = email >
	  <br />
	  Password <input type="password" name = psw>
	  <br />
	  <input type="submit" value="Log in">
	  <input type="reset" value="Reset">
	</form>
	<br />
 	<?php
 	session_set_cookie_params(3600);
 	session_start();
 	//connect to database
	if ((isset($_POST['email']) && $_POST['email']!=NULL)) {
		$dbConnect = @mysqli_connect("localhost", "root", "zen3zit3"); 
		if (!$dbConnect)
		  die("<p>The database server is not available.</p>"); 
		$dbSelect = @mysqli_select_db($dbConnect, "s_7493975_db");
	
		$email = $_POST["email"];
		$psw = $_POST["psw"];
		$result = mysqli_query($dbConnect, "SELECT password FROM users WHERE user_email ='$email'") 
			or die("<p>Unable to execute the query.</p>" 
			. "<p>Error code " . mysqli_errno($dbConnect) 
			. ": " . mysqli_error($dbConnect) . "</p>");
		$row = mysqli_fetch_row($result);
		if ($psw === $row[0]){
		//set session redirect to statuswll.php
		  $result_name = mysqli_query($dbConnect, "SELECT profile_name FROM users WHERE user_email = '$email'") 
			or die("<p>Unable to execute the query.</p>" 
			. "<p>Error code " . mysqli_errno($dbConnect) 
			. ": " . mysqli_error($dbConnect) . "</p>");
			$row_name = mysqli_fetch_row($result_name);	
  			$_SESSION['name'] = $row_name[0];
  			header('Location: statuswall.php');
		}
		else
		  echo "Password is invalid.<br />";
	}
 	?>
 	<br />
 	<a href="index.php">Home</a> 
  </body>
</html>