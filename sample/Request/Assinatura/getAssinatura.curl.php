<?php
/**
 *  Example API call
 *  Create a new Client at database
 */
$sUrl = "http://localhost/solis/phpslimwrapper/sample/assinatura/get/";

// set up the curl resource
$rCh = curl_init();
curl_setopt($rCh, CURLOPT_URL, $sUrl);
curl_setopt($rCh, CURLOPT_RETURNTRANSFER, true);
curl_setopt($rCh, CURLOPT_HEADER, false);
curl_setopt($rCh, CURLOPT_HTTPHEADER, array(
    'Authorization: l99IhVg9429yzv18QLF7GTJM6PUO8L3f'
));

// execute the request
$sOutput = curl_exec($rCh);

// output the profile information - includes the header
echo($sOutput) . PHP_EOL;

// close curl resource to free up system resources
curl_close($rCh);