<?php



    $allowed = array('png', 'jpg', 'gif');
$fileName = $_POST['skudata'];
//echo '<pre>';
//print_r($_FILES);
//echo 'gg';
if(isset($_FILES['skudata_file']) && $_FILES['skudata_file']['error'] == 0){

	$extension = pathinfo($_FILES['skudata_file']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		//echo '{"status":"error"}';
		//exit;
	}

	if(move_uploaded_file($_FILES['skudata_file']['tmp_name'], 'uploads/'.$fileName.'.jpg')){
		//echo '{"status":"success"}';
		//exit;
	}
}

//echo '{"status":"error"}';
//exit;


//include ('resources/header.php');
require_once("resources/functions.php");
require_once("resources/db-const.php");
@session_start();
error_reporting(0);

if (logged_in() == false) {
  redirect_to("login.php");
  } else {
  if (isset($_GET['id']) && $_GET['id'] != "") {
  $id = $_GET['id'];
  } else {
  $id = $_SESSION['user_id'];
  }

  ## connect mysql server
  $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
  # check connection
  if ($mysqli->connect_errno) {
  echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
  exit();
  }
  ## query database
  # fetch data from mysql database
  $sql = "SELECT * FROM users WHERE id = {$id} LIMIT 1";

  if ($result = $mysqli->query($sql)) {
  $user = $result->fetch_array();
  } else {
  echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
  exit();
  }

  //if ($result->num_rows == 1) {
  //	# calculating online status
  //	if (time() - $user['status'] <= (5*60)) { // 300 seconds = 5 minutes timeout
  //		$status = "Online";
  //	} else {
  //		$status = "Offline";
  //	}

  //	# echo the user profile data
  //	echo "<p>User ID: {$user['id']}</p>";
  //	echo "<p>Username: {$user['username']}</p>";
  //	echo "<p>Status: {$status}</p>";
  //} else { // 0 = invalid user id
  //	echo "<p><b>Error:</b> Invalid user ID.</p>";
  //}
  } 





$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('../products/pending/products_pending.xml');


//$sku_product = "VN-000030142504";
$sku_product = $_POST['skudata'];
//$dom = new DOMDocument;
//$dom->loadXML($xml);
$skudata = $xml->getElementsByTagName('sku');
//print_r($skudata);
$k = 0;
foreach ($skudata as $sku) {
    $skuval = $sku->nodeValue;
    if ($skuval == $sku_product) {

        $node_count = $k;
    }
    $k++;
}
//echo "skuval".$skuval;
//echo "node" . $node_count;
//$user['product_fee'] = '2';
//$user['vendorid'] = '2';
//$user['product_fee'] = '5';

if (isset($node_count) ) {
    
    
    
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['product_price'];
     $price =  preg_replace('/\$*/', '', $price);
    $our_price_unformatted = $price - ($price * $user['product_fee']);
    $update_our_price = number_format($our_price_unformatted, 2, '.', '');
    $website_price = $price * 1.25;
    $update_website_price = number_format($website_price, 2, '.', '');
    $update_vendor = $_POST['vendor'];
    $consignment_fee = $user['product_fee'];
    $category = $_POST['product_category'];
    $subcategory = $_POST['product_subcategory'];
    $status = 'Pending';
    $quantity = $_POST['product_quantity'];
    $size = $_POST['product_size'];
    $color = $_POST['product_color'];
    $vendor_item_no = date('dHis');
    $product_sku = $sku_product;
	$image = 'uploads/'.$product_sku.'.jpg';


    $xml = new DomDocument;
    $newItem = $xml->createElement('product');

    $newItem->appendChild($xml->createElement('inventory_type', 'inventory_type'));
    $newItem->appendChild($xml->createElement('model_number', 'model_number'));
    $newItem->appendChild($xml->createElement('sku', $product_sku));
    $newItem->appendChild($xml->createElement('category', $_POST['product_category']));
    $newItem->appendChild($xml->createElement('subcategory', $_POST['product_subcategory']));
    $newItem->appendChild($xml->createElement('description', $_POST['product_description']));
    $newItem->appendChild($xml->createElement('manufacturer', 'manufacturer'));
    $newItem->appendChild($xml->createElement('barcode_upc', 'barcode_upc'));
    $newItem->appendChild($xml->createElement('color', $_POST['product_color']));
    $newItem->appendChild($xml->createElement('size', $_POST['product_size']));
    $newItem->appendChild($xml->createElement('min', 'min'));
    $newItem->appendChild($xml->createElement('max', 'max'));
    $newItem->appendChild($xml->createElement('quantity', $_POST['product_quantity']));
    $newItem->appendChild($xml->createElement('avg_cost', $update_our_price));
    $newItem->appendChild($xml->createElement('freight', ''));
    $newItem->appendChild($xml->createElement('w_cost', '$' . $update_our_price));
    $newItem->appendChild($xml->createElement('retail', '$' . $price));
    $newItem->appendChild($xml->createElement('our_price', '$' . $price));
    $newItem->appendChild($xml->createElement('min_price', '$' . $price));
    $newItem->appendChild($xml->createElement('p_vendor_number', $update_vendor));
    $newItem->appendChild($xml->createElement('p_vendor_item_number', $vendor_item_no));

    $newItem->appendChild($xml->createElement('name', $_POST['product_name']));
    $newItem->appendChild($xml->createElement('price', '$' . $price));
    $newItem->appendChild($xml->createElement('ourprice', '$' . $update_our_price));
    $newItem->appendChild($xml->createElement('vendor', $update_vendor));
    $newItem->appendChild($xml->createElement('consignmentfee', $consignment_fee));
    $newItem->appendChild($xml->createElement('websiteprice', '$' . $update_website_price));
    $newItem->appendChild($xml->createElement('image', $image));
    $newItem->appendChild($xml->createElement('status', 'Pending'));




    $xml->appendChild($newItem);

    $dom = new DomDocument;
    $dom->load('../products/pending/products_pending.xml');


    $xpath = new DOMXpath($dom);
    $nodelist = $xpath->query('/pending_products/product');
    $oldnode = $nodelist->item($node_count);



    $newnode = $dom->importNode($xml->documentElement, true);


    $oldnode->parentNode->replaceChild($newnode, $oldnode);

    $dom->save('../products/pending/products_pending.xml');


    redirect_to($_SERVER['HTTP_REFERER']);
    
    //echo 1;
} else {
    //echo 2;
    redirect_to($_SERVER['HTTP_REFERER']);
    
}



?>