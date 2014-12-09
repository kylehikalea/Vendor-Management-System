<?php 
	include ('resources/header.php');
?>

<div class="container content">
	<div class="row">
		<div class="col-md-3">
			<button type="button" class="btn btn-primary btn-lg new-message" data-toggle="modal" data-target="#composeMessage">
			  New Message
			</button>
			<div class="list-group">
			  <a href="#" class="list-group-item active">Inbox</a>
			  <a href="#" class="list-group-item">Groups</a>
			  <a href="#" class="list-group-item">Sent</a>
			  <a href="#" class="list-group-item">Trash</a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="modal fade" id="composeMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Create New Message</h4>
				  </div>
				  <div class="modal-body">
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
						<div class="input-group">
						  <span class="input-group-addon">Subject</span>
						  <input type="text" class="form-control" name="subject">
						</div>
						<div class="input-group">
						  <span class="input-group-addon">Recipient</span>
						  <select class="form-control" name="recipient">
							<?php
							include("resources/db-const.php");
							$recipientmysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
							if (!$recipientmysqli) {
								die("Connection failed: " . mysqli_connect_error());
							}

							$recipientVendor = "SELECT * FROM users";
							$result = mysqli_query($recipientmysqli, $recipientVendor);

							if (mysqli_num_rows($result) > 0) {
								// output data of each row
								while($row = mysqli_fetch_assoc($result)) {
									echo '<option value="' . $row["vendorid"] .'">' . $row["first_name"] . ' ' . $row["last_name"] . '</option>';
								}
							} else {
								echo '<option selected disabled> No Recipients Found</option>';
							}

							mysqli_close($recipientmysqli);
							?>
						  </select>
						</div>
						<div class="input-group">
						  <span class="input-group-addon">Message</span>
						  <textarea class="form-control" rows="4" name="message"></textarea>
						</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" type="submit" name="submit" value="submit">Send Message</button>
				  </div>
				  </form>
				</div>
			  </div>
			</div>
			<div class="list-group">
			<?
				$recipientmysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
				$viewMessages = "SELECT * FROM messages";
				$singleMessage = mysqli_query($recipientmysqli, $viewMessages);
				// output data of each row
				while($row = mysqli_fetch_assoc($singleMessage)) {
					if (mysqli_num_rows($singleMessage) > 0) {
						if ($row['recipient'] == $user['vendorid']) {
							echo '<a href="#" class="list-group-item" data-toggle="modal" data-target="#read-' . $row['messageid'] . '">';
							echo '<h4 class="list-group-item-heading blk-bg">' . $row['subject'] .'</h4>';
							echo '<p class="list-group-item-text">' . $row['message'] .'</p>';
							echo '</a>';
							?>
							
			<div class="modal fade" id="read-<? echo $row['messageid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Create New Message</h4>
				  </div>
				  <div class="modal-body">
					Body
				  </div>
			    </div>
			  </div>
			</div>
							
							<?
						}
					} else {
						echo '<a href="#" class="list-group-item">';
						echo '<h4 class="list-group-item-heading blk-bg">No New Messages</h4>';
						echo '<p class="list-group-item-text"></p>';
						echo '</a>';								
					}
				}
				mysqli_close($recipientmysqli);
			?>
			</div>
		</div>
	</div>
</div>

<?php
	if (isset($_POST['submit'])) {
	## connect mysql server
	$messagemysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
		# check connection
		if ($messagemysqli->connect_errno) {
			echo "<p>MySQL error no {$messagemysqli->connect_errno} : {$messagemysqli->connect_error}</p>";
			exit();
		}
	## query database
		# prepare data for insertion
		$sender	= $user['vendorid'];
		$recipient	= $_POST['recipient'];
		$subject	= $_POST['subject'];
		$message	= $_POST['message'];
		$date		= date(F) . ' ' . date(d) . ', ' . date(Y);
		$time		= (string)date('h:i a');
		$status		= 'unread';
		
		# insert data into mysql database
		$sql = "INSERT INTO `messages` (`sender`, `recipient`, `subject`, `message`, `date`, `status`, `messageid`) 
				VALUES ('{$sender}', '{$recipient}', '{$subject}', '{$message}', `{(string)$date}`, `{$status}`, NULL)";
 
		if ($messagemysqli->query($sql)) {
			echo "<p>Message Sent.</p>";
		} else {
			echo "<p>MySQL error no {$messagemysqli->errno} : {$messagemysqli->error}</p>";
			exit();
		}
	}
	include('resources/footer.php');
?>