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

	// automatically generates page title
	switch ($_SERVER["SCRIPT_NAME"]) {
		case '/blog/register.php':
			$CURRENT_PAGE = "register"; 
			$PAGE_TITLE = "Register";
			break;
		case "/blog/login.php":
			$CURRENT_PAGE = "login"; 
			$PAGE_TITLE = "Login";
			break;
		case "/blog/admin/dashboard.php":
			$CURRENT_PAGE = "dashboard"; 
			$PAGE_TITLE = "Dashboard";
			break;
		case "/blog/admin/create_post.php":
			$CURRENT_PAGE = "create-post"; 
			$PAGE_TITLE = "Create Post";
			break;
		case "/blog/admin/posts.php":
			$CURRENT_PAGE = "manage-post"; 
			$PAGE_TITLE = "Manage Posts";
			break;
		case "/blog/admin/topics.php":
			$CURRENT_PAGE = "manage-topic"; 
			$PAGE_TITLE = "Manage Topics";
			break;
		case "/blog/admin/users.php":
			$CURRENT_PAGE = "manage-user"; 
			$PAGE_TITLE = "Manage Users";
			break;
		// TODO: get post id and topic id to generate title
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Blog";
	}
?>