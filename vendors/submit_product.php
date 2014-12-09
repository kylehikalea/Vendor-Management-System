<?php
include ('resources/header.php');

//	require_once("resources/functions.php");
//	require_once("resources/db-const.php");
//	session_start();
// 
//	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
//	# check connection
//	if ($mysqli->connect_errno) {
//		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
//		exit();
//	}
// 
//	// update status to offline
//	$sql = "SELECT status from users WHERE id={$_SESSION['user_id']}";
//	$result = $mysqli->query($sql);
//	$user = $result->fetch_array();

$name = $_POST['product_name'];
$description = $_POST['product_description'];
$price = $_POST['product_price'];
$our_price_unformatted = $price - ($price * $user['product_fee']);
$update_our_price = number_format($our_price_unformatted, 2, '.', '');
$website_price = $_POST['product_price'] * 1.25;
$update_website_price = number_format($website_price, 2, '.', '');
$update_vendor = $user['vendorid'];
$consignment_fee = $user['product_fee'];
$category = $_POST['product_category'];
$subcategory = $_POST['product_subcategory'];
$status = 'Pending';
$quantity = $_POST['product_quantity'];
$size = $_POST['product_size'];
$color = $_POST['product_color'];
$product_sku = $_POST['temp_sku'];
$vendor_item_no = $_POST['vendor_item'];
$image = 'http://wolfind.com/web_app/vendors/uploads/'.$product_sku.'.jpg';

$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('../products/pending/products_pending.xml');

$element = $xml->getElementsByTagName('product')->item(0);

$name_old = $element->getElementsByTagName('name')->item(0);
$description = $element->getElementsByTagName('description')->item(0);
$our_price = $element->getElementsByTagName('ourprice')->item(0);
$quantity = $element->getElementsByTagName('quantity')->item(0);
$size = $element->getElementsByTagName('size')->item(0);
$color = $element->getElementsByTagName('color')->item(0);
$vendor = $element->getElementsByTagName('vendor')->item(0);
$category = $element->getElementsByTagName('category')->item(0);
$subcategory = $element->getElementsByTagName('subcategory')->item(0);

$newItem = $xml->createElement('product');

$newItem->appendChild($xml->createElement('name', $name));
$newItem->appendChild($xml->createElement('vendor', $user['vendorid']));
$newItem->appendChild($xml->createElement('price', $price));
$newItem->appendChild($xml->createElement('consignmentfee', $consignment_fee));
$newItem->appendChild($xml->createElement('websiteprice', $update_website_price));
$newItem->appendChild($xml->createElement('ourprice', $update_our_price));
$newItem->appendChild($xml->createElement('inventory_type', 'a'));
$newItem->appendChild($xml->createElement('model_number', $vendor_item_no));
$newItem->appendChild($xml->createElement('sku', $product_sku));
$newItem->appendChild($xml->createElement('category', '24'));
$newItem->appendChild($xml->createElement('subcategory', $_POST['product_category']));
$newItem->appendChild($xml->createElement('description', '['.$_POST['product_type'].']'.$_POST['product_description']));
$newItem->appendChild($xml->createElement('manufacturer', 'Vendor'));
$newItem->appendChild($xml->createElement('barcode_upc', $product_sku));
$newItem->appendChild($xml->createElement('color', $_POST['product_color']));
$newItem->appendChild($xml->createElement('size', $_POST['product_size']));
$newItem->appendChild($xml->createElement('lease', ''));
$newItem->appendChild($xml->createElement('book_depr', ''));
$newItem->appendChild($xml->createElement('tax_depr', ''));
$newItem->appendChild($xml->createElement('min', ''));
$newItem->appendChild($xml->createElement('max', ''));
$newItem->appendChild($xml->createElement('quantity', $_POST['product_quantity']));
$newItem->appendChild($xml->createElement('avg_cost', '$'.$update_our_price));
$newItem->appendChild($xml->createElement('freight', ''));
$newItem->appendChild($xml->createElement('w_cost', '$'.$update_our_price));
$newItem->appendChild($xml->createElement('retail', '$'.$_POST['product_price']));
$newItem->appendChild($xml->createElement('our_price', '$'.$_POST['product_price']));
$newItem->appendChild($xml->createElement('min_price', '$'.$_POST['product_price']));
$newItem->appendChild($xml->createElement('price_a', ''));
$newItem->appendChild($xml->createElement('price_b', ''));
$newItem->appendChild($xml->createElement('price_c', ''));
$newItem->appendChild($xml->createElement('spiff', ''));
$newItem->appendChild($xml->createElement('p_vendor_number', $update_vendor));
$newItem->appendChild($xml->createElement('p_vendor_item_number', $vendor_item_no));
$newItem->appendChild($xml->createElement('p_vendor_last_cost', ''));
$newItem->appendChild($xml->createElement('p_vendor_last_date', ''));
$newItem->appendChild($xml->createElement('s1_vendor_number', ''));
$newItem->appendChild($xml->createElement('s1_vendor_item_number', ''));
$newItem->appendChild($xml->createElement('s1_vendor_last_cost', ''));
$newItem->appendChild($xml->createElement('s1_vendor_last_date', ''));
$newItem->appendChild($xml->createElement('s2_vendor_number', ''));
$newItem->appendChild($xml->createElement('s2_vendor_item_number', ''));
$newItem->appendChild($xml->createElement('s2_vendor_last_cost', ''));
$newItem->appendChild($xml->createElement('s2_vendor_last_date', ''));
$newItem->appendChild($xml->createElement('notes', ''));
$newItem->appendChild($xml->createElement('pos_reminder', ''));
$newItem->appendChild($xml->createElement('invoice_notes', ''));
$newItem->appendChild($xml->createElement('image', $image));
$newItem->appendChild($xml->createElement('selection_code', ''));
$newItem->appendChild($xml->createElement('warranty', ''));
$newItem->appendChild($xml->createElement('locator', ''));
$newItem->appendChild($xml->createElement('bar_label', ''));
$newItem->appendChild($xml->createElement('date_in_house', ''));
$newItem->appendChild($xml->createElement('unit', ''));
$newItem->appendChild($xml->createElement('weight', ''));
$newItem->appendChild($xml->createElement('loyalty_exempt', ''));
$newItem->appendChild($xml->createElement('food_stamp', ''));
$newItem->appendChild($xml->createElement('healthcare', ''));
$newItem->appendChild($xml->createElement('scale', ''));
$newItem->appendChild($xml->createElement('status', 'Pending'));
		
$xml->getElementsByTagName('pending_products')->item(0)->appendChild($newItem);

$xml->save('../products/pending/products_pending.xml');
?>
<div class="container content">';
<div class="alert alert-success" role="alert" style="text-align: center;"><b>Product Added.</b> Would you like to <a href="add_product.php">add another?</a></div>
<?php
include ('resources/footer.php');
?>