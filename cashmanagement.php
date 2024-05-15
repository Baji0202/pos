<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");

}
$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Cash Management</title>
</head>
<body>
<div>
<button id="paidInbtn">Paid in</button> <button id="paidOutbtn">Paid out</button>
<h3>Cash Drawer</h3>
<p id="startcash">Starting Cash: <?php echo $_SESSION['startcash']?> </p>
<p id="sales">Sales: 0.00</p> 
<p id="paidIn">Paid in: <?php echo $_SESSION['paidIn'] ??  $_SESSION['paidIn'] = 0?></p> 
<p id="paidOut">Paid out: <?php echo $_SESSION['paidOut'] ??  $_SESSION['paidOut'] = 0 ?></p> 
<p id="refunds">Refunds: 0.00</p> 
<p id="expectedCash">Expected cash: 0.00</p>
<label>Actual cash: </label>
<input type="text" placeholder="Input actual cash on hand" pattern="[0-9]*[.]?[0-9]*" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"><br>
<p>Cash diffrence: 0.00</p>
</div>
<button>Print & Submit</button>
<div style="display: none;">
<p>**************************</p>
<p id="date">Date: </p>
<p id="cashier">Cashier:</p>
<p>**************************</p>
<p id="rstartcash">Starting Cash: </p>
<p id="rsales">Sales: </p> 
<p id="rpaidIn">Paid in: </p> 
<p id="rpaidOut">Paid out: </p> 
<p id="rrefunds">Refunds: </p> 
<p id="rexpectedCash">Expected cash: </p> 
<p id="ractualCash">Actual cash: </p>
<p id="rcashdifference">Cash diffrence: </p>
<p>**************************</p>
</div>

  


</body>
</html>

<script>
const paidInbtn = document.getElementById("paidInbtn");
const paidOutbtn = document.getElementById("paidOutbtn");


paidInbtn.addEventListener("click",  () => {
    window.location.href = "paidIn.php";
})

paidOutbtn.addEventListener("click",  () => {
    window.location.href = "paidOut.php";
})
</script>