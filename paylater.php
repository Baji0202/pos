<?php
require_once "include/connect/dbcon.php"; // Use forward slashes for paths

// Check if database connection is successful

if(isset($_GET['billsJson'])) {
    // Retrieve the JSON string from the URL parameter
    $billsJson = $_GET['billsJson'];
    // var_dump($billsJson);
    $bills = json_decode($billsJson, true);

    function calculateSubtotal($itemprice, $itemquan) {
        return $itemprice * $itemquan;
    }

    function generateUniqueInvoiceId() {
        $now = new DateTime('now');
        $dateStr = $now->format('Ymd');
        $timeStr = $now->format('His');
        $random = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);  // Generate a 4-digit random number
        return "INV{$dateStr}{$timeStr}{$random}";
    }

    if ($bills !== null) {
        // Retrieve values from the JSON
        $name = $bills['name'];
        $email = $bills['email'];
        $productIds = $bills['productIds'];
        $subtot = $bills['subtot'];
        $discount = $bills['discount'];
        $tot = $bills['tot'];

        // Fetch discount id
        $sql = "SELECT * FROM discount WHERE name = ?";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$discount]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $discountid = $row['discount_id'];
        } else {
            $discountid = 1;
        }

        // Insert into customer table
        $sql = "INSERT INTO customer (`cname`, `email`) VALUES (?, ?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$name, $email]);
        $lastInsertedcustomer = $pdoConnect->lastInsertId();

        // Insert into orders table
        $currentDate = date('Y-m-d');
        $sql = "INSERT INTO `orders`(`customer_id`, `order_date`) VALUES (?, ?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$lastInsertedcustomer, $currentDate]);
        $lastInsertedOrderId = $pdoConnect->lastInsertId();

        // Insert into order_item table
        $sql = "INSERT INTO `order_item` (`order_id`, `item_id`, `quantity`, `subtotal`) VALUES (?, ?, ?, ?)";
        $stmt = $pdoConnect->prepare($sql);
        foreach ($productIds as $item) {
            $itemId = $item['id'];
            $quantity = $item['quantity'];
            $subTotal = calculateSubtotal($item['productPrice'], $quantity);
            $stmt->execute([$lastInsertedOrderId, $itemId, $quantity, $subTotal]);
        }

        // Insert into bill table
        $uniqueinv = generateUniqueInvoiceId();
        $dtnow = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `bill`(`invcode`, `order_id`, `subtotal`, `discount_id`, `total_amount`, `date_time`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$uniqueinv, $lastInsertedOrderId, $subtot, $discountid, $tot, $dtnow]);
        $lastInsertedbill = $pdoConnect->lastInsertId();

        // Insert into open_ticket table
        $sql = "INSERT INTO `open_ticket`(`bill_id`, `status`) VALUES (?, ?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$lastInsertedbill, "pending"]);
    } else {
        echo "Failed to decode JSON data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Later</title>
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="./include/styles/discount.css">
    <link rel="icon" type="image/png" href="include\image\sadas1.png">
    
</head>
<body>


<nav>
    <div class="logo">
        <img src=".\include\image\logo-black.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div><a href="home.php">Back</a>
</div>

</nav>


<table border='1' cellpadding='7'>
    <tr>
        <th>#</th>
        <th>Bill no.</th>
        <th>Order Id</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Modify</th>
    </tr>
    <?php
    // Fetch and display orders
    $sql = "SELECT open_ticket.oTicket_id, bill.bill_id, bill.order_id, bill.total_amount, open_ticket.status 
            FROM open_ticket 
            INNER JOIN bill ON open_ticket.bill_id = bill.bill_id";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();
    while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($fetch);
        if ($status == "pending") {
            echo "<tr>";
            echo "<td>" . $oTicket_id . "</td>";
            echo "<td>" . $bill_id . "</td>";
            echo "<td>" . $order_id . "</td>";
            echo "<td>" . $total_amount . "</td>";
            echo "<td>" . $status . "</td>";
            echo "<td><button type='button' id='button'>Pay now</button></td>";
            echo "</tr>";
        } else {
            echo "No Pending Customers";
        }
       
      
        
    }
    echo '</table>';
    ?>

</body>
</html>
