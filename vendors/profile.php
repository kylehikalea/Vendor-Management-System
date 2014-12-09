<?php 
require_once("resources/functions.php");
require_once("resources/db-const.php");
session_start();
?>
<html>
<head>
	<title>Vendor Dashboard | Urban Basics</title>
	<script src="script.js" type="text/javascript"></script>
</head>
<body>
<?php
if (logged_in() == false) {
	redirect_to("login.php");
} else {
	if (isset($_GET['id']) && $_GET['id'] != "") {
		$id = $_GET['id'];
	} else {
		$id = $_SESSION['user_id'];
	}
 
	## connect mysql server
		$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
		# check connection
		if ($mysqli->connect_errno) {
			echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			exit();
		}
	## query database
		# fetch data from mysql database
		$sql = "SELECT * FROM users WHERE id = {$id} LIMIT 1";
 
		if ($result = $mysqli->query($sql)) {
			$user = $result->fetch_array();
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
 
		if ($result->num_rows == 1) {
			# calculating online status
			if (time() - $user['status'] <= (5*60)) { // 300 seconds = 5 minutes timeout
				$status = "Online";
			} else {
				$status = "Offline";
			}
 
			# echo the user profile data
			echo "<p>User ID: {$user['id']}</p>";
			echo "<p>Username: {$user['username']}</p>";
			echo "<p>Status: {$status}</p>";			
		} else { // 0 = invalid user id
			echo "<p><b>Error:</b> Invalid user ID.</p>";
		}
}
 
// showing the login & register or logout link
if (logged_in() == true) {
	echo '<a href="logout.php">Log Out</a>';
} else {
	echo '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
}
?>
</body>
</html>