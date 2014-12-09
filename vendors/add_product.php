<?php
	include ('resources/header.php');
	$vendor_item_no = date('dHis');
	$temp_sku = 'VN-'.$user['vendorid'].$vendor_item_no;
?>
	<div class="container content">
		<div class="row">
			<div class="col-md-8"><h2>Add New Vendor Product</h2></div>
			<div class="col-md-4">Add Product(s) > Products > Dashboard</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<iframe src="upload_image.php?imageid=<?php echo $temp_sku;?>" frameborder="0" style="height: 240px !important; width: 100%;"></iframe>
			</div>
		</div>
			<form name="form_add_product" class="form-add-product" action="submit_product.php" onsubmit="return validateForm()" method="post">
			<div class="well">
				<div class="row">
					<div class="col-md-12"><h4>Product Information</h4></div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon">Name</span>
                                                        <input class="form-control" type="text" name="product_name" required/>
							<input type="text" name="temp_sku" value="<?php echo $temp_sku;?>" style="display: none;" required/>
							<input type="text" name="vendor_item" value="<?php echo $vendor_item_no;?>" style="display: none;" required/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-group">
							<span class="input-group-addon">Type</span>
							<input class="form-control" type="text" name="product_type" placeholder="Plate, cup, radio etc."  required/>
						</div>
					</div>					
					<div class="col-md-3">
						<div class="input-group">
							<span class="input-group-addon">Price $</span>
							<input class="form-control" type="text" name="product_price" placeholder="0.00"  required/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon">Description</span>
							<textarea class="form-control" rows="5" name="product_description" required/></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="well">
				<div class="row">
					<div class="col-md-12"><h4>Product Attributes</h4></div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon">Quantity</span>
							<input class="form-control" type="text" name="product_quantity" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon">Color</span>
							<select class="form-control" name="product_color" required>
								<option value="" disabled selected>Select A Color</option>
								<optgroup label="General">
									<option>Black</option>	
									<option>White</option>
									<option>Grey</option>
									<option>Red</option>
									<option>Yellow</option>
									<option>Green</option>	
									<option>Blue</option>
									<option>Purple</option>
									<option>Pink</option>
									<option>Orange</option>
									<option>Brown</option>
									<option>Clear</option>
									<option>Varied</option>
								</optgroup>
								<optgroup label="Metals">
									<option>Brass</option>
									<option>Bronze</option>
									<option>Aluminium</option>
									<option>Stainless Steel</option>
									<option>Gold</option>
									<option>Silver</option>
									<option>Copper</option>
									<option>Cast Iron</option>
									<option>Pewter</option>
								</optgroup>
								<optgroup label="Gemstones">
									<option>Sapphire</option>
									<option>Emerald</option>
									<option>Ruby</option>
									<option>Diamond</option>
									<option>Opal</option>
									<option>Pearl</option>
									<option>Topaz</option>
									<option>Jade</option>
									<option>Amethyst</option>
									<option>Turquoise</option>
									<option>Garnet</option>
									<option>Aquamarine</option>
								</optgroup>
								<optgroup label="Wood Tones">
									<option>Oak</option>
									<option>Cherry</option>
									<option>Maple</option>
									<option>Cedar</option>
									<option>Walnut</option>
									<option>Mahogany</option>
									<option>Alder</option>
									<option>Spruce</option>
									<option>Hickory</option>
								</optgroup>
							</select>
						</div>				
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon">Size</span>
							<select class="form-control" name="product_size"  required>
								<option value="" disabled selected>Select A Size</option>
								<option value="Extra Small">Extra Small</option>	
								<option value="Small">Small</option>
								<option value="Medium">Medium</option>
								<option value="Large">Large</option>
								<option value="Extra Large">Extra Large</option>
							</select>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon">Category</span>
							<select class="form-control" name="product_category"  required>
								<option value="" disabled selected>Select A Category</option>
								<option value="1">Antique</option>	
								<option value="3">Handmade</option>
								<option value="4">Repurposed</option>
								<option value="2">Vintage</option>			
							</select>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Add Product"><span class="glyphicon glyphicon-plus"></span> Add Product</button>
		</form>
	</div>
<?php include ('resources/footer.php');?>