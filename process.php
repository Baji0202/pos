<?php
require_once "include\connect\dbcon.php";
$billsJson = file_get_contents("php://input");
// var_dump($billsJson);

$bills = json_decode($billsJson, true);

function calculateSubtotal($itemprice,$itemquan){

    $price = $itemprice;
    $quantity = $itemquan;

    return $price*$quantity;

};
function generateUniqueInvoiceId() {
    $now = new DateTime('now');
    $dateStr = $now->format('Ymd');
    $timeStr = $now->format('His');
    $random = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);  // Generate a 4-digit random number
    return "INV{$dateStr}{$timeStr}{$random}";
  };

if ($bills !== null) {

    $name = $bills['name'];
    $email = $bills['email'];
    $productIds = $bills['productIds'];
    $subtot = $bills['subtot'];
    $discount = $bills['discount'];
    $tot = $bills['tot'];
    $pay = $bills['pay'];
    $amount = $bills['amount'];
    $cchange = $bills['cchangeValue'];

    $sql = "SELECT * FROM discount WHERE name = ?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$discount]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount()>0) {
    $discountid = $row['discount_id'];
} else {
    $discountid = 1;
}


    $sql = "INSERT INTO customer (`cname`, `email`) VALUES (?,?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$name,$email]);
    $lastInsertedcustomer = $pdoConnect->lastInsertId();

    $currentDate = date('Y-m-d');

    $sql = "INSERT INTO `orders`(`customer_id`, `order_date`) VALUES (?,?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$lastInsertedcustomer, $currentDate]);
    $lastInsertedOrderId = $pdoConnect->lastInsertId();

    $sql = "INSERT INTO `order_item` (`order_id`, `item_id`, `quantity`, `subtotal`) VALUES (?, ?, ?, ?)";
    $stmt = $pdoConnect->prepare($sql);
    
    foreach ($productIds as $item) {
      $itemId = $item['id'];
      $quantity = $item['quantity'];
      $subTotal = calculateSubtotal($item['productPrice'], $quantity); // Replace with your logic to calculate subtotal
    
      // Bind values for each iteration
      $stmt->bindParam(1, $lastInsertedOrderId); // Bind order_id (assuming you have this value)
      $stmt->bindParam(2, $itemId);
      $stmt->bindParam(3, $quantity);
      $stmt->bindParam(4, $subTotal);
      $stmt->execute();
    }

$uniqueinv = generateUniqueInvoiceId();
$dtnow = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `bill`(`invcode`, `order_id`, `subtotal`, `discount_id`, `total_amount`, `date_time`) VALUES (?,?,?,?,?,?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$uniqueinv,$lastInsertedcustomer, $subtot,$discountid,$tot, $dtnow]);
    $lastInsertedbill = $pdoConnect->lastInsertId();

    $sql = "INSERT INTO `receipt`(`datetime`, `payment_method`, `amount`, `cchange`, `bill_id`) VALUES (?,?,?,?,?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$dtnow,$pay,$amount,$cchange,$lastInsertedbill]);
  
    
echo "php".$dtnow.$pay.$amount.$cchange.$lastInsertedbill;
    
} else {
    
    echo "Failed to decode JSON data";
}
?>



