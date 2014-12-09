<?php
include ('resources/header.php');
echo '<style>
    
    .image-upload > input
{
    display: none;
}

label span input {
    z-index: 999;
    line-height: 0;
    font-size: 50px;
    position: absolute;
    top: -2px;
    left: -700px;
    opacity: 0;
    filter: alpha(opacity = 0);
    -ms-filter: "alpha(opacity=0)";
    cursor: pointer;
    _cursor: hand;
    margin: 0;
    padding:0;
}


</style>';
echo '<div class="container content">';
echo '<div class="row">';
echo '<div class="col-md-8"><h2>Products Pending Approval</h2></div>';
echo '<div class="col-md-4" style="text-align: right;">Pending Approval > Products > Dashboard</div>';
echo '</div>';
echo '<div class="panel panel-default panel-table">';

echo '<table id="data_table" class="table">';
echo '<thead>';
echo '<tr class="pending_products_list_header">';
echo '<th>Image</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Quantity</th>';
echo '<th>Price</th>';
echo '<th>Vendor</th>';
echo '<th>Status</th>';
echo '<th>Options</th>';
echo '</tr>';
echo '</thead>';

echo '<tfoot>';
echo '<tr class="pending_products_list_header">';
echo '<th>Image</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Quantity</th>';
echo '<th>Price</th>';
echo '<th>Vendor</th>';
echo '<th>Status</th>';
echo '<th>Options</th>';
echo '</tr>';
echo '</tfoot>';

$pending_products_xml = simplexml_load_file('../products/pending/products_pending.xml');

$product_count = 0;

foreach ($pending_products_xml->product as $single_product) {
	if ($single_product->vendor == $user['vendorid']){
		$product_count = $product_count + 1;
	}
}

