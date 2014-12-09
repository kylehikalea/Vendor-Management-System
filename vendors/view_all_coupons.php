<!DOCTYPE html>
<html lang="en">
  <head>
	<script language="javascript">
	document.addEventListener("contextmenu", function(e){
		e.preventDefault();
	}, false);
	</script>
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
  <div class="container">
	<h1>View All Coupons</h1>
	<div class="row">
<?php
include("resources/db-const.php");
$couponmysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$couponmysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

$coupon = "SELECT * FROM coupons";
$result = mysqli_query($couponmysqli, $coupon);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		echo '<div class="col-md-4">';
		echo '<div class="coupon" style="border: 2px dashed; padding: 25px; margin-bottom: 20px; background: url(http://urbanbasics.aspdotnetstorefront.active-e.net/Images/coupon-bg.jpg);">';
		echo '<img width="100%" src="http://urbanbasics.aspdotnetstorefront.active-e.net/Images/web%20logo.png" style="margin: 0px auto;"/>';
        echo '<h3 style="text-align: center;">' . $row["value"] . ' ' . $row['quantity'] . '<br> From ' . $row["name"] .'</h3>';
		echo '<p style="text-align: center; font-size: 8px;">Offer valid from ' . $row["start_date"] . ' until ' . $row["expiration_date"] . '. Not to be used in conjunction with any other offer. Coupon only valid towards products sold by Vendor #' . $row["vendorid"] .'</p>';
		echo '</div>';
		echo '</div>';
    }
} else {
    echo "0 results";
}

mysqli_close($couponmysqli);
?>
</div>
</div>
</body>
</html>