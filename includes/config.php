<?php
	session_start();
	// connect to database
	require( "config.user.php" );

	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DB_NAME);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	ini_set( "display_errors", true ); // set to false if not in debugging mode
	date_default_timezone_set( "Asia/Tokyo" );  // http://www.php.net/manual/en/timezones.php

	// global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/blog/');

	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/~zoe/blog/about.php":
			$CURRENT_PAGE = "About"; 
			$PAGE_TITLE = "About Us";
			break;
		case "/~zoe/blog/contact.php":
			$CURRENT_PAGE = "Contact"; 
			$PAGE_TITLE = "Contact Us";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Template";
	}
?>