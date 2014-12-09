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
date_default_timezone_set('America/Los_Angeles');
?>

<!DOCTYPE html>
<html lang="en" <?php 
	if (stripos($_SERVER['REQUEST_URI'], 'add_coupon.php')){
		 echo 'ng-app';
	}
	else{}
?>>
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
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>
	<link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
	<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="resources/syntax/shCore.css">
	<style type="text/css" class="init">

	</style>
	<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	
	<!--<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>-->
	<!--<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>-->
	<script type="text/javascript" language="javascript" src="resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="resources/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
		$(function(){
			var height = window.innerHeight;
			$('iframe').css('height', height);
		});

		//And if the outer div has no set specific height set.. 
		$(window).resize(function(){
			var height = window.innerHeight;
			$('iframe').css('height', height);
		});
	</script>
<?php 
	if (stripos($_SERVER['REQUEST_URI'], 'add_product.php')){ ?>
		<link href="assets/css/style.css" rel="stylesheet" />
		<script>
		function validateForm() {
			var validateName = document.forms["form_add_product"]["product_name"].value;
			var validatePrice = document.forms["form_add_product"]["product_price"].value;
			if (validateName==null || x=="") {
				alert("Product name must be filled out");
				return false;
			}
		}
		</script>
<?	}
	else if(stripos($_SERVER['REQUEST_URI'], 'dashboard.php')){
	echo '<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">';
    echo '<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>';
	} else {}
?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-default" role="navigation">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Vendor Portal</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
<?php
//Admin Header
	if ($user['group'] == 'admin'){
				echo '<li class="dropdown">';
				echo '<a href="#vendors" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Vendors</a>';
				echo '<ul class="dropdown-menu" role="menu">';
					echo '<li><a href="add_vendor.php">Add Vendor Account</a></li>';
					echo '<li><a href="view_all_vendors.php">Remove Vendor Account</a></li>';
					echo '<li><a href="view_all_vendors.php">View All Vendor Accounts</a></li>';
				echo '</ul>';
			echo '</li>';
            echo '<li class="dropdown">';
				echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Products</a>';
				echo '<ul class="dropdown-menu" role="menu">';
					echo '<li><a href="add_product.php">Add New Product</a></li>';
					echo '<li><a href="view_pending_products.php">View All Pending Products</a></li>';
					echo '<li><a href="view_processed_products.php">View All Processed Products</a></li>';
				echo '</ul>';
			echo '</li>';
			echo '<li class="dropdown">';
				echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tag"></span> Coupons</a>';
				echo '<ul class="dropdown-menu" role="menu">';
					echo '<li><a href="add_coupon.php">Create Coupon</a></li>';
					echo '<li><a href="edit_coupons.php">Edit Coupons</a></li>';
				echo '</ul>';
			echo '</li>';
			echo '<li><a href="view_pending_products.php"><span class="glyphicon glyphicon-barcode"></span> Inventory</a></li>';
			echo '<li><a href="sold_products.php"><span class="glyphicon glyphicon-tasks"></span> Sales</a></li>';
			echo '<li class="dropdown">';
				echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span> Events</a>';
				echo '<ul class="dropdown-menu" role="menu">';
					echo '<li><a href="add_coupon.php">Add Event</a></li>';
					echo '<li><a href="add_coupon.php">Pending Events</a></li>';
					echo '<li><a href="add_coupon.php">View Calendar</a></li>';
				echo '</ul>';
          echo '</ul>';
	//Vendor Header
	} else {
			echo '<li><a href="add_product.php"><span class="glyphicon glyphicon-plus"></span> Add Products</a></li>';
			echo '<li><a href="view_pending_products.php"><span class="glyphicon glyphicon-barcode"></span> Pending Products</a></li>';
			echo '<li><a href="view_pending_products.php"><span class="glyphicon glyphicon-barcode"></span> Inventory</a></li>';
			echo '<li><a href="sold_products.php"><span class="glyphicon glyphicon-shopping-cart"></span> Sold Products</a></li>';
			echo '<li><a href="add_coupon.php"><span class="glyphicon glyphicon-tag"></span> Create Coupon</a></li>';
			//echo '<li><a href="add_event.php"><span class="glyphicon glyphicon-calendar"></span> Add Event</a></li>';
          echo '</ul>';
	}
?>		  
          <ul class="nav navbar-nav navbar-right">
            <li class="user_greeting"><a href="dashboard.php"><?php echo "Welcome {$user['first_name']}!";?></a></li>
            <li><a href="logout.php">Sign Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>