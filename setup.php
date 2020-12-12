<?php

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://chatapi.viber.com/pa/set_webhook",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "{ \r\n \"url\": \"https://your-domain/viber.php\",\r\n \"event_types\":[\r\n \"conversation_started\"\r\n ]\r\n}",
CURLOPT_HTTPHEADER => array(
"Cache-Control: no-cache",
"Content-Type: application/JSON",
"X-Viber-Auth-Token: VIBER-TOKEN"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}