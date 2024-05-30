<?php
session_start();
// Check if barcode data is received
if (isset($_POST['barsearchbtn'])) {
    // Get the barcode data
    $barcode = $_POST['barsearch'];

}  


// Initialize an empty array to store the echoed rows
$echoedRows = [];

// Check if barcode data is received
if (isset($_POST['barcode'])) {
    // Get the barcode data
    $barcodeData = $_POST['barcode'];

    try {
        require_once "include/connect/dbcon.php";
        $sql = "SELECT * FROM products WHERE barcode = ?";
        $stmt=$pdoConnect->prepare($sql);
        $stmt->execute([$barcodeData]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        


        if ($count == 0) {
            echo "Undefined Item ₱0";
        } else {
            // Loop through the fetched rows
            foreach ($rows as $row) {
                // Construct a string for each row and store it in the session
                $_SESSION['cd'][] = "{$row['name']} ₱{$row['sale_price']}";
                
                // Store the row in the array of echoed rows
                $echoedRows[] = $row;
            }
        }
    } catch (PDOException $e) {
        die("error fetch") . $e->getMessage();
    }
}

// Echo the echoed rows
foreach ($echoedRows as $row) {
    echo "{$row['id']} - {$row['name']} ₱{$row['sale_price']} - {$row['quantity']}  ";
}




?>