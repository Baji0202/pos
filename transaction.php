<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
  'body' => '{"data":{"attributes":{"amount":3000,"description":"dwwdw","remarks":"wdwd"}}}',
  'headers' => [
    'accept' => 'application/json',
    'authorization' => 'Basic c2tfdGVzdF85U2tHWVIyTlVuSlQ4cUg4cURBYVZySkw6',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/png" href="include\image\sadas1.png">
    
</head>
<body>
    
</body>
</html>