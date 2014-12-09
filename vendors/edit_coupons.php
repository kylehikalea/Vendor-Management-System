<?php
	include ('resources/header.php');
?>
	<div class="container content">
		<div class="row>
			<div class="col-md-12">
				<table>
					<tr>
						<td>Image</td>
						<td>Name</td>
						<td>Discount</td>
						<td>Start Date</td>
						<td>End Date</td>
						<td>Vendor ID</td>
					</tr>
				<?
				//Coupon loop
				$coupon = "SELECT * FROM coupons";
				$couponResult = mysqli_query($mysqli, $coupon);

				if (mysqli_num_rows($couponResult) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($couponResult)) {
						echo '<tr>';
							echo '<td>';
								echo '<div class="coupon" style="border: 2px dashed; padding: 25px; margin-bottom: 20px; background: url(http://urbanbasics.aspdotnetstorefront.active-e.net/Images/coupon-bg.jpg);">';
									echo '<img width="100%" src="http://urbanbasics.aspdotnetstorefront.active-e.net/Images/web%20logo.png" style="margin: 0px auto;"/>';
									echo '<h3 style="text-align: center;">' . $row["value"] . ' ' . $row['quantity'] . '<br> From ' . $row["name"] .'</h3>';
									echo '<p style="text-align: center; font-size: 8px;">Offer valid from ' . $row["start_date"] . ' until ' . $row["expiration_date"] . '. Not to be used in conjunction with any other offer. Coupon only valid towards products sold by Vendor #' . $row["vendorid"] .'</p>';
								echo '</div>';
							echo '</td>';
							echo '<td>' . $row["name"] . '</td>';
							echo '<td>' . $row["value"] . ' ' . $row['quantity'] . '</td>';
							echo '<td>' . $row["start_date"] . '</td>';
							echo '<td>' . $row["expiration_date"] . '</td>';
							echo '<td>' . $row["vendorid"] .'</td>';							
						echo '</tr>';
					}
				} else {
				}
				?>
				</table>
			</div>
		</div>
	</div>
<?php
	include ('resources/footer.php');
?>