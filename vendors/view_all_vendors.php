<?php
	include ('resources/header.php');
?>

	<div class="container content">
		<div class="row">
			<div class="col-md-8"><h2>View All Vendors</h2></div>
			<div class="col-md-4">Edit Vendors > Vendors > Dashboard</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="pending_products_list_header">
								<th>Vendor Name</th>
								<th>Vendor ID</th>
								<th>Consignment Fee</th>
								<th>Phone Number</th>
								<th>Email Address</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
				<?
				//Coupon loop
				$vendor = "SELECT * FROM users";
				$vendorResult = mysqli_query($mysqli, $vendor);

				if (mysqli_num_rows($vendorResult) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($vendorResult)) {
						echo '<tr>';
							echo '<td>' . $row["first_name"] . ' ' . $row["last_name"] . '</td>';						
							echo '<td>' . $row["vendorid"] . '</td>';
							echo '<td>' . $row["product_fee"] . '</td>';
							echo '<td>' . $row["first_name"] . '</td>';
							echo '<td>' . $row["email"] . '</td>';
							echo '<td>Edit | Remove</td>';							
						echo '</tr>';
					}
				} else {
				}
				?>
				</table>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<?php
	include ('resources/footer.php');
?>