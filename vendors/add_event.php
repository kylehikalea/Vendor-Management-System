<?php 
	require_once("resources/functions.php");
	require_once("resources/db-const.php");
	session_start();
	include ('resources/header.php');
?>
<div class="container content">
<div class="row">
<div class="col-md-8"><h2>Add An Event</h2></div>
<div class="col-md-4">Add An Event > Events > Dashboard</div>
</div>
<form action="<?=$_SERVER['PHP_SELF']?>" class="form-add-vendor" method="post">
	<div class="well">
		<div class="row">
			<div class="col-md-12"><h4>Event Information</h4></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<span class="input-group-addon">Event Name</span>
					<input class="form-control" type="text" name="coupon_name" placeholder=""/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<span class="input-group-addon">Description</span>
					<input class="form-control" type="text" name="description" placeholder="Information Regarding Event"/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Frequency</span>
					<select class="form-control" type="text" name="frequency"/>
						<option value="" disabled selected></option>
						<option value="once">One-Time</option>
						<option value="weekly">Weekly</option>
						<option value="monthly">Monthly</option>						
					</select>
				</div> 
			</div>
			<div class="col-md-6">
				<div class="input-group event-date">
					<span class="input-group-addon">Date</span>
					<input class="form-control" type="text" name="date"/><br />
				</div> 
			</div>	
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Start Time</span>
					<select class="form-control" type="text" name="time"/>
						<option value="" disabled selected></option>
						<option value="10:00am">10:00am</option>
						<option value="10:30am">10:30am</option>
						<option value="11:00am">11:00am</option>
						<option value="11:30am">11:30am</option>
						<option value="12:00pm">12:00pm</option>
						<option value="12:30pm">12:30pm</option>
						<option value="1:00pm">1:00pm</option>
						<option value="1:30pm">1:30pm</option>						
						<option value="2:00pm">2:00pm</option>
						<option value="2:30pm">2:30pm</option>
						<option value="3:00pm">3:00pm</option>
						<option value="3:30pm">3:30pm</option>
						<option value="4:00pm">4:00pm</option>
						<option value="4:30pm">4:30pm</option>
						<option value="5:00pm">5:00pm</option>
						<option value="5:30pm">5:30pm</option>						
						<option value="6:00pm">6:00pm</option>
						<option value="6:30pm">6:30pm</option>
						<option value="7:00pm">7:00pm</option>
						<option value="7:30pm">7:30pm</option>
						<option value="8:00pm">8:00pm</option>
					</select>
				</div>
			</div>		
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Start Date</span>
					<input class="form-control" type="text" name="start_date" placeholder="00/00/0000" ng-model="start_date"/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Expiration Date</span>
					<input class="form-control" type="text" name="end_date" placeholder="00/00/0000" ng-model="end_date"/><br />
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">
	<span class="glyphicon glyphicon-plus"></span> Create Coupon
	</button>
</form>
</div>
<?php
if (isset($_POST['submit'])) {
## connect mysql server
	$eventmysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	# check connection
	if ($eventmysqli->connect_errno) {
		echo "<p>MySQL error no {$eventmysqli->connect_errno} : {$eventmysqli->connect_error}</p>";
		exit();
	}
## query database
	# prepare data for insertion
	$vendorid	= $user['vendorid'];
	$coupon_name	= $_POST['coupon_name'];
	$coupon_value	= $_POST['coupon_value'];
	$start_date	= $_POST['start_date'];
	$end_date		= $_POST['end_date'];
	$quantity		= $_POST['quantity'];
	$description		= $_POST['description'];
 
	# check if username and email exist else insert
	// u = username, e = emai, ue = both username and email already exists
	$exists = "";
	$result = $eventmysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "u";
	}	
	$result = $eventmysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "e";
	}
 
	if ($exists == "u") echo "<p><b>Error:</b> Username already exists!</p>";
	else if ($exists == "e") echo "<p><b>Error:</b> Email already exists!</p>";
	else if ($exists == "ue") echo "<p><b>Error:</b> Username and Email already exists!</p>";
	else {
		# insert data into mysql database
		$couponSql = "INSERT  INTO `events` (`uniqueid`, `vendorid`, `name`, `value`, `start_date`, `expiration_date`, `quantity`, `description`) 
				VALUES (null, '{$vendorid}', '{$coupon_name}', '{$coupon_value}', '{$start_date}', '{$end_date}', '{$quantity}', '{$description}')";
 
		if ($eventmysqli->query($couponSql)) {
			echo '<div class="alert alert-success" role="alert">Event Created Successfully.</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert">MySQL error no {$eventmysqli->errno} : {$eventmysqli->error}</div>';
			exit();
		}
	}
}
	include ('resources/footer.php');
?>