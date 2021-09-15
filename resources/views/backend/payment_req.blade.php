<?php

$vars = '
{
  "code": "u556",
  "description": "Test purchase ",
  "cancel_uri": "http://127.0.0.1:8000/canceled",
  "confirmation_uri": "http://127.0.0.1:8000/confirmed",
  "amount": 10,
  "items": [
    {
      "description": "Purchase Item 1",
      "amount": 10,
      "quantity": 1
    }
  ]
}
';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://payments.air-pay.io/purchases");
curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'Content-Type: application/json',
	'Authorization: Basic "YWU4MjZhYmEtNjQ1ZC00MzVhLWFmNTYtN2Q5NWRkZTE4MzcyOjlhWlI0U0EwSVR1QzZlN0w2UzV3WlZ5WWJ6cXJ2ekxqT2Z2RTR4ZnRMMDhiTnpkNTF3aFBrQVJEMjBFQTZMNkxSVnJIYjRNUE9ubUVYQzVK"',
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = curl_exec ($ch);
curl_close ($ch);

print  $server_output ;
