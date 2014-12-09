<?php 
	require_once("resources/functions.php");
	require_once("resources/db-const.php");
	session_start();
	if (logged_in() == true) {
		if ($user['group'] == 'admin'){
			$loginPath = 'dashboard.php';
			redirect_to("dashboard.php");
	//Vendor Header
		} else {
			$loginPath = 'dashboard.php';
			redirect_to("dashboard.php");
		}
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

    <title>Vendor Login | Urban Basics</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background: transparent;">
  <div class="container">
	<div style="width: 350px; background: #F8f8f8; padding: 10px 0px; margin: 0 auto; border-radius: 10px; box-shadow: 0px 0px 1px #888;">
	  <h1>Urban Basics</h1>
	  <h2>Vendor Login</h2>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="form-signin" role="form">
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus><br />
			<input type="password" name="password" class="form-control" placeholder="Password" required><br />
			<!--<label class="checkbox">
			  <input type="checkbox" value="remember-me" name="remember"> Remember me
			</label> -->
	 
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">Sign in</button>
		</form>
	</div>
<?php
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
 
	// processing remember me option and setting cookie with long expiry date
	if (isset($_POST['remember'])) {	
		session_set_cookie_params('604800'); //one week (value in seconds)
		session_regenerate_id(true);
	} 
 
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
 
	$sql = "SELECT * from users WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
	$result = $mysqli->query($sql);
 
	if ($result->num_rows != 1) {
		echo '<div class="alert alert-danger" role="alert" style="text-align: center;">Invalid Username / Password. <a href="login.php">Forgot Your Password?</a></div>';
	} else {
		// Authenticated, set session variables
		$user = $result->fetch_array();
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['username'] = $user['username'];
 
		// update status to online
		$timestamp = time();
		$sql = "UPDATE users SET status={$timestamp} WHERE id={$_SESSION['user_id']}";
		$result = $mysqli->query($sql);
 
		echo '<div class="alert alert-success" role="alert" style="text-align: center;">Login Successful. One Moment While You\'re Redirected.</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1"; URL="http://wolfind.com/web_app/vendors/view_pending_products.php">';
	}
}
 
if(isset($_GET['msg'])) {
	echo "<p style='color:red;'>".$_GET['msg']."</p>";
}
?>	
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>