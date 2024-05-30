<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit(); // Terminate script after redirection
}
$loggedemail = $_SESSION['email'];
require_once "include/connect/dbcon.php";

$fetch_data = []; // Initialize fetch_data as an empty array
if (isset($_POST['reason'])) {
    $refund = $_POST['reason'];
}
if (isset($_POST['search'])) {
    $receipt = $_POST['receipt'];
    if (empty($receipt)) {
        echo "Please input a receipt ID";
    } else {
        // Adjusted SQL query to fetch item name and sale price from the warehouse table
        $sql = "SELECT ri.id AS receipt_item_id, ri.receipt_id, ri.quantity, p.id AS product_id, p.name, p.sale_price
        FROM receipt_item AS ri
        JOIN products AS p ON ri.item_id = p.id
        WHERE ri.receipt_id = ?";
        
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$receipt]);
        $fetch_data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all matching rows
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund</title>
    <link rel="icon" type="image/png" href="include/image/sadas1.png">
    <link rel="stylesheet" href="include/styles/global.css">
</head>
<body>
<nav>
    <div class="logo">
        <img src="include/image/sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">POS System</div>
    </div>
    
    <div class="dropdown">
        <div class="acc_name" id="acc_name"><?php echo htmlspecialchars($loggedemail); ?></div>
        <!-- Dropdown content -->
        <div class="dropdown-content" id="logout_dropdown">
            <a href="home.php">Home</a>
            <a href="cashmanagement.php">Cash Management</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</nav>
<div class="form" style="margin-top:4%">
    <h2 style="display: block; text-align: center; margin-bottom: 12%;">Refund:</h2>
    <!-- Form for searching receipts -->
    <form method="post">
    <div>
        <label for="receipt">Receipt ID:</label>
        <input type="text" name="receipt" id="receipt" placeholder="Enter receipt id">
        <input type="submit" name="search" value="Search">
    </div>
    
    <div>
        <label for="reason_id">Reason:</label>
        <select name="reason" id="reason_id" class="custom-select" style="margin: 4%;">
            <option value="Expired or spoiled product">Expired or spoiled product</option>
            <option value="Incorrect item received">Incorrect item received</option>
            <option value="Product damaged during transportation">Product damaged during transportation</option>
            <option value="Dissatisfied with product quality">Dissatisfied with product quality</option>
            <option value="Product packaging damaged or tampered">Product packaging damaged or tampered</option>
            <option value="Unwanted or unused item">Unwanted or unused item</option>
            <option value="Product not as described">Product not as described</option>
            <option value="Product past its sell-by date">Product past its sell-by date</option>
            <option value="Product contaminated or foreign object found">Product contaminated or foreign object found</option>
            <option value="Allergic reaction to product">Allergic reaction to product</option>
            <option value="Product missing from order">Product missing from order</option>
            <option value="Overcharged for item">Overcharged for item</option>
            <option value="Change of mind">Change of mind</option>
            <option value="Duplicate purchase">Duplicate purchase</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <input type="submit" name="refund" value="Submit" class="main-button" style="color: black; margin-top: 4%;">
</form>

    <?php 
    if (!empty($fetch_data)) {
        // Display receipt details
        echo "<h3>Receipt ID: " . htmlspecialchars($receipt) . "</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Item name</th>
                    <th>Item price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>";
        foreach ($fetch_data as $item) {
            echo "<tr>
                    <td>" . htmlspecialchars($item['name']) . "</td>
                    <td>" . htmlspecialchars($item['sale_price']) . "</td>
                    <td>" . htmlspecialchars($item['quantity']) . "</td>
                    <td><form action='refundprocess.php' method='POST'>
                    <input type='hidden' name='receipt_item_id' value='" . htmlspecialchars($item['receipt_item_id']) . "'>
                    <input type='hidden' name='reason' value='".$refund."'>
                    <input type='submit' name='refund' value='Refund'>
                </form></td>
                  </tr>";
        }
        echo "</table>";
    }
    ?>


    <!-- Displaying receipt details -->
   
</div>
</body>
</html>
