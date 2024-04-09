<?php
// session_start();
// require_once "include\connect\dbcon.php";

if (isset($_POST)) {
    $postData = file_get_contents("php://input");

    $data = json_decode($postData, true);
        // echo json_encode($data);



        // $cname = $data['customerName'];
        // $cmail = $data['customerEmail'];

        // $nsubtot = $data['totalValueElement'];
        // $subtot = explode("₱", $nsubtot);
        
      

        // $discount = $data['selectedOptionText'];

        // $ntot= $data['gTotalElement'];
        // $tot = explode("₱", $ntot);

        // $productId = $data['productIds'];

        // foreach ($productIds as $product) {
        //     $id = $product['id'];
        //     $quantity = $product['quantity'];
        // };
        
        // echo $cname.$cmail.$subtot.$discount.$tot;
    // $query_cust = "INSERT INTO `customer`(`customer_fname`, `email`) VALUES (?,?) ";
    // $prepare = $pdoConnect->prepare($query_cust);
    // $prepare->execute($cname, $cmail);
    
   
    //$query_bill = "INSERT INTO `bill`(`order_id`, `discount_id`, `sub_total`, `total_amount`, `date_time`) VALUES (?, ?, ?, ?, ?)";
    //$prepare2 = $pdoConnect->prepare($query_bill);
}else {
   
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}

