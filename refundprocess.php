<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit(); // Terminate script after redirection
}
require_once "include/connect/dbcon.php"; 

// Check if the form is submitted
if (isset($_POST['refund'])) {
    // Retrieve form data
    $receipt_item_id = $_POST['receipt_item_id'];
    $reason = $_POST['reason'];

    // Update inventory with refunded items
    $sql = "UPDATE products AS p 
            JOIN receipt_item AS ri ON p.id = ri.item_id 
            SET p.quantity = p.quantity + ri.quantity 
            WHERE ri.id = ?";
    $stmt = $pdoConnect->prepare($sql);
    
    // Execute the update query
    if ($stmt->execute([$receipt_item_id])) {
        // Insert refund record into refund table
        $sql_insert_refund = "INSERT INTO refund (receipt_item_id, reason, timestamp) 
                              VALUES (?, ?, NOW())";
        $stmt_insert_refund = $pdoConnect->prepare($sql_insert_refund);
        if ($stmt_insert_refund->execute([$receipt_item_id, $reason])) {
            // Redirect back to the refund page with success message
            header("location:refund.php?success=1");
            exit();
        } else {
            // Redirect back to the refund page with error message
            header("location:refund.php?error=1");
            exit();
        }
    } else {
        // Redirect back to the refund page with error message
        header("location:refund.php?error=1");
        exit();
    }
} else {
    // If the form is not submitted, redirect to the refund page
    header("location:refund.php");
    exit();
}
?>
