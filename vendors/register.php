<?php 
	require_once("resources/db-const.php");
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

    <title>Register Vendor Account - Urban Basics</title>

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
<div class="container content">
<div class="row">
<div class="col-md-12"><h2>Register Vender Account</h2></div>
</div>
<form action="<?=$_SERVER['PHP_SELF']?>" class="form-add-vendor" method="post">
	<div class="well">
		<div class="row">
			<div class="col-md-12"><h4>Account Information</h4></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Username</span>
					<input class="form-control" type="text" name="username"/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Password</span>
					<input class="form-control" type="password" name="password"/><br />
				</div>
			</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
			<div class="col-md-12"><h4>Personal Information:</h4></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">First Name</span>
					<input class="form-control" type="text" name="first_name"/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Last Name</span>
					<input class="form-control" type="text" name="last_name"/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Email Address</span>
					<input class="form-control" type="text" name="email"/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Phone Number</span>
					<input class="form-control" type="text" name="phone"/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<span class="input-group-addon">Address</span>
					<input class="form-control" type="text" name="address"/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">City</span>
					<input class="form-control" type="text" name="city"/><br />
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">State</span>
					<input class="form-control" type="text" name="state"/><br />
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Zipcode</span>
					<input class="form-control" type="text" name="zipcode"/><br />
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">
	<span class="glyphicon glyphicon-plus"></span> Add Vendor
	</button>
</form>
</div>
<?php
if (isset($_POST['submit'])) {
## connect mysql server
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
## query database
	# prepare data for insertion
	$username	= $_POST['username'];
	$password	= $_POST['password'];
	$first_name	= $_POST['first_name'];
	$last_name	= $_POST['last_name'];
	$email		= $_POST['email'];
	$phone		= $_POST['phone'];
	$address		= $_POST['address'];
	$city		= $_POST['city'];
	$state		= $_POST['state'];
	$zipcode		= $_POST['zipcode'];
	$account_type		= 'Pending';
 
	# check if username and email exist else insert
	// u = username, e = emai, ue = both username and email already exists
	$exists = "";
	$result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "u";
	}	
	$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "e";
	}
 
	if ($exists == "u") echo "<p><b>Error:</b> Username already exists!</p>";
	else if ($exists == "e") echo "<p><b>Error:</b> Email already exists!</p>";
	else if ($exists == "ue") echo "<p><b>Error:</b> Username and Email already exists!</p>";
	else {
		# insert data into mysql database
		$sql = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `address`, `city`, `state`, `zipcode`, `email`, `group`) 
				VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$address}', '{$city}', '{$state}', '{$zipcode}', '{$email}', '{$account_type}')";
 
		if ($mysqli->query($sql)) {
			echo "<p>Account Created.</p>";
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
	}
}
	include ('resources/footer.php');
?>