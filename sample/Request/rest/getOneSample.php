<?php

$id = 1;

$url = "http://localhost/rest/{$id}";

// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: 1471036882595f79abf16587.70188608',
    'Content-Type: application/json'
]);

// execute the request
$output = curl_exec($ch);

// output the profile information - includes the header
echo ($output) . PHP_EOL;

// close curl resource to free up system resources
curl_close($ch);