<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit(); // Terminate script after redirection
}
$loggedemail = $_SESSION['email'];
require_once "include/connect/dbcon.php";

$fetch_data = []; // Initialize fetch_data as an empty array

if (isset($_POST['search'])) {
    $receipt = $_POST['receipt'];
    if (empty($receipt)) {
        echo "Please input a receipt ID";
    } else {
        // Adjusted SQL query to fetch item name and sale price from the warehouse table
        $sql = "SELECT receipt_item.receipt_id, receipt_item.quantity, products.id, products.name, products.sale_price
        FROM receipt_item
        JOIN products ON receipt_item.item_id = products.id
        WHERE receipt_item.receipt_id = ?";

        
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
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="text" name="receipt" placeholder="Enter receipt id">
        <input type="submit" name="search" value="Search">
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
                    <input type='hidden' name='item_id' value='" . htmlspecialchars($item['id']) . "'>
                    <input type='hidden' name='receipt_id' value='" . htmlspecialchars($receipt) . "'>
                    <input type='submit' name='refund' value='Refund'>
                </form></td>
                  </tr>";
        }
        echo "</table>";
    }
    ?>
    <!-- Form for refund -->
    <form method="post">
        Reason:
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
        
        <input type="submit" name="refund" value="Submit" class="main-button" style="color: black;">
    </form>

    <!-- Displaying receipt details -->
   
</div>
</body>
</html>
