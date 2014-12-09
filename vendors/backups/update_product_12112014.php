<?php

//include ('resources/header.php');

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
$user['product_fee'] = '2';
$user['vendorid'] = '2';
$user['product_fee'] = '5';
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
if (isset($node_count) && !empty($node_count)) {
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
    $image = 'Image_Path';
    $status = 'Pending';
    $quantity = $_POST['product_quantity'];
    $size = $_POST['product_size'];
    $color = $_POST['product_color'];
    $vendor_item_no = date('dHis');
    $product_sku = $sku_product;

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
    $newItem->appendChild($xml->createElement('avg_cost', 'avg_cost'));
    $newItem->appendChild($xml->createElement('freight', 'freight'));
    $newItem->appendChild($xml->createElement('w_cost', '$' . $update_our_price));
    $newItem->appendChild($xml->createElement('retail', '$' . $_POST['product_price']));
    $newItem->appendChild($xml->createElement('our_price', '$' . $_POST['product_price']));
    $newItem->appendChild($xml->createElement('min_price', '$' . $_POST['product_price']));
    $newItem->appendChild($xml->createElement('p_vendor_number', $update_vendor));
    $newItem->appendChild($xml->createElement('p_vendor_item_number', $vendor_item_no));

    $newItem->appendChild($xml->createElement('name', $_POST['product_name']));
    $newItem->appendChild($xml->createElement('price', '$' . $_POST['product_price']));
    $newItem->appendChild($xml->createElement('ourprice', '$' . $update_our_price));
    $newItem->appendChild($xml->createElement('vendor', $update_vendor));
    $newItem->appendChild($xml->createElement('consignmentfee', $consignment_fee));
    $newItem->appendChild($xml->createElement('websiteprice', '$' . $update_website_price));
    $newItem->appendChild($xml->createElement('image', 'TestImagePath'));
    $newItem->appendChild($xml->createElement('status', 'Pending'));

//$xml->getElementsByTagName('pending_products')->item(0)->appendChild($newItem);


    $xml->appendChild($newItem);

    $dom = new DomDocument;
    $dom->load('../products/pending/products_pending.xml');

// Locate the old parent node
    $xpath = new DOMXpath($dom);
    $nodelist = $xpath->query('/pending_products/product');
    $oldnode = $nodelist->item($node_count);
//print_r($oldnode);


    $newnode = $dom->importNode($xml->documentElement, true);

// Replace
    $oldnode->parentNode->replaceChild($newnode, $oldnode);

// Display
//$xml->save('c.xml')
    $dom->save('../products/pending/products_pending.xml');

//$xml->save('../products/pending/products_pending.xml');
//echo '<div class="container content">';
//echo '<a href="add_product.php">Add Another</a>';
//include ('resources/footer.php');
    echo 1;
} else {
    echo 2;
}
?>