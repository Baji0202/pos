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
        echo("Please input a receipt ID");
    } else {
        $sql = "SELECT 
                    *
                FROM 
                    receipt_item
                WHERE
                    receipt_id = ?";
        
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
</head>
<body>
<nav>
    <div class="logo">
        <img src="include/image/sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">POS System</div>
        <link rel="stylesheet" href="include/styles/global.css">
    </div>
    
    <div class="dropdown">
        <div class="acc_name" id="acc_name"><?php echo $loggedemail?></div>
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="receipt" placeholder="Enter receipt id">
        <input type="submit" name="search" value="Search">
    </form>

    <!-- Form for refund -->
    <form method="post">
        Reason:
        <select name="reason" id="reason_id" class="custom-select" style="margin: 4%;">
            <option value="Change of mind">Change of mind</option>
            <option value="Defect">Defective Item</option>
            <option value="Others">Others</option>
        </select>
        
        <input type="submit" name="refund" value="Submit" class="main-button" style="color: black;">
    </form>

    <!-- Displaying receipt details -->
    <?php 
    if (isset($_POST['search'])) {
        if (empty($fetch_data)) {
            echo "Receipt not found.";
        } else {
            // Display receipt details
            echo "Receipt ID: " . $receipt . "<br>";
            foreach ($fetch_data as $item) {
                echo "Item ID: " . $item['item_id'] . ", Quantity: " . $item['quantity'] . "<br>";
            }
        }
    }
    ?>
</div>
</body>
</html>
