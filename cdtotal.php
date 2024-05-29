<?php
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve JSON data from the request body
    $cdtotaljs = file_get_contents("php://input");
    
    // Decode JSON data
    $cdtotal = json_decode($cdtotaljs, true);

    // Check if JSON decoding was successful
    if ($cdtotal !== null) {
        // Store decoded data in session variables
        $_SESSION['cdsubtotal'] = $cdtotal['cdsubtotal'];
        $_SESSION['cdtotal'] = $cdtotal['cdtotal'];
        $_SESSION['cdvat'] = $cdtotal['cdvat'];
        $_SESSION['cddiscount'] = $cdtotal['cddiscount'];

        // Optionally, you can send a response back to the client
        echo "Data stored in session successfully.";
    } else {
        // Send an error response back to the client if JSON decoding fails
        http_response_code(400);
        echo "Failed to decode JSON data.";
    }
} else {
    // Send an error response back to the client if the request method is not POST
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
