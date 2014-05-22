<!DOCTYPE HTML>
<html lang="en">
  <head>
	<title>Status Wall Page</title>
    <meta charset="utf-8" />
	<meta name="description" content="Assignment 2" />
	<meta name="keywords" content="PHP programming" />
	<meta name="Author content="Shuxiao Zhang" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- Description: list every user's status  -->
	<!-- Author: Shuxiao Zhang -->
	<!-- Date: 20/05/2014 -->
	<!-- Validated: OK 20/05/2014 -->
  </head>
  <body>
  	<h1 align = 'center'>My Status System</h1>
 	<?php
 	session_start();
 	$session = $_SESSION['name'];
 	//connect to database
	$dbConnect = @mysqli_connect("localhost", "root", "zen3zit3"); 
	if (!$dbConnect)
	  die("<p>The database server is not available.</p>"); 
	$dbSelect = @mysqli_select_db($dbConnect, "s_7493975_db");
	$results = mysqli_query($dbConnect, "SELECT * FROM mystatus ORDER BY date_posted") 
		or die("<p>Unable to execute the query.</p>" 
		. "<p>Error code " . mysqli_errno($dbConnect) 
		. ": " . mysqli_error($dbConnect) . "</p>");
	echo "<h1 align = 'center'>".$session."'s Status Wall Page</h1>";
	echo "<table width='80%' border='1'>"; 
	echo "<tr><th>User</th><th>Date</th><th>Status</th><th></th></tr>";
	$row = mysqli_fetch_row($results);
	$result_id = mysqli_query($dbConnect, "SELECT user_id FROM users WHERE profile_name = '$session'") 
		or die("<p>Unable to execute the query.</p>" 
		. "<p>Error code " . mysqli_errno($dbConnect) 
		. "id" . mysqli_error($dbConnect) . "</p>");
	$row_id = mysqli_fetch_row($result_id);	
	
	$_SESSION['max'] = intval($results->num_rows/5);
	$page_rem = $results->num_rows%5;
	
	if (!isset($_SESSION['page'])){
      $_SESSION['page']=0;
    }
    if (isset($_REQUEST['id'])){
      $_SESSION['page'] = $_SESSION['page'] + $_REQUEST['id'];
    }

	for ($i = 0; $i < ($_SESSION['page']*5); $i ++){
  		$row = mysqli_fetch_row($results);
  	}

  	if ($_SESSION['max'] == $_SESSION['page'])
  		$rem = $page_rem;
  	else
  		$rem = 5;
  	
  	for ($i = 0; $i < $rem; $i ++){
    	$result_name = mysqli_query($dbConnect, "SELECT profile_name FROM users WHERE user_id = '$row[0]'") 
			or die("<p>Unable to execute the query.</p>" 
			. "<p>Error code " . mysqli_errno($dbConnect) 
			. "id" . mysqli_error($dbConnect) . "</p>");
		$row_name = mysqli_fetch_row($result_name);	
		echo "<tr><td>{$row_name[0]}</td>";
		echo "<td>{$row[1]}</td>";
		echo "<td>{$row[2]}</td>";
		if  ($row[0] == $row_id[0]){
		  echo "<td width='15%'><form action='statuswall.php' method='post'><input type = 'submit' name = 'remove' value ='Remove' ></form></td></tr>";
		}
		else
		  echo "<td width='15%'></td></tr>";
		$row = mysqli_fetch_row($results);
	}
    echo "</table>";
    if (isset($_POST['remove'])){
   		mysqli_query($dbConnect, "DELETE FROM mystatus WHERE user_id = '$row_id[0]'") 
			or die("<p>Unable to execute the query.</p>" 
			. "<p>Error code " . mysqli_errno($dbConnect) 
			. "id" . mysqli_error($dbConnect) . "</p>");
    } 
 	
 	if ($_SESSION['page'] >0)
 		echo "<br /><a href='statuswall.php?id=-1'>Previous</a>";
 	else
 		echo "<br />";
 	if ($_SESSION['page']< $_SESSION['max'])
		echo "<br /><a href='statuswall.php?id=1'>Next</a>";
	else
		echo "<br />";
 	?>
 	<br />
 	<br />
 	<a href="statuspost.php">Post Status</a> 
 	<a href="logout.php">Log Out</a> 
  </body>
</html>