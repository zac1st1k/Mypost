<!DOCTYPE HTML>
<html lang="en">
  <head>
 	<title>My Status System</title>
    <meta charset="utf-8" />
	<meta name="description" content="Assignment 2" />
	<meta name="keywords" content="PHP programming" />
	<meta name="Author content="Shuxiao Zhang" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- Description: Initialise database and sample data -->
	<!-- Author: Shuxiao Zhang -->
	<!-- Date: 20/05/2014 -->
	<!-- Validated: OK 20/05/2014 -->
  </head>
  <body>
  	<h1 align = 'center'>My Status System</h1>
  	<h2>Assignment Home Page</h2>
  	<p>Name: Shuxiao Zhang</p>
	<p>Student ID: 7493975</p>
	<p>Email: <a href="mailto:7493975@student.swin.edu.au">7493975@student.swin.edu.au</a></p>
	<br />
	<p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student’s work or from any other source.</p>
 	<?php 
 	
 	//connect to database
 	$dbConnect = @mysqli_connect("localhost", "root", "zen3zit3"); 
    if (!$dbConnect)
      die("<p>The database server is not available.</p>"); 
    $dbSelect = @mysqli_select_db($dbConnect, "s_7493975_db");
    
    //creat database if not existed
 	if (!$dbSelect){
	  $sqlString = "CREATE DATABASE s_7493975_db";
      $queryResult = @mysqli_query($dbConnect, $sqlString) or die("<p>Unable to execute the query.</p>"
		. "<p>Error code " . mysqli_errno($dbConnect)
		. ": " . mysqli_error($dbConnect)) . "</p>";
	  mysqli_select_db($dbConnect, "s_7493975_db");
	}
 	
	//creat users table if not existed
 	$sqlString = "CREATE TABLE IF NOT EXISTS 
 		users (user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 		user_email VARCHAR(50) NOT NULL,
 		password VARCHAR(20) NOT NULL,
 		profile_name VARCHAR(30) NOT NULL)";	
	$queryResult = @mysqli_query($dbConnect, $sqlString) 
		or die("<p>Unable to execute the query.</p>"
		. "<p>Error code " . mysqli_errno($dbConnect)
		. ": " . mysqli_error($dbConnect)) . "</p>";
	
	//creat mystatus table if not existed
	$sqlString = "CREATE TABLE IF NOT EXISTS 
 		mystatus (user_id INT NOT NULL,
 		status VARCHAR(160) NOT NULL,
 		date_posted VARCHAR(10) NOT NULL)";	
 
	$queryResult = @mysqli_query($dbConnect, $sqlString) 
		or die("<p>Unable to execute the query.</p>"
		. "<p>Error code " . mysqli_errno($dbConnect)
		. ": " . mysqli_error($dbConnect)) . "</p>";
	
	//insert sample data
	$check = @mysqli_query($dbConnect, "SELECT * FROM users")
		or die("<p>Unable to execute the query.</p>"
		. "<p>Error code " . mysqli_errno($dbConnect)
		. ": " . mysqli_error($dbConnect)) . "</p>";
	if ($check->num_rows == 0){
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'Emma@hotmail.com', 'ewatson1', 'Emma Watson')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'zac@gmail.com', 'zac123', 'Zac Xu')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'Jack1999@yahoo.com', '19991222', 'Jack Smith')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'Ann_891229@ymail.com', 'baby132238', 'Ann Stone')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', '132238@student.swin.edu.au', '300890', 'Eric Johnson')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'weird_sis@hotmail.com', 'lifesucks', 'Alex Zhou')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'eric870823@163.com', '871223', 'Eric Lau')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'kelly@163.com', 'sfjds', 'Kelly Lee')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'd_button@apple.com', 'dbutton', 'Dean Button')");
		mysqli_query($dbConnect, "insert into users (user_id, user_email, password, profile_name) values ('NULL', 'Tim_mcleod@ymail.com', 'timisawsome', 'Tim Mcleod')");
	}
	$check = @mysqli_query($dbConnect, "SELECT * FROM mystatus")
		or die("<p>Unable to execute the query.</p>"
		. "<p>Error code " . mysqli_errno($dbConnect)
		. ": " . mysqli_error($dbConnect)) . "</p>";
	if ($check->num_rows == 0){
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('1', 'I am eating', '03/04/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('2', 'Life Sucks', '02/02/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('4', 'I am so bored', '02/04/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('3', 'is going to a wedding', '08/07/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('6', 'lovely day', '13/09/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('9', 'how bad is the weather!', '02/10/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('8', 'ahhhhhhhh everything is due', '23/05/2014')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('7', 'ahahah finally it works', '04/04/2014')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('9', 'Starting to workout!', '31/12/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('3', 'Can not sleep help me', '05/05/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('10', 'This is an awesome website!', '03/04/2014')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('2', 'I finally got my car back', '02/11/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('3', 'I am a dad!!!', '26/12/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('6', 'Congrats Mat', '05/08/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('7', 'This is the worst day ever!', '24/08/2012')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('5', 'Please forgive me', '22/02/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('4', 'hahah, this is gold', '26/04/2014')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('7', 'oh man how could this happened', '30/08/2012')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('4', 'dying', '12/06/2013')");
		mysqli_query($dbConnect, "insert into mystatus (user_id, status, date_posted) values ('1', 'I am full', '04/04/2013')");
	}
	echo "<p>Tables successfully created and populated.</p>";
	mysqli_close($dbConnect);
	?>
	<a href="signup.php">Sign-up</a>
	<a href="login.php">Log-In</a>
	<a href="about.php">About</a>
  </body>
</html>