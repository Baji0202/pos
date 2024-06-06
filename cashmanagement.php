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
<nav>
    <div class="logo">
    <img src="include\image\sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">POS System</div>
        <link rel="stylesheet" href="include\styles\global.css">
    </div>
    
    <div class="dropdown">
        <div class="acc_name" id="acc_name"><?php echo $loggedemail?></div>
        <!-- Dropdown content -->
        <div class="dropdown-content" id="logout_dropdown">
            <a href="home.php">Home</a>
            <a href="refund.php">Refund</a>
            <a href="logout.php" class="logout-btn">Logout</a>
            
        </div>
    </div>
</nav>




<div class="maincontent" style="margin-left:15%; padding: 10px 20px;">
<div class="share" style="    display: flex;margin: 1%;" >
<button id="paidInbtn" style="margin: 0.5%">Paid in</button> <button id="paidOutbtn"style="margin: 0.5%">Paid out</button>
</div>
<h3>Cash Drawer</h3>
<p id="startcash">Starting Cash: <?php echo $_SESSION['startcash']?> </p>
<p id="sales">Sales: <?php echo  $_SESSION['sales'] ?? $_SESSION['sales'] = 0 ?></p> 
<p id="paidIn">Paid in: <?php echo $_SESSION['paidIn'] ??  $_SESSION['paidIn'] = 0?></p> 
<p id="paidOut">Paid out: <?php echo $_SESSION['paidOut'] ??  $_SESSION['paidOut'] = 0 ?></p> 
<p id="refunds">Refunds: <?php echo  $_SESSION['refunds'] ?? $_SESSION['refunds'] = 0 ?></p> 
<p id="expectedCash">Expected cash: 0</p>
<label>Actual cash: </label>
<input type="text" id="actualcashtxt" placeholder="Input actual cash on hand" pattern="[0-9]*[.]?[0-9]*" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"><br>
<button id="actualcashbtn">Total</button>
<p id="cashdiff">Cash diffrence: 0</p>
<button id="print">Print</button>
<button id="submit">Submit & Logout</button>
</div>

<div style="display: none;" id="receipt">
<p>**************************</p>
<p id="date">Date: </p>
<p id="cashier">Cashier: <?php echo $loggedemail;?></p>
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
const acInput = document.getElementById("actualcashtxt");
const totalbtn = document.getElementById("actualcashbtn");
const submitbtn = document.getElementById("submit");
const printbtn = document.getElementById("print");
let expectedCash = 0;
let cashdiff = 0;
printbtn.addEventListener("click", () => {
    updateReceipt()
            const receiptContent = document.getElementById('receipt').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Receipt</title>
                    <style>
                        /* Add any custom styles here */
                    </style>
                </head>
                <body>
                    ${receiptContent}
                </body>
                </html>
            `);
            printWindow.document.close();

            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 1000);
        });
//
submitbtn.addEventListener('click', () => {
            const startcash = extractNumber('startcash');
            const sales = extractNumber('sales');
            const paidIn = extractNumber('paidIn');
            const paidOut = extractNumber('paidOut');
            const refunds = extractNumber('refunds');
            const expectedCash = extractNumber('expectedCash');
            const actualCash = parseFloat(document.getElementById('actualcashtxt').value);
            const cashdiff = extractNumber('cashdiff');

            const emailContent = {
                startcash: startcash,
                sales: sales,
                paidIn: paidIn,
                paidOut: paidOut,
                refunds: refunds,
                expectedCash: expectedCash,
                actualCash: actualCash,
                cashdiff: cashdiff
            };

            fetch('cmprocess.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(emailContent)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                alert("Successful transaction");
                window.location.href = 'logout.php';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
//
totalbtn.addEventListener("click",  () => {
   
    cashdiff = parseFloat(acInput.value - expectedCash).toFixed(2);
    document.getElementById('cashdiff').textContent = "Cash difference: "+cashdiff;
})
paidInbtn.addEventListener("click",  () => {
    window.location.href = "paidIn.php";
})

paidOutbtn.addEventListener("click",  () => {
    window.location.href = "paidOut.php";
})
updateExpectedCash();
updateDate();
setInterval(updateDate, 1000);

//functions
 function extractNumber(elementId) {
            const text = document.getElementById(elementId).textContent;
            const number = parseFloat(text.match(/-?[\d.]+/)[0]);
            return number;
        }

        function updateReceipt() {

            const startcash = document.getElementById('startcash').textContent;
            const sales = document.getElementById('sales').textContent;
            const paidIn = document.getElementById('paidIn').textContent;
            const paidOut = document.getElementById('paidOut').textContent;
            const refunds = document.getElementById('refunds').textContent;
            const expectedCash = document.getElementById('expectedCash').textContent;
            const actualcashtxt = "Actual cash:  ₱"+document.getElementById('actualcashtxt').value;
            const cashdiff = document.getElementById('cashdiff').textContent;

            document.getElementById('rstartcash').textContent = startcash;
            document.getElementById('rsales').textContent = sales;
            document.getElementById('rpaidIn').textContent = paidIn;
            document.getElementById('rpaidOut').textContent =  paidOut;
            document.getElementById('rrefunds').textContent = refunds;
            document.getElementById('rexpectedCash').textContent = expectedCash;
            document.getElementById('ractualCash').textContent = actualcashtxt;
            document.getElementById('rcashdifference').textContent = cashdiff;
        }
        function updateExpectedCash() {
            const startCash = parseFloat(<?php echo $_SESSION['startcash']; ?>);
            const sales = parseFloat(<?php echo $_SESSION['sales'] ?? 0; ?>);
            const paidIn = parseFloat(<?php echo $_SESSION['paidIn'] ?? 0; ?>);
            const paidOut = parseFloat(<?php echo $_SESSION['paidOut'] ?? 0; ?>);
            const refunds = parseFloat(<?php echo $_SESSION['refunds'] ?? 0; ?>);

            expectedCash = startCash + sales + paidIn + paidOut - refunds;

            document.getElementById('expectedCash').textContent = 'Expected cash: ₱' + expectedCash.toFixed(2);
        }
        function updateDate() {
    var currentDateElement = document.getElementById("date");
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + 
                        ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + 
                        ('0' + currentDate.getDate()).slice(-2) + ' ' + 
                        ('0' + currentDate.getHours()).slice(-2) + ':' + 
                        ('0' + currentDate.getMinutes()).slice(-2) + ':' + 
                        ('0' + currentDate.getSeconds()).slice(-2);
    currentDateElement.innerText = "Date: " + formattedDate;
}


        
</script>