foreach ($pending_products_xml->product as $single_product) {
if ($user['group'] == 'admin'){
    echo '<tr class="pending_products_list">';
    echo '<td><a href="' . $single_product->image . '" class="thumbnail"><img src="' . $single_product->image . '" alt="..."></a></td>';
    echo '<td>' . $single_product->name . '</td>';
    echo '<td>' . $single_product->description . '</td>';
    echo '<td>' . $single_product->quantity . '</td>';
    echo '<td>' . $single_product->price . '</td>';
    echo '<td>' . $single_product->vendor . '</td>';
    echo '<td>' . $single_product->status . '</td>';
    echo '<td style="width: 95px;"><button class="edit-entry" id="approveproductdata-'.$single_product->sku.'" data-pid="'.$single_product->sku.'"><span class="glyphicon glyphicon-ok"></span></button><button class="edit-entry"><span class="glyphicon glyphicon-remove"></span></button><button class="edit-entry" data-toggle="modal" data-target="#edit-' . $single_product->sku . '"><span class="glyphicon glyphicon-search"></span></button></td>';
    ?>
    <div class="modal fade" id="edit-<?php echo $single_product->sku; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form enctype="multipart/form-data" action="update_product.php" id="editform-<?php echo $single_product->sku; ?>" method="post">

                                   
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title">Edit Pending Product</h3>
                    </div>
                    <div class="modal-body" id="viewable_attr-<?php echo $single_product->sku; ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?php echo $single_product->image; ?>" class="thumbnail">
                                    <img src="<?php echo $single_product->image; ?>" alt="...">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <!--						Product Information-->
                                <p><?php echo $single_product->name; ?></p>
                                <p><?php echo $single_product->description; ?></p>
                                <p>SKU: <?php echo $single_product->sku; ?></p>
                            </div>
                        </div>
                        <div class="well" >
                            <div class="row">
                                <div class="col-md-12"><h4>Product Attributes</h4></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Quantity:</b> <?php echo $single_product->quantity; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Size:</b> <?php echo $single_product->size; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Color:</b> <?php echo $single_product->color; ?></p>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-12">
                                    <p><b>Category:</b> <?php echo $single_product->category; ?></p>
                                </div>
                            </div>
                        </div>
                        



                        <div class="well">
                            <div class="row">
                                <div class="col-md-12"><h4>Administrative Information</h4></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Retail Price:</b> <?php echo $single_product->price; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Online Price:</b> <?php echo $single_product->websiteprice; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Vendor Price:</b> <?php echo $single_product->ourprice; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Vendor:</b> <?php echo $single_product->vendor; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Vendor ID:</b> <?php echo $single_product->vendor; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Consignment Fee:</b> <?php echo $single_product->consignmentfee; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="modal-body edit-product" id="editable_attr-<?php echo $single_product->sku; ?>" style="display:none">
                        <div class="row">
                                
                            <div class="col-md-3">
                                <div class="image-upload thumbnail">
                                    
                                   
                                                                         
                                    <label class="filebutton thumbnail">
                                    <img src="<?php echo $single_product->image; ?>" alt="...">
                                    <span><input type="file" id="myfile" name="skudata_file"></span>
                                    </label>
                                    
                                     
                                </div>
                                
                            </div>
                            <div class="col-md-9">
                                <!--Product Information-->
                                <p><input class="form-control" type="text" name="product_name" value="<?php echo $single_product->name; ?>" /></p>
                                <p><input class="form-control" type="text" name="product_description" value="<?php echo $single_product->description; ?>" /></p>
                                <p>SKU: <?php echo $single_product->sku; ?></p>
                            </div>
                        </div>
                        
                        <input type="hidden" name="skudata" value="<?php echo $single_product->sku; ?>" />
                        <input type="hidden" name="vendor" value="<?php echo $single_product->vendor; ?>" />
                        <div class="well" >
                            <div class="row">
                                <div class="col-md-12"><h4>Edit Product Attributes</h4></div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4">
                                    <p><b>Quantity:</b> <input class="form-control" type="text" name="product_quantity" value="<?php echo $single_product->quantity; ?>" /></p>
                                </div>
								<div class="col-md-4">
									<p><b>Size:</b> 
										<select class="form-control" name="product_size" value="<?php echo $single_product->size; ?>">
											<option value="<?php echo $single_product->size; ?>" selected><?php echo $single_product->size; ?></option>
											<option value="Extra Small">Extra Small</option>	
											<option value="Small">Small</option>
											<option value="Medium">Medium</option>
											<option value="Large">Large</option>
											<option value="Extra Large">Extra Large</option>
										</select>
									</p>
								</div>
								<div class="col-md-4">
									<p><b>Color:</b>
									<select class="form-control" name="product_color" value="<?php echo $single_product->color; ?>">						
										<option value="<?php echo $single_product->color; ?>" selected><?php echo $single_product->color; ?></option>
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
									</p>
								</div>
                            </div>

                            <div class="row" >
                                <div class="col-md-12">
                                    <p><b>Category:</b><select class="form-control" name="product_category" value="<?php echo $single_product->category; ?>">
											<option value="<?php echo $single_product->category; ?>" selected><?php echo $single_product->category; ?></option>
											<option value="1">Antique</option>	
											<option value="3">Handmade</option>
											<option value="4">Repurposed</option>
											<option value="2">Vintage</option>			
										</select>
									</p>
                                </div>
                            </div>
                        </div>



                        <div class="well">
                            <div class="row">
                                <div class="col-md-12"><h4>Administrative Information</h4></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Retail Price:</b> <input class="form-control" type="text" name="product_price" value="<?php echo $single_product->price; ?>" /></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Online Price:</b> <?php echo $single_product->websiteprice; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Vendor Price:</b> <?php echo $single_product->ourprice; ?></p>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Vendor:</b> <?php echo $single_product->vendor; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Vendor ID:</b> <?php echo $single_product->vendor; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Consignment Fee:</b> <?php echo $single_product->consignmentfee; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary editproductdata" id="editproductdata-<?php echo $single_product->sku; ?>" data-pid="<?php echo $single_product->sku; ?>">Edit Product</button>
                        <button type="button" class="btn btn-primary viewproductdata" id="viewproductdata-<?php echo $single_product->sku; ?>" style="display:none" data-pid="<?php echo $single_product->sku; ?>">View Product</button>
                        <button type="button" class="btn btn-success btn-primary approveproductdata" id="approveproductdata-<?php echo $single_product->sku; ?>" data-pid="<?php echo $single_product->sku; ?>">Approve Product</button>
                        <button type="button" class="btn btn-success btn-primary updateproductdata" id="updateproductdata-<?php echo $single_product->sku; ?>" data-pid="<?php echo $single_product->sku; ?>" style="display:none">Update Product</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
         </form>
    </div><!-- /.modal --> 
	<style>
		.pending_products_list:first-of-type {
			display: none;
		}
	</style>
    <?php
    echo '</tr>';
} elseif ($user['group'] == 'vendor'){
	if ($single_product->vendor == $user['vendorid']){
    echo '<tr class="pending_products_list">';
    echo '<td><a href="' . $single_product->image . '" class="thumbnail"><img src="' . $single_product->image . '" alt="..."></a></td>';
    echo '<td>' . $single_product->name . '</td>';
    echo '<td>' . $single_product->description . '</td>';
    echo '<td>' . $single_product->quantity . '</td>';
    echo '<td>' . $single_product->price . '</td>';
    echo '<td>' . $single_product->vendor . '</td>';
    echo '<td>' . $single_product->status . '</td>';
    echo '<td style="width: 95px;"><button class="edit-entry" id="approveproductdata-'.$single_product->sku.'" data-pid="'.$single_product->sku.'"><span class="glyphicon glyphicon-ok"></span></button><button class="edit-entry"><span class="glyphicon glyphicon-remove"></span></button><button class="edit-entry" data-toggle="modal" data-target="#edit-' . $single_product->sku . '"><span class="glyphicon glyphicon-search"></span></button></td>';
    ?>
    <div class="modal fade" id="edit-<?php echo $single_product->sku; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form enctype="multipart/form-data" action="update_product.php" id="editform-<?php echo $single_product->sku; ?>" method="post">

                                   
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title">Edit Pending Product</h3>
                    </div>
                    <div class="modal-body" id="viewable_attr-<?php echo $single_product->sku; ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?php echo $single_product->image; ?>" class="thumbnail">
                                    <img src="<?php echo $single_product->image; ?>" alt="...">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <!--						Product Information-->
                                <p><?php echo $single_product->name; ?></p>
                                <p><?php echo $single_product->description; ?></p>
                                <p>SKU: <?php echo $single_product->sku; ?></p>
                            </div>
                        </div>
                        <div class="well" >
                            <div class="row">
                                <div class="col-md-12"><h4>Product Attributes</h4></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Quantity:</b> <?php echo $single_product->quantity; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Size:</b> <?php echo $single_product->size; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Color:</b> <?php echo $single_product->color; ?></p>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-6">
                                    <p><b>Category:</b> <?php echo $single_product->category; ?></p>
                                </div>
								<div class="col-md-6">
                                    <p><b>Retail Price:</b> <?php echo $single_product->price; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="modal-body edit-product" id="editable_attr-<?php echo $single_product->sku; ?>" style="display:none">
                        <div class="row">
                                
                            <div class="col-md-3">
                                <div class="image-upload thumbnail">
                                    
                                   
                                                                         
                                    <label class="filebutton thumbnail">
                                    <img src="<?php echo $single_product->image; ?>" alt="...">
                                    <span><input type="file" id="myfile" name="skudata_file"></span>
                                    </label>
                                    
                                     
                                </div>
                                
                            </div>
                            <div class="col-md-9">
                                <!--Product Information-->
                                <p><input class="form-control" type="text" name="product_name" value="<?php echo $single_product->name; ?>" /></p>
                                <p><input class="form-control" type="text" name="product_description" value="<?php echo $single_product->description; ?>" /></p>
                                <p>SKU: <?php echo $single_product->sku; ?></p>
                            </div>
                        </div>
                        
                        <input type="hidden" name="skudata" value="<?php echo $single_product->sku; ?>" />
                        <input type="hidden" name="vendor" value="<?php echo $single_product->vendor; ?>" />
                        <div class="well" >
                            <div class="row">
                                <div class="col-md-12"><h4>Edit Product Attributes</h4></div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4">
                                    <p><b>Quantity:</b> <input class="form-control" type="text" name="product_quantity" value="<?php echo $single_product->quantity; ?>" /></p>
                                </div>
								<div class="col-md-4">
									<p><b>Size:</b> 
										<select class="form-control" name="product_size" value="<?php echo $single_product->size; ?>">
											<option value="<?php echo $single_product->size; ?>" selected><?php echo $single_product->size; ?></option>
											<option value="Extra Small">Extra Small</option>	
											<option value="Small">Small</option>
											<option value="Medium">Medium</option>
											<option value="Large">Large</option>
											<option value="Extra Large">Extra Large</option>
										</select>
									</p>
								</div>
								<div class="col-md-4">
									<p><b>Color:</b>
									<select class="form-control" name="product_color" value="<?php echo $single_product->color; ?>">						
										<option value="<?php echo $single_product->color; ?>" selected><?php echo $single_product->color; ?></option>
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
									</p>
								</div>
                            </div>

                            <div class="row" >
                                <div class="col-md-6">
                                    <p><b>Category:</b><select class="form-control" name="product_category" value="<?php echo $single_product->category; ?>">
											<option value="<?php echo $single_product->category; ?>" selected><?php echo $single_product->category; ?></option>
											<option value="1">Antique</option>	
											<option value="3">Handmade</option>
											<option value="4">Repurposed</option>
											<option value="2">Vintage</option>				
										</select>
									</p>
                                </div>
								<div class="col-md-6">
                                    <p><b>Retail Price:</b> <input class="form-control" type="text" name="product_price" value="<?php echo $single_product->price; ?>" /></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary editproductdata" id="editproductdata-<?php echo $single_product->sku; ?>" data-pid="<?php echo $single_product->sku; ?>">Edit Product</button>
                        <button type="button" class="btn btn-primary viewproductdata" id="viewproductdata-<?php echo $single_product->sku; ?>" style="display:none" data-pid="<?php echo $single_product->sku; ?>">View Product</button>
                        <button type="button" style="display: none;" class="btn btn-success btn-primary approveproductdata" id="approveproductdata-<?php echo $single_product->sku; ?>" data-pid="<?php echo $single_product->sku; ?>">Approve Product</button>
                        <button type="button" class="btn btn-success btn-primary updateproductdata" id="updateproductdata-<?php echo $single_product->sku; ?>" data-pid="<?php echo $single_product->sku; ?>" style="display:none">Update Product</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
         </form>
    </div><!-- /.modal --> 
		<?php
		echo '</tr>';
	} else {}
}
else {}
}
echo '</table>';
if ($product_count == 0) {
//echo '<style>#data_table{display: none}</style>';
echo '<div class="alert alert-danger" role="alert"><center>No Products Currently Pending Approval. <a href="add_product.php">Add A Product</a></center></div>';
}
echo '</div>';
echo '</div>';
include('resources/footer.php');
?>
                <script src="http://malsup.github.com/jquery.form.js"></script> 
