<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");

}
$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";

try {
    $sql = "SELECT * FROM discount";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();

    $sqlTax = "SELECT * FROM tax WHERE tax_name = ?";
    $stmtTax = $pdoConnect->prepare($sqlTax);
    $stmtTax->execute(["vat"]);
    $vat = $stmtTax->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("error select discount").$e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <link rel="icon" type="image/png" href="include\image\logo.png">
    <link rel="stylesheet" href="include\styles\home.css">
    <link rel="stylesheet" href="include\styles\global.css">
    <link rel="icon" type="image/png" href="include\image\sadas1.png">
    
    <style>
 #toggleButton {
        background-color: #ddd;
        border: none;
        color: #000;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    #textInput {
        display: none;
        margin-top: 10px;
    }

    #loadingIndicator {     
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999; 
    display: flex;
    justify-content: center;
    align-items: center;
}


.spinner {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 12px solid rgba(255, 255, 255, 0.3);
    border-top-color: yellow;
    animation: spin 1s infinite linear;
    position: absolute;
    top: 30%;
    left: 45%; /* patch lang 2 haha */
    transform: translate(-50%, -50%);
}


@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
button:disabled{
    background-color: brown;
    color:#000;
}
    </style>
</head>
<body>
    
<div id="loadingIndicator" style="display: none;">
  <div class="spinner"></div>
</div>

<nav>
    <div class="logo">
    <img src="include\image\sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">POS System</div>
    </div>
    
    <div class="dropdown">
        <div class="acc_name" id="acc_name"><?php echo $loggedemail?></div>
        <!-- Dropdown content -->
        <div class="dropdown-content" id="logout_dropdown">
        <a href="customerdisplay.php" target="_blank">Open Customer Display</a>
            <a href="refund.php">Refunds</a>
            <a href="cashmanagement.php">Cash Management</a>
            <a href="logout.php" class="logout-btn">Logout</a>
            
        </div>
    </div>
</nav>

<div class="maincontainer">

    <div class="maincontent">
    
<div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            
     
    </table> 
    


    <p id="total-value">Sub Total: ₱0.00</p>
    Discount:
    <select name="discount" id="discount" class="custom-select">
    <?php
    if ($stmt->rowCount()>0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['value'] . "' data-type='" . $row['type'] . "'>" . $row['name'] . "</option>";

        }
    }
    ?>
</select>

    <p id="vat">VAT: <?php echo $vat['tax_percent'];?>%</p>
    <button id="open-ticket-button">Save Table</button>
    <button id="total-button" class="main-button" >Total</button>
    <h2 id="gtotal">Total: ₱0.00</h2>
    </div>
    <p>Payment method:</p>
    <select name="paymentmethod" id="paymentmethod" class="custom-select" disabled>
    <option value="">Select here</option>
<option value="Cash">Cash</option>
<option value="Gcash">Gcash</option>
    </select>
    
    <div id="cash" style="display: none;">
    Cash Payment:
    <input type="text" id="cpayment" pattern="[0-9]*" disabled>
    <button id="changebtn" disabled>Change</button>
    <p id="cchange">Change:</p>
    </div>
    <button id="gcash" disabled style="display: none;">Gcash</button> <br><br>
    <button id="make-receipt" disabled>Make a receipt</button>
    <!-- <button id="paylater" disabled>Add to Pay Later</button>
    <button id="opentickets">View Open Tickets</button> -->
    <button id="toggleButton" class="main-button" onclick="toggleInput()">Banana Card</button>
    <input type="text" id="bananacard" style="display: none;">
    </div>


    <div class="sidebar">
<div class="receipt">
<h3>***************************</h3>
<h2>BANANA IS YELLOW</h2>
<p>CCS Bldg. room CS 101</p>
<h3>***************************</h3>
    <p id="curdate">Date:</p>
    <p id="refs">Ref no:</p>
<h3>***************************</h3>
    <div id="tabless"></div>
<h3>***************************</h3>
    <p id="subtot">Sub Total: ₱0.00</p>
    <p id="disc">Discount: </p>
    <p id="tot">Total: ₱0.00</p>
    <p id="vat">VAT: <?php echo $vat['tax_percent'];?>%</p>
    <p id="mop">Pay thru: </p>
    <p id="amp">Amount paid:</p>
    <p id="pchange"></p>
<h3>***************************</h3>

<h4>Life throws you lemons? We've got bananas!</h4>
<h4>to make you peel better ;)).</h4> <br>
<h3>THANK YOU</h3>
</div>
Select type of barcode scanner: <br>
    <select name="scantype" id="scantype" class="custom-select">
        <option value="">choose here:</option>
        <option value="barcode_hardware" id="barcode_hardware">Scan using Barcode Scanner</option>
        <option value="cam" id="cam">Scan using Camera</option>
        <option value="manual" id="manual">Search Manually</option>
    </select> <br><br>
    <input type="text" name="barsearch" id="barsearch" style="display: none;">
    
    <input type="text" name="manualsearch" id="manualsearch" style="display: none;">
    <button type="button" name="barsearchbtn" id="barsearchbtn" style="display: none;">Search Barcode</button>

<div id="reader" style="width: 500px;display: none;" ></div>
    <button id="start-stop-button" style="display: none;" >Start Scanning</button>


    <br><br><br>
<button id="print" disabled >Print</button>
<p>To send receipt to customer thru an email.</p>
<input type="text" name="name" id="cname" placeholder="Customer Name">
<input type="email" name="email" id="cemail" placeholder="Customer Email">
<button id ="email">Send email</button>
<button id="clear-receipt">Clear All</button>
<button id="cleardisplay">Clear Customer Display</button>
</div>
    <script src="include\js\qrScript.js"></script>

    <script src="include\js\home.js"> </script>
   
</body>
</html>
