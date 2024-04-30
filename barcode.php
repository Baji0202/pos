<?php
// Check if barcode data is received
if (isset($_POST['barsearchbtn'])) {
    // Get the barcode data
    $barcode = $_POST['barsearch'];

}  

if (isset($_POST['barcode'])) {
    // Get the barcode data
    $barcodeData = $_POST['barcode'];

    try {
        require_once "include\connect\dbcon.php";
        $sql = "SELECT * FROM groceryitems WHERE barcode = ?";
        $stmt=$pdoConnect->prepare($sql);
        $stmt->execute([$barcodeData]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count=$stmt->rowCount();
        if ($count==0) {
            echo"Undefined Item ₱0" ;
        }else 
        
        $cart = [];

foreach ($row as $rows) {
  echo" {$rows['barcode']} - {$rows['name']} ₱{$rows['price']} ";
  array_push($cart, $rows['barcode']);
}


          
    } catch (PDOException $e) {
        die("error fetch").$e->getMessage();
    }
    
}


?>