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
echo '<td>Image</td>';
echo '<td>Status</td>';
echo '<td>Options</td>';
echo '</tr>';

$pending_products_xml = simplexml_load_file('../products/pending/products_pending.xml');

foreach ($pending_products_xml->product as $single_product) {
    echo '<tr class="pending_products_list">';
    echo '<td>' . $single_product->name . '</td>';
    echo '<td>' . $single_product->description . '</td>';
    echo '<td>' . $single_product->price . '</td>';
    echo '<td>' . $single_product->vendor . '</td>';
    echo '<td>' . $single_product->category . '</td>';
    echo '<td><a href="' . $single_product->image . '" target="_blank">View</a></td>';
    echo '<td>' . $single_product->status . '</td>';
    echo '<td><button class="edit-entry" id="approveproductdata-'.$single_product->sku.'" data-pid="'.$single_product->sku.'"><span class="glyphicon glyphicon-ok"></span></button><button class="edit-entry"><span class="glyphicon glyphicon-remove"></span></button><button class="edit-entry" data-toggle="modal" data-target="#edit-' . $single_product->sku . '"><span class="glyphicon glyphicon-search"></span></button></td>';
    ?>
    <div class="modal fade" id="edit-<?php echo $single_product->sku; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <form action="" id="editform-<?php echo $single_product->sku; ?>" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title">Edit Pending Product</h3>
                    </div>
                    <div class="modal-body" id="viewable_attr-<?php echo $single_product->sku; ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="#" class="thumbnail">
                                    <img src="../uploads/product-thumbnail.png" alt="...">
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
                                    <p><b>Sub-Category:</b> <?php echo $single_product->subcategory; ?></p>
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
                                <a href="#" class="thumbnail">
                                    <img src="../uploads/product-thumbnail.png" alt="...">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <!--Product Information-->
                                <p><input type="text" name="product_name" value="<?php echo $single_product->name; ?>" /></p>
                                <p><input type="text" name="product_description" value="<?php echo $single_product->description; ?>" /></p>
                                <p>SKU: <?php echo $single_product->sku; ?></p>
                            </div>
                        </div>
                        
                        <input type="hidden" name="skudata" value="<?php echo $single_product->sku; ?>" />
                        <div class="well" >
                            <div class="row">
                                <div class="col-md-12"><h4>Edit Product Attributes</h4></div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4">
                                    <p><b>Quantity:</b> <input type="text" name="product_quantity" value="<?php echo $single_product->quantity; ?>" /></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Size:</b> <input type="text" name="product_size" value="<?php echo $single_product->size; ?>" /></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Color:</b> <input type="text" name="product_color" value="<?php echo $single_product->color; ?>" /></p>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-12">
                                    <p><b>Category:</b><select class="form-control" name="product_category" value="<?php echo $single_product->category; ?>">
											<option value="<?php echo $single_product->category; ?>" selected><?php echo $single_product->category; ?></option>
											<option value="Antique">Antique</option>	
											<option value="Handmade">Handmade</option>
											<option value="Repurposed">Repurposed</option>
											<option value="Vintage">Vintage</option>			
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
                                    <p><b>Retail Price:</b> <input type="text" name="product_price" value="<?php echo $single_product->price; ?>" /></p>
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
    <?php
    echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '</div>';
include('resources/footer.php');
?>
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
            var formdata = $('#editform-' + pid).serialize();
            //console.log(formdata);
           
            $.ajax({
                type: "POST",
                url: "update_product.php",
                data: formdata
            })
                    .done(function (msg) {
                       // alert("Data Saved: " + msg);
                window.location="view_pending_products.php";
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
