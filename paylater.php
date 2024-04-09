<?php
require_once "include\connect\dbcon.php";
if (isset($_GET['id'])) {
    $bill = $_GET['id'];

    // $sql = "INSERT INTO `open_ticket`(`bill_id`, `status`) VALUES (?,?)";
    // $stmt = $pdoConnect->prepare($sql);
    // $stmt->execute([$bill,"pending"]);

}else {
    echo "id not found";
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Later</title>
</head>
<body>



<table border='1' cellpadding='7'>
    <tr>
    <th>#</th>
    <th>Bill no.</th>
    <th>Order Id</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>mark as done</th>
    </tr>
    <?php 
   
   $sql = "SELECT open_ticket.oTicket_id, bill.bill_id, bill.order_id, bill.total_amount, open_ticket.status 
   FROM open_ticket 
   INNER JOIN bill ON open_ticket.bill_id = bill.bill_id";
   $stmt = $pdoConnect->prepare($sql);
   $stmt->execute();
    while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($fetch);

        echo "<tr>";
        echo "<td>" . $oTicket_id. "</td>";
        echo "<td>" . $bill_id . "</td>";
        echo "<td>" . $order_id . "</td>";
        echo "<td>" . $total_amount ."</td>";
        echo "<td>" . $status . "</td>";
        echo "<td><button type='button'>Paid</button></td>";

       
       
        echo "</tr>";
    }
    echo '</table>';
?>

</body>
</html>