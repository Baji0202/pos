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
    $item_id = $_POST['item_id'];
    $receipt_id = $_POST['receipt_id'];

    // Update inventory with refunded items
    $sql = "UPDATE products SET quantity = quantity + ? WHERE id = ?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->bindParam(1, $quantity, PDO::PARAM_INT);
    $stmt->bindParam(2, $item_id, PDO::PARAM_INT);
    
    // Execute the update query
    if ($stmt->execute()) {
        // Insert refund record into refund table
        $sql_insert_refund = "INSERT INTO refund (receipt_item_id, reason, date) 
                      VALUES (?, ?, ?, NOW())";
        $stmt_insert_refund = $pdoConnect->prepare($sql_insert_refund);
        $stmt_insert_refund->execute([$item_id, $receipt_id, $reason]);

        // Redirect back to the refund page with success message
        header("location:refund.php?success=1");
        exit();
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
