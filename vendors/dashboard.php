<?php
	include('resources/header.php');
	
	$pending_products_xml = simplexml_load_file('../products/pending/products_pending.xml');
	$pending_count = 0;
	$message_count = 0;
	
	foreach ($pending_products_xml->product as $single_product) {
		if ($single_product->vendor == $user['vendorid']){
			$pending_count = $pending_count + 1;
		}
	}

	$recipientmysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	$viewMessages = "SELECT * FROM messages";
	$singleMessage = mysqli_query($recipientmysqli, $viewMessages);
	// output data of each row
	while($row = mysqli_fetch_assoc($singleMessage)) {
		if ($row['recipient'] == $user['vendorid']) {
			$message_count = $message_count + 1;
		} else {}
		}
	mysqli_close($recipientmysqli);
?>
<div class="container content">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <?
						if ($message_count > 0) {
							echo '<strong><a href="inbox.php">You\'ve Recieved New Messages!</a></strong>';
						} else {
							echo '<strong>No New Notifications</strong>';
						}
					  ?>
					</div>
				</div>
			</div>		
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="add_product.php" role="button">
								<span class="glyphicon glyphicon-plus"></span>
								New Product
							</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="view_pending_products.php" role="button">
								<span class="glyphicon glyphicon-folder-open"></span>
								Pending Products<span class="badge"><?php echo $pending_count; ?></span>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="#" role="button">
								<span class="glyphicon glyphicon-barcode"></span>
								View Inventory
							</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="sold_products.php" role="button">
								<span class="glyphicon glyphicon-shopping-cart"></span>
								Sold Products<span class="badge">0</span>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="add_coupon.php" role="button">
								<span class="glyphicon glyphicon-tag"></span>
								Create Coupons
							</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="inbox.php" role="button">
								<span class="glyphicon glyphicon-envelope"></span>
								View Messages<span class="badge"><?php echo $message_count; ?>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="my_account.php" role="button">
								<span class="glyphicon glyphicon-user"></span>
								Manage Account
							</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-primary btn-lg btn-dashboard" href="changelog.php" role="button">
								<span class="glyphicon glyphicon-wrench"></span>
								View Changelog
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
				<h3>Latest Vendor News</h3>
					<div class="well">
						<h4>Introducing The Vendor Portal</h4>
						<p><b>Posted December 5th, 2014</b></p>
						<p>We are excited to introduce you to the new Vendor Portal! From here you are able to add new products, view existing inventory, create coupons for your customers and even see which of your products have sold! Please bare in mind, however, that this is a work-in-progress and is subject to continuous updates. See something that might be improved upon or receive an error? Feel free to report it via <a href="changelog.php">the changelog.</a>
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Sales Reporting (Previous 30 days)</h3>
					<div class="well">
						<div class="ct-chart ct-perfect-fourth"></div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
<script>
var data = {
  // A labels array that can contain any sort of values
  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
  // Our series array that contains series objects or in this case series data arrays
  series: [
    [0]
  ]
};

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
new Chartist.Line('.ct-chart', data);
</script>
<?php
	include('resources/footer.php');
?>