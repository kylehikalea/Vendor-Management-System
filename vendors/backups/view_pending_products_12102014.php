<?php
include ('resources/header.php');
echo '<div class="container content">';
echo '<div class="row">';
echo '<div class="col-md-8"><h2>Products Currently Pending Store Approval</h2></div>';
echo '<div class="col-md-4">Pending Approval > Products > Dashboard</div>';
echo '</div>';
echo '<div class="panel panel-default">';
echo '<table class="table">';
echo '<tr class="pending_products_list_header">';
echo '<td>Name</td>';
echo '<td>Description</td>';
echo '<td>Price</td>';
echo '<td>Vendor</td>';
echo '<td>Category</td>';
echo '<td>Subcategory</td>';
echo '<td>Image</td>';
echo '<td>Status</td>';
echo '<td>Options</td>';
echo '</tr>';

$pending_products_xml = simplexml_load_file('../products/pending/products_pending.xml');

foreach($pending_products_xml->product as $single_product)
{
echo '<tr class="pending_products_list">';
	echo '<td>'.$single_product->name.'</td>';
	echo '<td>'.$single_product->description.'</td>';
	echo '<td>'.$single_product->price.'</td>';
	echo '<td>'.$single_product->vendor.'</td>';
	echo '<td>'.$single_product->category.'</td>';
	echo '<td>'.$single_product->subcategory.'</td>';
	echo '<td><a href="'.$single_product->image.'" target="_blank">View</a></td>';
	echo '<td>'.$single_product->status.'</td>';
	echo '<td><button class="edit-entry"><span class="glyphicon glyphicon-ok"></span></button><button class="edit-entry"><span class="glyphicon glyphicon-remove"></span></button><button class="edit-entry" data-toggle="modal" data-target="#edit-'.$single_product->sku.'"><span class="glyphicon glyphicon-search"></span></button></td>';
	echo '<div class="modal fade" id="edit-'.$single_product->sku.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
		echo '<div class="modal-dialog">';
			echo '<div class="modal-content">';
				echo '<div class="modal-header">';
					echo '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
					echo '<h3 class="modal-title">Edit Pending Product</h3>';
				echo '</div>';
				echo '<div class="modal-body">';
					echo '<div class="row">';
						echo '<div class="col-md-3">';
						//Product Picture
							echo '<a href="#" class="thumbnail">';
								echo '<img src="../uploads/product-thumbnail.png" alt="...">';
							echo '</a>';
						echo '</div>';
						echo '<div class="col-md-9">';
						//Product Information
							echo '<p>'.$single_product->name.'</p>';
							echo '<p>'.$single_product->description.'</p>';
							echo '<p>SKU: '.$single_product->sku.'</p>';
						echo '</div>';
					echo '</div>';
					echo '<div class="well">';
						echo '<div class="row">';
							echo '<div class="col-md-12"><h4>Product Attributes</h4></div>';
						echo '</div>';					
						echo '<div class="row">';
							echo '<div class="col-md-4">';
								echo '<p><b>Quantity:</b> '.$single_product->quantity.'</p>';
							echo '</div>';
							echo '<div class="col-md-4">';
								echo '<p><b>Size:</b> '.$single_product->size.'</p>';
							echo '</div>';
							echo '<div class="col-md-4">';
								echo '<p><b>Color:</b> '.$single_product->color.'</p>';
							echo '</div>';						
						echo '</div>';
						echo '<div class="row">';
							echo '<div class="col-md-6">';
								echo '<p><b>Category:</b> '.$single_product->category.'</p>';
							echo '</div>';
							echo '<div class="col-md-6">';
								echo '<p><b>Sub-Category:</b> '.$single_product->subcategory.'</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="well">';
						echo '<div class="row">';
							echo '<div class="col-md-12"><h4>Administrative Information</h4></div>';
						echo '</div>';
						echo '<div class="row">';
							echo '<div class="col-md-4">';
								echo '<p><b>Retail Price:</b> '.$single_product->price.'</p>';
							echo '</div>';
							echo '<div class="col-md-4">';
								echo '<p><b>Online Price:</b> '.$single_product->websiteprice.'</p>';
							echo '</div>';
							echo '<div class="col-md-4">';
								echo '<p><b>Vendor Price:</b> '.$single_product->ourprice.'</p>';
							echo '</div>';						
						echo '</div>';
						echo '<div class="row">';
							echo '<div class="col-md-4">';
								echo '<p><b>Vendor:</b> '.$single_product->vendor.'</p>';
							echo '</div>';
							echo '<div class="col-md-4">';
								echo '<p><b>Vendor ID:</b> '.$single_product->vendor.'</p>';
							echo '</div>';								
							echo '<div class="col-md-4">';
								echo '<p><b>Consignment Fee:</b> '.$single_product->consignmentfee.'</p>';
							echo '</div>';						
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="modal-footer">';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
					echo '<button type="button" class="btn btn-primary">Edit Product</button>';
					echo '<button type="button" class="btn btn-success btn-primary">Approve Product</button>';
				echo '</div>';
			echo '</div><!-- /.modal-content -->';
		echo '</div><!-- /.modal-dialog -->';
	echo '</div><!-- /.modal -->';
echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '</div>';
include('resources/footer.php');
?>