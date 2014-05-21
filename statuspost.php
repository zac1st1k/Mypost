<!DOCTYPE HTML>
<html lang="en">
  <head>
	<title>Login Page</title>
    <meta charset="utf-8" />
	<meta name="description" content="Assignment 2" />
	<meta name="keywords" content="PHP programming" />
	<meta name="Author content="Shuxiao Zhang" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- Description: allows the logged in user to post a message. -->
	<!-- Author: Shuxiao Zhang -->
	<!-- Date: 20/05/2014 -->
	<!-- Validated: OK 20/05/2014 -->
  </head>
  <body>
  	<h1 align = 'center'>My Status System</h1>
  	<?php
 	session_set_cookie_params(3600);
  	session_start();
  	
	date_default_timezone_set("Australia/Sydney");
 	$session = $_SESSION['name'];
  	echo "<h1 align = 'center'>". $session."'s Post Status Page</h1>";
  	?>
 	<br />
	<form action="statuspost.php" method ="post">
	  Status <input type="text" name = status>
	  <br />
	  <br />
	  <input type="submit" value="Post">
	  <input type="reset" value="Reset">
	</form>
	<br />

   	<?php
   	if ((isset($_POST['status']) && $_POST['status']!=NULL)) {
		//connect to database
		$dbConnect = @mysqli_connect("localhost", "root", "zen3zit3"); 
		if (!$dbConnect)
		  die("<p>The database server is not available.</p>"); 
		echo "<p>Successfully connected to the database server.</p>"; 
		$dbSelect = @mysqli_select_db($dbConnect, "s_7493975_db");
	
		//get user_id
		$result_id = mysqli_query($dbConnect, "SELECT user_id FROM users WHERE profile_name ='$session'") 
			or die("<p>Unable to execute the query of id.</p>" 
			. "<p>Error code " . mysqli_errno($dbConnect) 
			. ": " . mysqli_error($dbConnect) . "</p>");
		$row_id	= mysqli_fetch_row($result_id);	
	
		$status = $_POST["status"]; 
		$date = date('d-m-Y');
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ($row_id[0], '$status', '06/06/2012')")
		or die("<p>Unable to execute the query of status.</p>" 
			. "<p>Error code " . mysqli_errno($dbConnect) 
			. ": " . mysqli_error($dbConnect) . "</p>");
		header('Location: statuswall.php');
	}
 	?>
 	<br />
 	<a href="statuswall.php">Status Wall</a> 
 	<a href="logout.php">Log out</a>
  </body>
</html>