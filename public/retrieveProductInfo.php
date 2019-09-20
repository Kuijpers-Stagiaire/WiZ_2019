<?php

// Haal de gtin code op(de code die in de barcode staat).
$gtin = $_GET['barcode'];

// De url waar het product opgehaald moet worden.
$url = "https://api.2ba.nl/1/json/Product/DetailsByGtinA?gtin=".$gtin."&includeFeatures=true";

// De OAuth2(verificatie) token van 2BA, opgevraagd zodra de gebruiker inlogd.
$token = $_GET['token'];

// Initialiser een nieuw PHP cURL http-request.
$curl = curl_init();

// Zet de parameters voor de cURL http-request.
curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"cachce-control: no-cache",
		"Accept: application/json",
		'Authorization: Bearer ' . $token,
		"ResourceVersion: v3",
	),
));

// Voer de http-request uit en stop de opgehaalde waarde in een variable genaamd $response.
$response = curl_exec($curl);

// Als er iets fout gaat, stop de waarde van de foutmelding in een variable genaamd $err.
$err = curl_error($curl);

// Sluit de http-request af.
curl_close($curl);

// Geef een header content-type mee(voor het uitlezen van de json-array).
header('Content-Type: application/json');

// Encode de json-array om uit te lezen in jQuery.
echo json_encode($response);