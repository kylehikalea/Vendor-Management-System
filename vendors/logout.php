<?php
	require_once("resources/functions.php");
	require_once("resources/db-const.php");
	session_start();
 
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
 
	// update status to offline
	$sql = "SELECT status from users WHERE id={$_SESSION['user_id']}";
	$result = $mysqli->query($sql);
	$user = $result->fetch_array();
	$timestamp = $user['status'] - 300;
	$sql = "UPDATE users SET status={$timestamp} WHERE id={$_SESSION['user_id']}";
	$result = $mysqli->query($sql);
 
	## finally destroying the session
		// unset all session variables
		$_SESSION = array();	
		// destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-50000, '/');
		}	
		// destroy the session
		session_destroy();
 
	redirect_to("login.php");
?>