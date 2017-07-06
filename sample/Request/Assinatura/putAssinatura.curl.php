<?php
/**
 *  Example API call
 *  Create a new Client at database
 */
$url = "http://localhost/solis/phpslimwrapper/sample/assinatura/put/";
$data = array (
    "proOrganizacaoID" => 1,
    "proEntidadeID" => 1,
    "proClienteNome" => 'Ziesemer LTDA',
    "proVencimento" => '2017-12-31',
    "proEncerramento" => '2017-12-31',
    "proValor" => 5.0,
    "proSituacao" => 1,
    "proTipoCobranca" => 2,
    "proObservacao" => 'Esse é um serviço de teste cadastrado através de um exemplo. ('.uniqid().')',
    "proServicoID" => 1,
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