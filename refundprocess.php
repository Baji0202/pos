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


    try {

        // Decrease the quantity in the receipt_item table
        $updateReceiptItemSQL = "UPDATE receipt_item SET quantity = quantity - ? WHERE receipt_id = ? AND item_id = ?";
        $stmt = $pdoConnect->prepare($updateReceiptItemSQL);
        $stmt->execute([$quantity, $receipt_id, $item_id]);

        // Increase the quantity back in the warehouse (optional, depends on your business logic)
        $updateWarehouseSQL = "UPDATE warehouse SET stock = stock + ? WHERE id = ?";
        $stmt = $pdoConnect->prepare($updateWarehouseSQL);
        $stmt->execute([$quantity, $item_id]);

        $pdoConnect->commit();

        // Display success message
        echo "<h1>Refund Processed</h1>";
        echo "<p>Refund for Item ID: $item_id</p>";
        echo "<p>Receipt ID: $receipt_id</p>";
        echo "<p>Item Name: $item_name</p>";
        echo "<p>Sale Price: $sale_price</p>";
        echo "<p>Quantity: $quantity</p>";
        echo "<p>Total Refund Amount: $total</p>";
    } catch (Exception $e) {
        $pdoConnect->rollBack();
        echo "<h1>Error</h1>";
        echo "<p>Failed to process the refund. Please try again.</p>";
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    // If any of the required parameters are missing, redirect back to refund.php
    header('Location: refund.php');
    exit();
}

// Function to calculate the total refund amount
function calculateItem($price, $quantity) {
    return $price * $quantity;
}
?>
