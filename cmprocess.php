<?php
session_start();
require_once "include/connect/dbcon.php";
include_once "admin_side/log.php";

if (isset($_SESSION['user_id'])) {
    $loggeduser = $_SESSION['user_id'];
} else {
    // Redirect to index if no user is logged in
    header('location: index.php');
    exit;
}

$inputData = file_get_contents("php://input");
$data = json_decode($inputData, true);

if ($data !== null) {
    $startCash = $data['startcash'];
    $sales = $data['sales'];
    $paidIn = $data['paidIn'];
    $paidOut = $data['paidOut'];
    $refunds = $data['refunds'];
    $expectedCash = $data['expectedCash'];
    $actualCash = $data['actualCash'];
    $cashDiff = $data['cashdiff'];

    $sql = "INSERT INTO `cash_management` (`cashier_id`, `start_amount`, `payments`, `payment_refund`, `paid_in`, `paid_out`, `expected_amount`, `actual_cash`, `difference`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$loggeduser, $startCash, $sales, $refunds, $paidIn, $paidOut, $expectedCash, $actualCash, $cashDiff]);

} else {
    echo "Invalid data";
}
?>
