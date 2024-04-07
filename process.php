<?php
session_start();
require_once "include\connect\dbcon.php";

if (isset($_POST)) {
    $postData = file_get_contents("php://input");

    $bills = json_decode($postData, true);

   
        echo json_encode($bills);

        $cname = $data['customerName'];
        $cmail = $data['customerEmail'];
        $subtot = $data['totalValueElement'];
        $discount = $data['selectedOptionText'];
        $tot= $data['gTotalElement'];
    
        $sql = "INSERT INTO `customer`(`customer_fname`, `email`) VALUES (?,?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute($cname,$cmail);

        $sql = "INSERT INTO `customer`(`customer_fname`, `email`) VALUES (?,?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute($cname,$cmail);
  
    


}else {
   
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}

