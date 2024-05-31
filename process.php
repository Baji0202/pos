<?php
session_start();
require_once "include/connect/dbcon.php";
$receiptJson = file_get_contents("php://input");
var_dump($receiptJson);
 
$receipt = json_decode($receiptJson, true);

if ($receipt !== null) {
    $currentDate = date('Y-m-d');

    $receiptId = $receipt['receiptId'];
    $productIds = $receipt['productIds'];
    $subtot = $receipt['subtot'];
    $discount = $receipt['discount'];
    $vat = $receipt['vat'];
    $tot = $receipt['tot'];
    $pay = $receipt['pay'];
    $amount = $receipt['amount'];
    $cchange = $receipt['cchange'];

    if (!isset($_SESSION['sales'])) {
        $_SESSION['sales'] = 0;
    }
    $_SESSION['sales'] += $tot;
    
    $sql = "INSERT INTO `receipt` (`id`, `sub_total`, `discount`, `tax`, `total`, `pay_thru`, `paid_amount`, `change_amount`, `status`, `date`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$receiptId, $subtot, $discount, $vat, $tot, $pay, $amount, $cchange,"sold",$currentDate]);
  
    $sql = "INSERT INTO `receipt_item` (`receipt_id`, `item_id`, `quantity`,`status`) VALUES (?, ?, ?,?)";
    $stmt = $pdoConnect->prepare($sql);

    foreach ($productIds as $item) {
        $itemId = $item['id'];
        $quantity = $item['quantity'];
        $status = "sold";
        // $subTotal = $item['productPrice'] * $quantity; // Calculate subtotal directly
        $stmt->bindParam(1, $receiptId); // Bind order_id (assuming you have this value)
        $stmt->bindParam(2, $itemId);
        $stmt->bindParam(3,$quantity);
        $stmt->bindParam(4,$status);
        $stmt->execute();
    }
    $pdoConnect = null;
    exit;
} else {
    echo "no receipt";
}
?>
      
    
