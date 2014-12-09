<?php

//include ('resources/header.php');

$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('../products/pending/products_pending.xml');
//die("asdasd");
//echo "<pre>";
//$sku_product = "VN-000030142504";
$sku_product = $_POST['pid'];
//$sku_product = "VN-000130143730";
////$dom = new DOMDocument;
//$dom->loadXML($xml);
$skudata = $xml->getElementsByTagName('sku');
//print_r($skudata);
$k = 0;
foreach ($skudata as $sku) {
    $skuval = $sku->nodeValue;
    if ($skuval == $sku_product) {
        //echo "inside";
        $node_count = $k;
    }
    $k++;
}
//echo "skuval".$skuval;
//echo "node" . $node_count;
if (isset($node_count) && !empty($node_count)) {
$inventory_type = $xml->getElementsByTagName('inventory_type')->item($node_count)->nodeValue;
$model_number = $xml->getElementsByTagName('model_number')->item($node_count)->nodeValue;
$product_sku = $xml->getElementsByTagName('sku')->item($node_count)->nodeValue;
$category = $xml->getElementsByTagName('category')->item($node_count)->nodeValue;
$subcategory = $xml->getElementsByTagName('subcategory')->item($node_count)->nodeValue;
$description = $xml->getElementsByTagName('description')->item($node_count)->nodeValue;
$manufacturer = $xml->getElementsByTagName('manufacturer')->item($node_count)->nodeValue;
$barcode_upc = $xml->getElementsByTagName('barcode_upc')->item($node_count)->nodeValue;
$color = $xml->getElementsByTagName('color')->item($node_count)->nodeValue;
$size = $xml->getElementsByTagName('size')->item($node_count)->nodeValue;
$min = $xml->getElementsByTagName('min')->item($node_count)->nodeValue;
$max = $xml->getElementsByTagName('max')->item($node_count)->nodeValue;
$quantity = $xml->getElementsByTagName('quantity')->item($node_count)->nodeValue;
$avg_cost = $xml->getElementsByTagName('avg_cost')->item($node_count)->nodeValue;
$freight = $xml->getElementsByTagName('freight')->item($node_count)->nodeValue;
$w_cost = $xml->getElementsByTagName('w_cost')->item($node_count)->nodeValue;
$retail = $xml->getElementsByTagName('retail')->item($node_count)->nodeValue;
$our_price = $xml->getElementsByTagName('our_price')->item($node_count)->nodeValue;
$min_price = $xml->getElementsByTagName('min_price')->item($node_count)->nodeValue;
$p_vendor_number = $xml->getElementsByTagName('p_vendor_number')->item($node_count)->nodeValue;
$p_vendor_item_number = $xml->getElementsByTagName('p_vendor_item_number')->item($node_count)->nodeValue;
$name = $xml->getElementsByTagName('name')->item($node_count)->nodeValue;
$price = $xml->getElementsByTagName('price')->item($node_count)->nodeValue;
$ourprice = $xml->getElementsByTagName('ourprice')->item($node_count)->nodeValue;
$vendor = $xml->getElementsByTagName('vendor')->item($node_count)->nodeValue;
$consignmentfee = $xml->getElementsByTagName('consignmentfee')->item($node_count)->nodeValue;
$websiteprice = $xml->getElementsByTagName('websiteprice')->item($node_count)->nodeValue;
$image = $xml->getElementsByTagName('image')->item($node_count)->nodeValue;
$status = $xml->getElementsByTagName('status')->item($node_count)->nodeValue;



//$_POST['product_name'] = 'sb product';
//$_POST['product_description'] = 'sb discr';
//$_POST['product_price'] = '22';
//$_POST['product_quantity'] = 6;
//$_POST['product_size'] = 'Large';
//$_POST['product_color'] = 'Blue';
//$_POST['qty'] = 'Clothes';
//$_POST['product_category'] = 'cat 1';
//$_POST['product_subcategory'] = 'subcat 1';
//print_r($xml);

//$name = $_POST['product_name'];
//$description = $_POST['product_description'];
//$price = $_POST['product_price'];
//$our_price_unformatted = $price - ($price * $user['product_fee']);
//$update_our_price = number_format($our_price_unformatted, 2, '.', '');
//$website_price = $_POST['product_price'] * 1.25;
//$update_website_price = number_format($website_price, 2, '.', '');
//$update_vendor = $user['vendorid'];
//$consignment_fee = $user['product_fee'];
//$category = $_POST['product_category'];
//$subcategory = $_POST['product_subcategory'];
//$image = 'Image_Path';
//$status = 'Pending';
//$quantity = $_POST['product_quantity'];
//$size = $_POST['product_size'];
//$color = $_POST['product_color'];
//$vendor_item_no = date('dHis');
//$product_sku = $sku_product;

//print_r($_POST);
//die();
//$element = $xml->getElementsByTagName('product')->item(0);
//
//$name = $element->getElementsByTagName('name')->item(0);
//$description = $element->getElementsByTagName('description')->item(0);
//$price = $element->getElementsByTagName('price')->item(0);
//$our_price = $element->getElementsByTagName('ourprice')->item(0);
//$quantity = $element->getElementsByTagName('quantity')->item(0);
//$size = $element->getElementsByTagName('size')->item(0);
//$color = $element->getElementsByTagName('color')->item(0);
//$vendor = $element->getElementsByTagName('vendor')->item(0);
//$category = $element->getElementsByTagName('category')->item(0);
//$subcategory = $element->getElementsByTagName('subcategory')->item(0);
//$image = $element->getElementsByTagName('image')->item(0);
$dom = new DomDocument;
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
//$xml->load('../products/pending/products_pending.xml');

$dom->load('../products/complete/products_completed.xml');
$newItem = $dom->createElement('product');

$newItem->appendChild($dom->createElement('inventory_type', $inventory_type));
$newItem->appendChild($dom->createElement('model_number', $model_number));
$newItem->appendChild($dom->createElement('sku', $product_sku));
$newItem->appendChild($dom->createElement('category', $category));
$newItem->appendChild($dom->createElement('subcategory', $subcategory));
$newItem->appendChild($dom->createElement('description', $description));
$newItem->appendChild($dom->createElement('manufacturer', $manufacturer));
$newItem->appendChild($dom->createElement('barcode_upc', $barcode_upc));
$newItem->appendChild($dom->createElement('color', $color));
$newItem->appendChild($dom->createElement('size', $size));
$newItem->appendChild($dom->createElement('min', $min));
$newItem->appendChild($dom->createElement('max', $max));
$newItem->appendChild($dom->createElement('quantity', $quantity));
$newItem->appendChild($dom->createElement('avg_cost', $avg_cost));
$newItem->appendChild($dom->createElement('freight', $freight));
$newItem->appendChild($dom->createElement('w_cost', $w_cost));
$newItem->appendChild($dom->createElement('retail', $retail));
$newItem->appendChild($dom->createElement('our_price', $our_price));
$newItem->appendChild($dom->createElement('min_price',  $min_price));
$newItem->appendChild($dom->createElement('p_vendor_number', $p_vendor_number));
$newItem->appendChild($dom->createElement('p_vendor_item_number', $p_vendor_item_number));

$newItem->appendChild($dom->createElement('name', $name));
$newItem->appendChild($dom->createElement('price', $price));
$newItem->appendChild($dom->createElement('ourprice', $ourprice));
$newItem->appendChild($dom->createElement('vendor', $vendor));
$newItem->appendChild($dom->createElement('consignmentfee', $consignmentfee));
$newItem->appendChild($dom->createElement('websiteprice', $websiteprice));
$newItem->appendChild($dom->createElement('image', $image));
$newItem->appendChild($dom->createElement('status', $status));

$dom->getElementsByTagName('aproved_products')->item(0)->appendChild($newItem);
//
//
//$xml->appendChild($newItem);
//
//$dom = new DomDocument;
//$dom->load('../products/pending/products_pending.xml');
//
//// Locate the old parent node
//$xpath = new DOMXpath($dom);
//$nodelist = $xpath->query('/pending_products/product');
//$oldnode = $nodelist->item($node_count);
////print_r($oldnode);
//
//
//$newnode = $dom->importNode($xml->documentElement, true);
//
//// Replace
//$oldnode->parentNode->replaceChild($newnode, $oldnode);

// Display
//$xml->save('c.xml')
//$dom = new DomDocument;
//$dom->load('../products/complete/products_completed.xml');

// Locate the old parent node


 $dom->save('../products/complete/products_completed.xml');

 $doc = new DOMDocument;
$doc->load('../products/pending/products_pending.xml');

$mainprod = $doc->documentElement;

// we retrieve the chapter and remove it from the book
$product = $mainprod->getElementsByTagName('product')->item($node_count);
$oldproduct = $mainprod->removeChild($product);

$doc->save('../products/pending/products_pending.xml');


//$xml->save('../products/pending/products_pending.xml');

//echo '<div class="container content">';
//echo '<a href="add_product.php">Add Another</a>';
//include ('resources/footer.php');
    echo 1;
} else {
    echo 2;
}
?>