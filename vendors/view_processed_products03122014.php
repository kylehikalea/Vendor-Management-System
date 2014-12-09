<?php
include ('resources/header.php');
echo '<div class="container content">';
echo '<div class="row">';
echo '<div class="col-md-8"><h2>Approved Products</h2></div>';
echo '<div class="col-md-4">Approved Products > Products > Dashboard</div>';
echo '</div>';
echo '<div class="panel panel-default">';
echo '<table class="table">';
echo '<tr class="pending_products_list_header">';
echo '<td>Image</td>';
echo '<td>Name</td>';
echo '<td>Description</td>';
echo '<td>Price</td>';
echo '<td>Vendor</td>';
echo '<td>Category</td>';
echo '<td>Status</td>';
echo '<td>Options</td>';
echo '</tr>';

$completed_products_xml = simplexml_load_file('../products/complete/products_completed.xml');

foreach ($completed_products_xml->product as $single_product) {
if ($user['group'] == 'admin'){
    echo '<tr class="pending_products_list">';
    echo '<td><a href="' . $single_product->image . '" class="thumbnail"><img src="' . $single_product->image . '" alt="..."></a></td>';
    echo '<td>' . $single_product->name . '</td>';
    echo '<td>' . $single_product->description . '</td>';
    echo '<td>' . $single_product->price . '</td>';
    echo '<td>' . $single_product->vendor . '</td>';
    echo '<td>' . $single_product->category . '</td>';
    echo '<td>' . $single_product->status . '</td>';
    echo '<td><button class="edit-entry" id="approveproductdata-'.$single_product->sku.'" data-pid="'.$single_product->sku.'"><span class="glyphicon glyphicon-download"></span></button><button class="edit-entry" id="approveproductdata-'.$single_product->sku.'" data-pid="'.$single_product->sku.'"><span class="glyphicon glyphicon-print"></span></button><button class="edit-entry" id="approveproductdata-'.$single_product->sku.'" data-pid="'.$single_product->sku.'"><span class="glyphicon glyphicon-cloud"></span></button></td>';
    echo '</tr>';
}
	else {}
}

echo '</table>';
echo '</div>';
echo '<div class="row">';
echo '<a href="import_products.php"><button class="btn btn-lg btn-primary btn-block" name="submit" value="Import All Products"><span class="glyphicon glyphicon-download"></span> Import All Products</button></a>';
echo '</div>';
echo '</div>';
include('resources/footer.php');
?>
