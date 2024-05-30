<?php
require_once "include/connect/dbcon.php"; 

// Retrieve the posted data
$productjson = file_get_contents("php://input");
var_dump("update".$productjson);

$product = json_decode($productjson, true);

if ($product !== null && isset($product['productIds'])) {
    $products = $product['productIds'];

    // Prepare the SQL statement for fetching the previous quantity
    $sqlFetch = "SELECT quantity FROM products WHERE id = ?";
    $stmtFetch = $pdoConnect->prepare($sqlFetch);

    // Prepare the SQL statement for updating the quantity
    $sqlUpdate = "UPDATE products SET quantity = ? WHERE id = ?";
    $stmtUpdate = $pdoConnect->prepare($sqlUpdate);

    // Loop through each product and update the quantity
    foreach ($products as $item) {
        $itemId = $item['id'];
        $newQuantity = $item['quantity'];

        // Fetch the previous quantity
        $stmtFetch->execute([$itemId]);
        $result = $stmtFetch->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $previousQuantity = $result['quantity'];
            // Calculate the updated quantity
            $updatedQuantity = $previousQuantity - $newQuantity;

            // Update the quantity in the database
            $stmtUpdate->bindParam(1, $updatedQuantity, PDO::PARAM_INT);
            $stmtUpdate->bindParam(2, $itemId, PDO::PARAM_INT);
            $stmtUpdate->execute();
        }
    }
} else {
    echo "no product";
}
