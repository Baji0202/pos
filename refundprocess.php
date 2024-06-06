<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("location:index.php");
//     exit(); // Terminate script after redirection
// }
require_once "include/connect/dbcon.php"; 

// Check if the form is submitted
// if (isset($_POST['refund'])) {
//     // Retrieve form data
//     $receipt_item_id = $_POST['receipt_item_id'];
//     $reason = $_POST['reason'];
// $quantity = $_POST['order_quantity'];
// $price = $_POST['sale_price'];
// $timestamp = date('Y-m-d H:i:s');

// var_dump($receipt_item_id,$reason,$quantity,$price );

// $sqlFetch = "SELECT quantity FROM products WHERE id = ?";
//     $stmtFetch = $pdoConnect->prepare($sqlFetch);
//     $stmtFetch->execute([ $receipt_item_id]);

//     $productQuan = $stmtFetch->fetch(PDO::FETCH_ASSOC);

//     $availablequan = $productQuan['quantity'];

//     $update = $availablequan - $quantity;
//     // Update inventory with refunded items
//     $sql = "UPDATE products AS p 
//             JOIN receipt_item AS ri ON p.id = ri.item_id 
//             SET p.quantity = ?
//             WHERE ri.id = ?";
//     $stmt = $pdoConnect->prepare($sql);
//     // Execute the update query
//     if ($stmt->execute([$update,$receipt_item_id])) {

//         if (!isset($_SESSION['refunds'])) {
//             $_SESSION['refunds'] = 0;
//         }
//         $_SESSION['refunds'] += $quantity*$price ?? $_SESSION['refunds'] = 0;
//         echo $_SESSION['refunds'];
//     }

//         $sqlstatus = "UPDATE receipt_item
//         SET `status` = ? 
//         WHERE id = ?";
//         $stmtstatus = $pdoConnect->prepare($sqlstatus);
//         $stmtstatus->execute(["refunded",$receipt_item_id]);


//         $sql_insert_refund = "INSERT INTO refund (receipt_item_id, reason, timestamp) 
//                               VALUES (?, ?,?)";
//         $stmt_insert_refund = $pdoConnect->prepare($sql_insert_refund);
//         $stmt_insert_refund->execute([$receipt_item_id, $reason,$timestamp]);
//             // Redirect back to the refund page with success message
//             header("location:refund.php?refund_successful");
//             exit();
        
// } else {
//     // If the form is not submitted, redirect to the refund page
//     header("location:refund.php?failed_to_refund");
//     exit();
// }

if (isset($_POST['refundbtn'])) {
    $receipt_item_id = $_POST['receipt_item_id'];
    $reason = $_POST['reason'];
$quantity = $_POST['order_quantity'];
$price = $_POST['sale_price'];
$timestamp = date('Y-m-d H:i:s');
    if ( empty($receipt_item_id) && empty($reason) && empty($quantity ) && empty($price) ) {
        echo "Item info should not be empty" ;
    } 
    
else {
    
//select product quantity
    $sqlFetch = "SELECT quantity FROM products WHERE id = ?";
    $stmtFetch = $pdoConnect->prepare($sqlFetch);
    $stmtFetch->execute([$receipt_item_id]);
    $productQuan = $stmtFetch->fetch(PDO::FETCH_ASSOC);
    $availablequan = $productQuan['quantity'];
    $update = $availablequan + $quantity;
//update products quantity
    $sql_update_products = "UPDATE products
            SET quantity = ?
            WHERE id = ?";
    $stmt_update_products = $pdoConnect->prepare($sql_update_products);
    
    if($stmt_update_products->execute([$update,$receipt_item_id])){
        $_SESSION['refunds'] += $quantity*$price ?? $_SESSION['refunds'] = 0;
        echo $_SESSION['refunds'];
    } 
//update item refunded
        $sqlstatus = "UPDATE receipt_item
        SET `status` = ? 
        WHERE id = ?";
$stmtstatus = $pdoConnect->prepare($sqlstatus);
$stmtstatus->execute(["refunded",$receipt_item_id]);
//insert into receipt 
        $sql_insert_refund = "INSERT INTO refund_items (receipt_item_id,	cashier_id,	timestamps,	reason) 
                              VALUES (?, ?,?,?)";
        $stmt_insert_refund = $pdoConnect->prepare($sql_insert_refund);
        $stmt_insert_refund->execute([$receipt_item_id, $cashier,$timestamp, $reason]);
}
header("location: refund.php?success");
exit();
$pdoConnect = null;
}else {
    header("location: refund.php?failed");
    exit();
}

