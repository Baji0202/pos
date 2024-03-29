<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:..\index.php");
}

require_once "..\include\connect\dbcon.php";
include_once "log.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `discount` WHERE discount_id = ?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$id]);

    // Log the deletion
    loghistory($pdoConnect, "Deleted discount, user_id: $id");

    // Redirect to user settings page after deletion
    header("location:discount.php");
    $pdoConnect = null;
    exit;
} else {
    echo "Invalid discount.";
}
?>