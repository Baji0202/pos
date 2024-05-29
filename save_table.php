<?php
session_start();

// Retrieve data sent from JavaScript
$datajs = file_get_contents("php://input");
$data = json_decode($datajs, true);

if (isset($data)) {
    // Initialize an array to store ticket data if not already initialized
    if (!isset($_SESSION['ticketData'])) {
        $_SESSION['ticketData'] = [];
    }

    // Loop through each item in the received data
    foreach ($data as $ticketItem) {
        $customerName = $ticketItem['customerName'];
        $itemName = $ticketItem['itemName'];
        $itemPrice = $ticketItem['itemPrice'];
        $quantity = $ticketItem['quantity'];

        // Check if the customer already exists in the session
        $customerExists = false;
        foreach ($_SESSION['ticketData'] as &$customerTicket) {
            if ($customerTicket['customerName'] === $customerName) {
                // Customer exists, append the item to their ticket
                $customerTicket['items'][] = [
                    'itemName' => $itemName,
                    'itemPrice' => $itemPrice,
                    'quantity' => $quantity
                ];
                $customerExists = true;
                break;
            }
        }

        // If the customer doesn't exist, create a new ticket for them
        if (!$customerExists) {
            $_SESSION['ticketData'][] = [
                'customerName' => $customerName,
                'items' => [
                    [
                        'itemName' => $itemName,
                        'itemPrice' => $itemPrice,
                        'quantity' => $quantity
                    ]
                ]
            ];
        }
    }

    echo 'Data stored in session.';
} else {
    echo 'Invalid data received.';
}
?>
