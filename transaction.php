<?php
session_start();
header('Content-Type: application/json');

$jsonData = file_get_contents("php://input");

if ($jsonData === false) {
    echo json_encode(['error' => 'No input received']);
    exit;
}

$data = json_decode($jsonData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => json_last_error_msg()]);
    exit;
}

    $amount = $data['amount'] ?? 0;

    if ($amount >= 100) {
        $desc = "Payment Option BananaCart";
        $remarks = "on the receipt";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paymongo.com/v1/links",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'data' => [
                    'attributes' => [
                        'amount' => $amount *100, 
                        'description' => $desc,
                        'remarks' => $remarks,
                    ]
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Basic c2tfdGVzdF85U2tHWVIyTlVuSlQ4cUg4cURBYVZySkw6", // Replace this with your actual key
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
       

        $_SESSION['url'] = $responseData['data']['attributes']['checkout_url'];
    }else {
        echo"invalid amount";
    }


echo json_encode(['status' => 'success', 'amount' => $amount]); 
?>
