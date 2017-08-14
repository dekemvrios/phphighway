<?php

$id = 1;

$url = "http://localhost/legacy/getOne/?recordId={$id}";

// set up the curl resource
$rCh = curl_init();
curl_setopt($rCh, CURLOPT_URL, $url);
curl_setopt($rCh, CURLOPT_RETURNTRANSFER, true);
curl_setopt($rCh, CURLOPT_HEADER, false);
curl_setopt($rCh, CURLOPT_HTTPHEADER, [
    'Authorization: 1471036882595f79abf16587.70188608',
]);

// execute the request
$sOutput = curl_exec($rCh);

// output the profile information - includes the header
echo ($sOutput) . PHP_EOL;

// close curl resource to free up system resources
curl_close($rCh);