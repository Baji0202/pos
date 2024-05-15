<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit(); // Terminate script after redirection
}
$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";

if (isset($_POST['search'])) {
    $receipt = $_POST['receipt'];
    if (empty($receipt)) {
        echo("Please input a receipt ID");
    } else {
        $sql = "SELECT 
                    receipt.id AS receipt_id, 
                    receipt.date,
                    receipt.pay_thru, 
                    receipt.total, 
                    receipt.paid_amount, 
                    receipt.change_amount, 
                    receipt.status, 
                    items.name AS item_name, 
                    receipt_item.quantity, 
                    items.price,
                    discount.name AS discount_name, 
                    tax.tax_name
                FROM 
                    receipt
                JOIN 
                    receipt_item ON receipt.id = receipt_item.receipt_id
                JOIN 
                    items ON receipt_item.item_id = items.id
                LEFT JOIN
                    discount ON receipt.discount_id = discount.discount_id
                LEFT JOIN
                    tax ON receipt.tax_id = tax.id
                WHERE
                    receipt.id = ?";
        
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$receipt]);
        $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll since we expect only one row
        
        if (!$fetch_data) {
            echo "Receipt not found.";
        } else {
            // Display receipt details
            echo "Receipt ID: " . $fetch_data['receipt_id'] . 
                ", Date: " . $fetch_data['date'] . 
                ", Payment Method: " . $fetch_data['pay_thru'] . 
                ", Total: " . $fetch_data['total'] . 
                ", Paid Amount: " . $fetch_data['paid_amount'] . 
                ", Change Amount: " . $fetch_data['change_amount'] . 
                ", Status: " . $fetch_data['status'] . "<br>";

            // Display items
            echo "Items:<br>";
            echo "Item: " . $fetch_data['item_name'] . ", Quantity: " . $fetch_data['quantity'] . ", Price: " . $fetch_data['price'] . "<br>";

            // Print discount and tax details
            echo "Discount: " . $fetch_data['discount_name'] . "<br>";
            echo "Tax: " . $fetch_data['tax_name'] . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund</title>
</head>
<body>
    <!-- Form for searching receipts -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="receipt" placeholder="Enter receipt id">
        <input type="submit" name="search" value="Search">
    </form>

    <!-- Form for refund -->
    <form method="post">
        Reason:
        <select name="reason" id="reason_id">
            <option value="Change of mind">Change of mind</option>
            <option value="Defect">Defective Item</option>
            <option value="Others">Others</option>
        </select>
        <input type="submit" name="refund" value="Refund">
    </form>

    <!-- Displaying receipt details -->
    <?php 
    if (isset($fetch_data)) {
        echo "Receipt ID: " . $fetch_data['receipt_id'] . 
            ", Date: " . $fetch_data['date'] . 
            ", Payment Method: " . $fetch_data['pay_thru'] . 
            ", Total: " . $fetch_data['total'] . 
            ", Paid Amount: " . $fetch_data['paid_amount'] . 
            ", Change Amount: " . $fetch_data['change_amount'] . 
            ", Status: " . $fetch_data['status'] . "<br>";

        // Display items
        echo "Items:<br>";
        echo "Item: " . $fetch_data['item_name'] . ", Quantity: " . $fetch_data['quantity'] . ", Price: " . $fetch_data['price'] . "<br>";

        // Print discount and tax details
        echo "Discount: " . $fetch_data['discount_name'] . "<br>";
        echo "Tax: " . $fetch_data['tax_name'] . "<br>";
    }
    ?>
</body>
</html>
