<?php 
	require_once("resources/functions.php");
	require_once("resources/db-const.php");
	session_start();
	include ('resources/header.php');
?>
<div class="container content">
<div class="row">
<div class="col-md-8"><h2>Create A Coupon</h2></div>
<div class="col-md-4">Create Coupon > Coupons > Dashboard</div>
</div>
<form action="<?=$_SERVER['PHP_SELF']?>" class="form-add-vendor" method="post">
	<div class="well">
		<div class="row">
			<div class="col-md-12"><h4>Basic Information</h4></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<span class="input-group-addon">Coupon Name</span>
					<input class="form-control" type="text" name="coupon_name" ng-model="coupon_name" placeholder="Booth Name or Booth Number" required/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Applicable To</span>
					<select class="form-control" type="text" name="quantity" ng-model="quantity" required/>
						<option value="" disabled selected>Select Items</option>
						<option value="One Item">Any One Item</option>
						<option value="All Items">All Items</option>								
					</select>
				</div> 
			</div>	
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Coupon Value</span>
					<select class="form-control" type="text" name="coupon_value" ng-model="coupon_value" required/>
						<option value="" disabled selected>Discount Amount</option>
						<option value="5% Off">5% Off</option>
						<option value="10% Off">10% Off</option>
						<option value="20% Off">20% Off</option>
						<option value="30% Off">30% Off</option>
						<option value="40% Off">40% Off</option>
						<option value="50% Off">50% Off</option>
						<option value="60% Off">60% Off</option>
						<option value="70% Off">70% Off</option>	
						<option value="80% Off">80% Off</option>	
						<option value="90% Off">90% Off</option>								
					</select>
				</div>
			</div>		
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Start Date</span>
					<input class="form-control" type="text" name="start_date" placeholder="00/00/0000" ng-model="start_date" required/><br />
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">Expiration Date</span>
					<input class="form-control" type="text" name="end_date" placeholder="00/00/0000" ng-model="end_date" required/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<span class="input-group-addon">Description</span>
					<input class="form-control" type="text" name="description" placeholder="Any Notes"/><br />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<h4>Coupon Preview</h4>
				<div class="coupon" style="border: 2px dashed; padding: 25px; width: 340px; margin: 0px auto; background: url(http://urbanbasics.aspdotnetstorefront.active-e.net/Images/coupon-bg.jpg);">
				<img width="100%" src="http://urbanbasics.aspdotnetstorefront.active-e.net/Images/web%20logo.png" style="margin: 0px auto;"/>
				<h3 style="text-align: center;">{{coupon_value}} {{quantity}} <br> From {{coupon_name}}</h3>
				<p style="text-align: center; font-size: 8px;">Offer valid from {{start_date}} until {{end_date}}. Not to be used in conjunction with any other offer. Coupon only valid towards products sold by Vendor #<?php echo $row["vendorid"];?></p>
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
	$couponmysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	# check connection
	if ($couponmysqli->connect_errno) {
		echo "<p>MySQL error no {$couponmysqli->connect_errno} : {$couponmysqli->connect_error}</p>";
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
	$result = $couponmysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "u";
	}	
	$result = $couponmysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "e";
	}
 
	if ($exists == "u") echo "<p><b>Error:</b> Username already exists!</p>";
	else if ($exists == "e") echo "<p><b>Error:</b> Email already exists!</p>";
	else if ($exists == "ue") echo "<p><b>Error:</b> Username and Email already exists!</p>";
	else {
		# insert data into mysql database
		$couponSql = "INSERT  INTO `coupons` (`uniqueid`, `vendorid`, `name`, `value`, `start_date`, `expiration_date`, `quantity`, `description`) 
				VALUES (null, '{$vendorid}', '{$coupon_name}', '{$coupon_value}', '{$start_date}', '{$end_date}', '{$quantity}', '{$description}')";
 
		if ($couponmysqli->query($couponSql)) {
			echo '<div class="alert alert-success" role="alert">Coupon Created Successfully.</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert">MySQL error no {$couponmysqli->errno} : {$couponmysqli->error}</div>';
			exit();
		}
	}
}
	include ('resources/footer.php');
?>