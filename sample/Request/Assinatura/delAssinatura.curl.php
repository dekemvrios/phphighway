<?php
/**
 *  Example API call
 *  Create a new Client at database
 */
$url = "http://localhost/solis/phpslimwrapper/sample/assinatura/del/";

$ID = (isset($_GET['ID']) && $_GET['ID'] > 0 ? $_GET['ID'] : 2);

$data = array (
    "ID" => $ID
);

// Data JSON
$dataJson = json_encode($data);

// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: l99IhVg9429yzv18QLF7GTJM6PUO8L3f',
    'Content-Type: application/json',
    'Content-Length: ' . strlen($dataJson)
));

// execute the request
$output = curl_exec($ch);

// output the profile information - includes the header
echo($output) . PHP_EOL;

// close curl resource to free up system resources
curl_close($ch);