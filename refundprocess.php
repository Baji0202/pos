<?php
session_start();
require_once "include/connect/dbcon.php";
if (isset($_GET['item_id'], $_GET['receipt_id'], $_GET['item_name'], $_GET['sale_price'], $_GET['quantity'])) {
    $item_id = htmlspecialchars($_GET['item_id']);
    $receipt_id = htmlspecialchars($_GET['receipt_id']);
    $item_name = urldecode($_GET['item_name']);
    $sale_price = urldecode($_GET['sale_price']); 
    $quantity = urldecode($_GET['quantity']); 

    $total = calculateItem($sale_price, $quantity);

    $_SESSION['refunds'] = -abs($total);
} else {
   
    header('Location: refund.php');
    exit();
}

// Function to calculate the total refund amount
function calculateItem($price, $quantity) {
    return $price * $quantity;
}
?>
