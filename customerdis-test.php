<?php
// Logic to fetch data from your POS system (replace with your implementation)
$product_name = "Item 1";
$price = "$10.00";
$quantity = 2;

$data = array(
  "product_name" => $product_name,
  "price" => $price,
  "quantity" => $quantity
);

// Encode data as JSON
$data = json_encode($data);

echo $data;
?>



<!DOCTYPE html>
<html>
<head>
<title>POS Customer Display</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
  setInterval(function() {
    $.ajax({
      url: "get_customer_data.php", // Script to fetch data from POS system
      success: function(data) {
        // Parse data (assuming JSON format)
        var parsedData = JSON.parse(data);
        
        // Update display elements with parsed data
        $("#product-name").text(parsedData.product_name);
        $("#price").text(parsedData.price);
        $("#quantity").text(parsedData.quantity);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle errors (e.g., display an error message)
        console.error("Error fetching data:", textStatus, errorThrown);
        $("#customer-display").html("Error retrieving data.");
      }
    });
  }, 2000); // Update every 2 seconds (adjust as needed)
});
</script>
<style>
.customer-display {
  font-size: 24px;
  text-align: center;
}
</style>
</head>
<body>
<div class="customer-display">
  <p>Product: <span id="product-name"></span></p>
  <p>Price: <span id="price"></span></p>
  <p>Quantity: <span id="quantity"></span></p>
</div>
</body>
</html>