<?php $receiptjson = file_get_contents("php://input");
var_dump($receiptjson);

$receipt = json_decode($receiptjson, true);
?>