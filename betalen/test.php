landing > overzicht > product > winkelwagen > login/register/gast >  persoonsgegevens > adressgegevens > betaalmethode > bevestiging


Postcode API: IzialkZYAk6erEyZcIdxeaGMr3tmPbouaVily3uR
https://api.postcodeapi.nu/v2/addresses/

<?php 

$headers = array();
$headers[] = 'X-Api-Key: a0B1c2D34D5c6b7a8';

// De URL naar de API call
$url = 'https://api.postcodeapi.nu/v2/addresses/?postcode=1234AB';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// Indien de server geen TLS ondersteunt kun je met 
// onderstaande optie een onveilige verbinding forceren.
// Meestal is dit probleem te herkennen aan een lege response.
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// De ruwe JSON response
$response = curl_exec($curl);

// Gebruik json_decode() om de response naar een PHP array te converteren
$data = json_decode($response);

curl_close($curl);

?>