<?php
	include('resources/header.php');
?>
<div class="container content">
	<div class="row">
		<div class="col-md-8"><h2>Manage Account</h2></div>
		<div class="col-md-4">Manage Account > My Account > Dashboard</div>
	</div>
	<form action="<?=$_SERVER['PHP_SELF']?>" class="form-add-vendor" method="post">
		<div class="well">
			<div class="row">
				<div class="col-md-12"><h4>Personal Information:</h4></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">First Name</span>
						<input class="form-control" type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required/><br />
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">Last Name</span>
						<input class="form-control" type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required/><br />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">Email Address</span>
						<input class="form-control" type="text" name="email" value="<?php echo $user['email']; ?>" required/><br />
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">Phone Number</span>
						<input class="form-control" type="text" name="phone" value="<?php echo $user['phone']; ?>"/><br />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon">Address</span>
						<input class="form-control" type="text" name="address" value="<?php echo $user['address']; ?>"/><br />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="input-group">
						<span class="input-group-addon">City</span>
						<input class="form-control" type="text" name="city" value="<?php echo $user['city']; ?>"/><br />
					</div>
				</div>
				<div class="col-md-4">
					<div class="input-group">
						<span class="input-group-addon">State</span>
						<input class="form-control" type="text" name="state" value="<?php echo $user['state']; ?>"/><br />
					</div>
				</div>
				<div class="col-md-4">
					<div class="input-group">
						<span class="input-group-addon">Zipcode</span>
						<input class="form-control" type="text" name="zipcode" value="<?php echo $user['zipcode']; ?>"/><br />
					</div>
				</div>
			</div>
		</div>
		<div class="well">
			<div class="row">
				<div class="col-md-12"><h4>Change Password:</h4></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">New Password</span>
						<input class="form-control" type="password" name="update_password"/><br />
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">Last Name</span>
						<input class="form-control" type="password" name="update_password"/><br />
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">
		<span class="glyphicon glyphicon-plus"></span> Update Account
		</button>
	</form>
</div>
<?php
	include('resources/footer.php');

if (isset($_POST['submit'])) {	
	$first_name	= $_POST['first_name'];
	$last_name	= $_POST['last_name'];
	$email		= $_POST['email'];
	$phone		= $_POST['phone'];
	$address	= $_POST['address'];
	$city		= $_POST['city'];
	$state		= $_POST['state'];
	$zipcode	= $_POST['zipcode'];
	
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	} else {
		$updateUser = "UPDATE `users` SET 
							first_name='{$first_name}', 
							last_name='{$last_name}', 
							email='{$email}',
							phone='{$phone}', 
							address='{$address}', 
							city='{$city}', 
							state='{$state}', 
							zipcode='{$zipcode}' 
					   WHERE vendorid='{$user['vendorid']}'";
		if ($mysqli->query($updateUser) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $mysqli->error;
			echo $user['vendorid'];
		}
	}

	$mysqli->close();
}
?>
