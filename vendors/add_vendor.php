<?php 
	require_once("resources/functions.php");
	require_once("resources/db-const.php");
	session_start();
	include ('resources/header.php');
?>
<div class="container content">
<div class="row">
<div class="col-md-8"><h2>Add New Vendor Account</h2></div>
<div class="col-md-4">Add Vendor > Vendors > Dashboard</div>
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
					<input class="form-control" type="text" name="username" required/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Password</span>
					<input class="form-control" type="password" name="password" required/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Vendor ID</span>
					<input class="form-control" type="text" name="vendor_id" required/><br />
				</div> 
			</div>	
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Consignment Fee</span>
					<select class="form-control" type="text" name="vendor_fee" required/>
						<option value="" disabled selected>Fee Collected Per Product</option>
						<option value="0.05">5%</option>
						<option value="0.10">10%</option>
						<option value="0.15">15%</option>
						<option value="0.20">20%</option>
						<option value="0.25">25%</option>
						<option value="0.30">30%</option>
						<option value="0.35">35%</option>						
					</select>
				</div>
			</div>		
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">Account Type</span>
					<select class="form-control" type="text" name="account_type" required/>
						<option value="" disabled selected>Select Account Type</option>
						<option value="vendor">Vendor</option>
						<option value="admin">Administrator</option>
					</select>
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
					<input class="form-control" type="text" name="first_name" required/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Last Name</span>
					<input class="form-control" type="text" name="last_name" required/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Email Address</span>
					<input class="form-control" type="text" name="email" required/><br />
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
	$vendor_id		= $_POST['vendor_id'];
	$account_type		= $_POST['account_type'];
	$consignment_fee		= $_POST['vendor_fee'];
	$phone		= $_POST['phone'];
	$address	= $_POST['address'];
	$city		= $_POST['city'];
	$state		= $_POST['state'];
	$zipcode	= $_POST['zipcode'];
	
 
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
		$sql = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `address`, `city`, `state`, `zipcode`, `email`, `vendorid`, `product_fee`, `group`, `phone`) 
				VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$address}', '{$city}', '{$state}', '{$zipcode}', '{$email}', '{$vendor_id}', '{$consignment_fee}', '{$account_type}', '{$phone}')";
 
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