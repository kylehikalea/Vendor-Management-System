<?php
require_once("resources/functions.php");
require_once("resources/db-const.php");
session_start();
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
 
		//if ($result->num_rows == 1) {
		//	# calculating online status
		//	if (time() - $user['status'] <= (5*60)) { // 300 seconds = 5 minutes timeout
		//		$status = "Online";
		//	} else {
		//		$status = "Offline";
		//	}
 
		//	# echo the user profile data
		//	echo "<p>User ID: {$user['id']}</p>";
		//	echo "<p>Username: {$user['username']}</p>";
		//	echo "<p>Status: {$status}</p>";			
		//} else { // 0 = invalid user id
		//	echo "<p><b>Error:</b> Invalid user ID.</p>";
		//}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Vendor Dashboard - Urban Basics</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Urban Basics</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li class="dropdown">
				<a href="#vendors" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Vendors</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="add_vendor.php">Add Vendor Account</a></li>
					<li><a href="#">Remove Vendor Account</a></li>
					<li><a href="#">View All Vendor Accounts</a></li>
				</ul>
			</li>
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Products</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="add_product.php">Add New Product</a></li>
					<li><a href="view_pending_products.php">View All Pending Products</a></li>
					<li><a href="view_processed_products.php">View All Processed Products</a></li>
				</ul>
			</li>
			<li><a href="view_pending_products.php"><span class="glyphicon glyphicon-barcode"></span> Inventory</a></li>
			<li><a href="view_pending_products.php"><span class="glyphicon glyphicon-tasks"></span> Sales</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="user_greeting"><a href="./"><?php echo "Welcome {$user['first_name']}!";?></a></li>
            <li><a href="logout.php">Sign Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>