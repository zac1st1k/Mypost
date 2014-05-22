<!DOCTYPE HTML>
<html lang="en">
  <head>
	<title>Login Page</title>
    <meta charset="utf-8" />
	<meta name="description" content="Assignment 2" />
	<meta name="keywords" content="PHP programming" />
	<meta name="Author content="Shuxiao Zhang" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <!-- Description: Log out -->
	<!-- Author: Shuxiao Zhang -->
	<!-- Date: 20/05/2014 -->
	<!-- Validated: OK 20/05/2014 -->
  </head>
  <body>
  	<?php
  	//clears all session variables
	  session_start();
  	  $_SESSION = array();
  	  session_destroy();
  	  header('Location: index.php');
 	?>
 	<br />
  </body>
</html>