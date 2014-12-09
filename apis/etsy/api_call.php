<?php
//Etsy API Call

//Construct Requirements
$apiKey = 'wcals2jz7gosh66vbclcz56f';
$apiSecret = '0vorm4tl9f';

$oauth = new OAuth($apiKey, $apiSecret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);

$oauth->setToken($apiKey,$apiSecret);

try {
 $url = "http://openapi.etsy.com/v2/listings";

 $params = array('description' => 'thisisdesc',
				 'price'=>"5.99",
				 'quantity'=>"2",
				 'shipping_template_id'=>"52299",
				 'shop_section_id'=>"1",
				 'title'=>"thisistitle",
				 'category_id'=>"1",
				 'who_made'=>"0.99",
				 'is_supply'=>"true",
				 'when_made'=>"2010_2012");


 $oauth->fetch($url, $params, OAUTH_HTTP_METHOD_POST);
 print_r(json_decode($json, true));


} catch (OAuthException $e) {

 print_r($e);

 error_log($e->getMessage());
 error_log(print_r($oauth->getLastResponse(), true));
 error_log(print_r($oauth->getLastResponseInfo(), true));
 exit;
 }

 echo $oauth;
?>