<script>
    $(document).ready(function () {
        $('.editproductdata').on('click', function () {
            //alert("sdfsdf");

            var pid = $(this).attr('data-pid');
            console.log(pid);
            $('#viewable_attr-' + pid).hide();
            $('#editable_attr-' + pid).show();

            $('#editproductdata-' + pid).hide();
            $('#viewproductdata-' + pid).show();
            $('#updateproductdata-' + pid).show();
            $('#approveproductdata-' + pid).hide();
            //approveproductdata
            //viewproductdata
        });
        $('.viewproductdata').on('click', function () {
            // alert("sdfsdf");
            var pid = $(this).attr('data-pid');
            $('#editable_attr-' + pid).hide();
            $('#viewable_attr-' + pid).show();
            $('#editproductdata-' + pid).show();
            $('#viewproductdata-' + pid).hide();
            $('#updateproductdata-' + pid).hide();
            $('#approveproductdata-' + pid).show();
        });
        $('.updateproductdata').on('click', function () {
            // alert("sdfsdf");
            var pid = $(this).attr('data-pid');
            
            $('#editform-' + pid).submit();
            
            var formdata = $('#editform-' + pid).serialize();
            //console.log(formdata);
           
            $.ajax({
                type: "POST",
                url: "update_product.php",
                data: formdata,
                contentType: true,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false, 
            })
                    .done(function (msg) {
                       // alert("Data Saved: " + msg);
                //window.location="view_pending_products.php";
                    });
        
//$('#editable_attr-'+pid).hide();
            //$('#viewable_attr-'+pid).show();
            //$('#editproductdata-'+pid).show();
            /// $('#viewproductdata-'+pid).hide();
            //$('#updateproductdata-'+pid).hide();
            //$('#approveproductdata-'+pid).show();
        });
        $('.approveproductdata').on('click', function () {
            // alert("sdfsdf");
            var pid = $(this).attr('data-pid');
            //var formdata = $('#editform-' + pid).serialize();
            //console.log(formdata);
           
            $.ajax({
                type: "POST",
                url: "approve_product.php",
                data: {pid:pid}
            })
                    .done(function (msg) {
                        //alert("Data Saved: " + msg);
                window.location="view_pending_products.php";
                    });
        
        });
        
    });

</script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" >
$(document).ready(function() {
    $('#data_table').dataTable();
} );
</script>
 