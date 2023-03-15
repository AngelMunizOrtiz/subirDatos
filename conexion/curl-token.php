<?php


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://postulaciones.solutoria.cl/api/acceso',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"userName": "angelmuniz5vs5x_g8j@indeedemail.com",
  "flagJson": true

}',
  CURLOPT_HTTPHEADER => array(
    'accept: */*',
    'Content-Type: application/json-patch+json'
  ),
));

$response = curl_exec($curl);


curl_close($curl);


$obtenerdatos= json_decode($response);

$obToken=$obtenerdatos->token;
// Consigo el Token mediante la variable $obToken

//El echo me confirma si la variable captura el dato de forma correcta.
?>