<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");

}
$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";

try {
    $sql = "SELECT * FROM discount";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();

    $sqlTax = "SELECT * FROM tax WHERE tax_name = ?";
    $stmtTax = $pdoConnect->prepare($sqlTax);
    $stmtTax->execute(["vat"]);
    $vat = $stmtTax->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("error select discount").$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <link rel="icon" type="image/png" href="include\image\logo.png">
    <link rel="stylesheet" href="include\styles\home.css">
    <link rel="stylesheet" href="include\styles\global.css">
    <style>
 #toggleButton {
        background-color: #ddd;
        border: none;
        color: #000;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    #textInput {
        display: none;
        margin-top: 10px;
    }

    #loadingIndicator {     
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999; 
    display: flex;
    justify-content: center;
    align-items: center;
}


.spinner {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 12px solid rgba(255, 255, 255, 0.3);
    border-top-color: yellow;
    animation: spin 1s infinite linear;
    position: absolute;
    top: 30%;
    left: 45%; /* patch lang 2 haha */
    transform: translate(-50%, -50%);
}


@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
    </style>
</head>
<body>
    
<div id="loadingIndicator" style="display: none;">
  <div class="spinner"></div>
</div>

<nav>
    <div class="logo">
    <img src="include\image\sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">POS System</div>
    </div>
    
    <div class="dropdown">
        <div class="acc_name" id="acc_name"><?php echo $loggedemail?></div>
        <!-- Dropdown content -->
        <div class="dropdown-content" id="logout_dropdown">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</nav>

<div class="maincontainer">

    <div class="maincontent">
    <button id="toggleButton" onclick="toggleInput()">Banana Card</button>
    <input type="text" id="bananacard" style="display: none;">
<div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            
     
    </table> 
    


    <p id="total-value">Sub Total: ₱0.00</p>
    Discount:
    <select name="discount" id="discount" class="custom-select">
    <?php
    if ($stmt->rowCount()>0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['value'] . "' data-type='" . $row['type'] . "'>" . $row['name'] . "</option>";

        }
    }
    ?>
</select>

    <p id="vat">VAT: <?php echo $vat['tax_percent'];?>%</p>
    
    <button id="total-button" >Total</button>
    <h2 id="gtotal">Total: ₱0.00</h2>
    </div>
    <p>Payment method:</p>
    <select name="paymentmethod" id="paymentmethod">
    <option value="">Select here</option>
<option value="Cash">Cash</option>
<option value="Gcash">Gcash</option>
    </select>
    
    <div id="cash" style="display: none;">
    Cash Payment:
    <input type="text" id="cpayment" pattern="[0-9]*" disabled>
    <button id="changebtn" disabled>Change</button>
    <p id="cchange">Change:</p>
    </div>
    <button id="gcash" disabled style="display: none;">Gcash</button> <br><br>
    <button id="make-receipt" disabled>Make a receipt</button>
    <button id="paylater" disabled>Add to Pay Later</button>
    <button id="opentickets">View Open Tickets</button>
    </div>


    <div class="sidebar">
<div class="receipt">
<h3>***************************</h3>
<h2>BANANA IS YELLOW</h2>
<p>CCS Bldg. room CS 101</p>
<h3>***************************</h3>
    <p id="curdate">Date:</p>
    <p id="refs">Ref no:</p>
<h3>***************************</h3>
    <div id="tabless"></div>
<h3>***************************</h3>
    <p id="subtot">Sub Total: ₱0.00</p>
    <p id="disc">Discount: </p>
    <p id="tot">Total: ₱0.00</p>
    <p>VAT: <?php echo $vat['tax_percent'];?>%</p>
    <p id="mop">Pay thru: </p>
    <p id="amp">Amount paid:</p>
    <p id="pchange"></p>
<h3>***************************</h3>

<h4>Life throws you lemons? We've got bananas!</h4>
<h4>to make you peel better ;)).</h4> <br>
<h3>THANK YOU</h3>
</div>

    Barcode: <br>
    <input type="text" name="barsearch" id="barsearch">
    <button type="button" name="barsearchbtn" id="barsearchbtn">Search Barcode</button>

<div id="reader" style="width: 500px;" ></div>
    <button id="start-stop-button">Start Scanning</button>


    
<button id="print" >Print</button>
<p>To send receipt to customer thru an email.</p>
<input type="text" name="name" id="cname" placeholder="Customer Name">
<input type="email" name="email" id="cemail" placeholder="Customer Email">
<button id ="email">Send email</button>
<button id="clear-receipt">Clear All</button>


    

    
</div>




       
 
   
   

   

    <script src="include\js\qrScript.js"></script>

    <script> 
const paymentMethodSelect = document.getElementById("paymentmethod");
    const cashDiv = document.getElementById("cash");
    const gcashButton = document.getElementById("gcash");

    // Add event listener to select element
    paymentMethodSelect.addEventListener("change", function() {
        const selectedOption = paymentMethodSelect.value;

        // Hide both cash and gcash elements initially
        cashDiv.style.display = "none";
        gcashButton.style.display = "none";

        // Show the respective element based on the selected option
        if (selectedOption === "Cash") {
            cashDiv.style.display = "block";
    document.getElementById('make-receipt').disabled = false;

        } else if (selectedOption === "Gcash") {
            gcashButton.style.display = "block";
    document.getElementById('make-receipt').disabled = false;

        }
    });

var isInputVisible = false;

function toggleInput() {
    isInputVisible = !isInputVisible;
    var input = document.getElementById("bananacard");
    var button = document.getElementById("toggleButton");
    if (isInputVisible) {
        button.style.backgroundColor = "#fbcb45"; // Green color when it's on
        input.style.display = "block"; // Show the input box
        setTimeout(function() {
            input.focus(); // Focus after the input box is visible
        }, 0);
    } else {
        input.value = "";
        button.style.backgroundColor = "#ddd"; // Default color when it's off
        input.style.display = "none"; // Hide the input box
    }
}



        const html5Qrcode = new Html5Qrcode('reader');
        let scannedprice = 0;
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            if (decodedText) {
                
                
                sendBarcodeToPHP(decodedText);
                document.getElementById('show').style.display = 'block';
                document.getElementById('result').textContent = decodedText;
                decodedText = null;
                isScanning = true;

            }
        };
        const config = {
            fps: 0.1,
            qrbox: {
                width: 250,
                height: 250,
            },
        };
        const shift = document.getElementById('shift');
        shift.addEventListener('click', () => {
            window.location.href = "cashmanagement.php";
        });


        const startStopButton = document.getElementById('start-stop-button');
        let isScanning = false;

        startStopButton.addEventListener('click', () => {
            if (isScanning) {
                html5Qrcode.stop();
                startStopButton.textContent = 'Start Scanning';
                isScanning = false;
            } else {
                html5Qrcode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
                startStopButton.textContent = 'Stop Scanning';
                isScanning = true;
            }
        });
        
        const barsearchbtn = document.getElementById('barsearchbtn');
        barsearchbtn.addEventListener('click',() =>{
           barsearch = document.getElementById('barsearch').value;
           sendBarcodeToPHP(barsearch);
            barsearch.value = "";
            document.getElementById('barsearch').value = '';
        });
        
  
        function sendBarcodeToPHP(barcodeData) {
    fetch('barcode.php', {
        method: 'POST',
        body: new URLSearchParams({ barcode: barcodeData })
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from PHP:', data);

 
        const [id, rest] = data.split(' - '); 
const [productName, priceStr] = rest.split(' ₱');
const productPrice = parseFloat(priceStr); 

        const existingProductRow = document.querySelector(`#product-table-body tr[data-product-name="${productName}"]`);
        if (existingProductRow) {
           
            const quantityInput = existingProductRow.querySelector('input[name="productQuantity"]');
            const newQuantity = parseInt(quantityInput.value) + 1;
            quantityInput.value = newQuantity;

            const totalPriceCell = existingProductRow.querySelector('.total-price');
            const newTotalPrice = parseFloat(totalPriceCell.dataset.price) + productPrice;
            totalPriceCell.dataset.price = newTotalPrice;
            totalPriceCell.textContent = '₱' + newTotalPrice.toFixed(2);
        } else {
            
            const tableRow = document.createElement('tr');
            tableRow.dataset.productName = productName;

            const idCell = document.createElement('td');
            idCell.textContent = id;
            tableRow.appendChild(idCell);

            const productNameCell = document.createElement('td');
            productNameCell.textContent = productName;
            tableRow.appendChild(productNameCell);

            const productPriceCell = document.createElement('td');
            productPriceCell.textContent = '₱' + productPrice.toFixed(2);
            tableRow.appendChild(productPriceCell);

            const quantityCell = document.createElement('td');
            quantityCell.innerHTML = `<input type="number" name="productQuantity" value="1" min="1">`;
            tableRow.appendChild(quantityCell);

            const actionCell = document.createElement('td');
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.addEventListener('click', () => {
                tableRow.remove();
            });
            actionCell.appendChild(deleteButton);
            tableRow.appendChild(actionCell);

            const tableBody = document.getElementById('product-table-body');
            tableBody.appendChild(tableRow);
        }

        
        updateTotalValue();
    })
    .catch(error => {
        console.error('Error sending data:', error);
    });
}

function updateTotalValue() {
    let total = 0;
    document.querySelectorAll('.total-price').forEach(cell => {
        total += parseFloat(cell.dataset.price);
    });
    document.getElementById('total-value').textContent = 'Sub Total: ₱' + total.toFixed(2);
}


const totalButton = document.getElementById('total-button');
totalButton.addEventListener('click', () => {
    let total = 0;
  
    document.querySelectorAll('#product-table-body tr').forEach(row => {
        const price = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace('₱', ''));
        const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);
         
        total += price * quantity;
    });

    // Round the total to two decimal places after all calculations
    total = total.toFixed(2);

    const selectedOption = document.getElementById('discount').options[document.getElementById('discount').selectedIndex];

    // Get the value and data-type attributes of the selected option
    const discountValue = parseFloat(selectedOption.value).toFixed(2);
    const discountType = selectedOption.getAttribute('data-type');

    const vatText = document.getElementById('vat').textContent;
    const vatNum = parseFloat(vatText.match(/\d+/)[0]); 
    const vatPercent = vatNum / 100;

    console.log(discountType, discountValue, vatText, vatNum, vatPercent);

    let value = "";
    
    if (discountType === "percent") {
        value = ((total - (discountValue / 100 * total)) * (1 + vatPercent)).toFixed(2);
        console.log(value);
        value = 'Total: ₱' + value;
        document.getElementById('gtotal').textContent = value;
    } else {
        if (discountValue > total) {
            console.log("discount higher");
            document.getElementById('gtotal').textContent = 'Total: ₱0.00'
        } else {
            console.log("amount discounted");
            value = ((total - discountValue) * (1 + vatPercent)).toFixed(2);
            value = 'Total: ₱' + value;
            document.getElementById('gtotal').textContent = value;
        }
    }

    document.getElementById('total-value').textContent = 'Sub Total: ₱' + total;
    document.getElementById('cpayment').disabled = false;
    document.getElementById('changebtn').disabled = false;
    document.getElementById('paylater').disabled = false;
});


const print = document.getElementById('print');
print.addEventListener("click", () =>{
    const receiptContent = document.getElementsByClassName('receipt')[0].innerHTML;

    const printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(receiptContent);
    printWindow.document.close();


    setTimeout(function() {
        printWindow.print();
        printWindow.close(); 
    }, 1000);

    
});

const emailButton = document.getElementById('email');
const loadingIndicator = document.getElementById('loadingIndicator');

emailButton.addEventListener("click", () => {
  const receiptContent = document.getElementsByClassName('receipt')[0].innerHTML;
  const cname = document.getElementById("cname").value;
  const cemail = document.getElementById("cemail").value;
  console.log(cemail,cname);
  if (!cname && !cemail) {
    alert("Please enter customer details to send email.");
  } else {
    // Show loading indicator
    if (loadingIndicator) {
      loadingIndicator.style.display = 'block';
    } else {
      console.warn("Loading indicator element not found");
    }

    sendEmail(receiptContent, cname, cemail);
  }
});

function sendEmail(body, name, email) {
  const emailContent = {
    body: body,
    name: name,
    email: email
  };

  fetch('sendmail.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(emailContent)
  })
  .then(response => {
    // Hide loading indicator
    if (loadingIndicator) {
      loadingIndicator.style.display = 'none';
    }

    if (response.ok) {
      // Alert user that email has been sent
      alert("Email has been sent successfully.");
    } else {
      // Log an error message if email sending failed
      console.error("Failed to send email.");
    }
  })
  .catch(error => {
    // Hide loading indicator
    if (loadingIndicator) {
      loadingIndicator.style.display = 'none';
    }

    console.error("Error sending email:", error);
  });
}


const productIds = [];
let receipt;
function sendbill (receipt) {
    fetch('process.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: receipt
})
.then(response => response.text())
.then(data => {
    console.log(data);
})
.catch(error => {
  console.error('Error:', error);
});
}


function getreceipt(receiptId,productIds, subTotal, dis, total,pay,amount,cchange) {
    let subValue = parseFloat(subTotal.split("₱")[1]);
  let totalValue = parseFloat(total.split("₱")[1]);
  let cchangeValue = parseFloat(total.split("₱")[1]);
    const receipts = {
        receiptId:receiptId,
    productIds: productIds,
    subtot: subValue,
    discount: dis,
    tot: totalValue,
    pay:pay,
    amount:amount,
    cchange:cchangeValue
  };

  return JSON.stringify(receipts);
}
function getbills(name, email, productIds, subTotal, dis, total) {
  let subValue = parseFloat(subTotal.split("₱")[1]);
  let totalValue = parseFloat(total.split("₱")[1]);

  const bills = {
    name: name,
    email: email,
    productIds: productIds,
    subtot: subValue,
    discount: dis,
    tot: totalValue
  };
  
  //console.log(bills); // Logging the bills object before stringifying

  return JSON.stringify(bills); // Stringify the bills object before returning
}

function sendlink(bills) {

  const encodedBillsJson = encodeURIComponent(bills);

  const url = `paylater.php?billsJson=${encodedBillsJson}`;
  
  window.location.href = url;
}


const makeReceipt = document.getElementById('make-receipt');

makeReceipt.addEventListener("click", () => {
    const tableRows = document.querySelectorAll('#product-table-body tr');
    const rowData = [];
 
    const selectElement = document.getElementById('discount');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const selectedOptionText = selectedOption.textContent;
    const totalValueElement = document.getElementById('total-value').textContent;
    const gTotalElement = document.getElementById('gtotal').textContent;
    const paid = document.getElementById('cpayment').value;
    const cuschange = document.getElementById('cchange').textContent;
    const receiptID = document.getElementById('refs').textContent;
    const generatedReceipt = generateReceiptID();
    console.log(generatedReceipt);
    // Process receipt
    tableRows.forEach(row => {
        const productName = row.cells[1].textContent;
        const idString = row.cells[0].textContent;
        const id = parseInt(idString.trim()); 
        const priceString = row.cells[2].textContent.replace('₱', ''); 
        const productPrice = parseFloat(priceString); 
        const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);

        productIds.push({
            id: id,
            quantity: quantity,
            productPrice: productPrice
        });

        // Push the extracted data into the rowData array
        rowData.push({
            productName: productName,
            productPrice: productPrice,
            quantity: quantity
        });

        const displayContainer = document.getElementById('tabless');

        // Loop through the rowData array
        rowData.forEach(data => {
            // Create a div element for each item
            const itemDiv = document.createElement('div');

            // Set the inner HTML of the div to display the data
            itemDiv.innerHTML = `
                <p>Product Name: ${data.productName}</p>
                <p>Price: ₱${data.productPrice.toFixed(2)}</p>
                <p>Quantity: ${data.quantity}</p>
            `;

            // Append the itemDiv to the display container
            displayContainer.appendChild(itemDiv);
        });
    });

    // Display customer and payment details
    const pm = document.getElementById("paymentmethod").value;
    if (pm  == "") {
        alert("select payment method first");
    }else if(pm == "Gcash") {
        document.getElementById('refs').textContent = "Ref no: "+generatedReceipt;
        document.getElementById('mop').textContent = "Pay thru: "+pm;
        document.getElementById('amp').textContent = "Amount paid: ₱"+gTotalElement;
        document.getElementById('pchange').textContent = "Change: ₱0.00";
        document.getElementById('subtot').textContent = totalValueElement;
    document.getElementById('disc').textContent = selectedOptionText;
    document.getElementById('tot').textContent = gTotalElement;
    }else{
    document.getElementById('refs').textContent = "Ref no: "+generatedReceipt;
    document.getElementById('mop').textContent = "Pay thru: "+pm;
    document.getElementById('amp').textContent = "Amount paid: ₱" + paid;
    document.getElementById('pchange').textContent = cuschange;
    document.getElementById('subtot').textContent = totalValueElement;
    document.getElementById('disc').textContent = selectedOptionText;
    document.getElementById('tot').textContent = gTotalElement;
    }

    

    // Generate and send bill
 
    // receipt = getreceipt(generatedReceipt, productIds, totalValueElement, selectedOptionText, gTotalElement,"Cash",paid,cuschange);
    // sendbill(receipt);

    // Reset form inputs and states
    selectElement.selectedIndex = 0;
    document.getElementById('refs').textContent = 'Ref no: '
    document.getElementById('total-value').textContent = 'Sub Total: ₱0.00';
    document.getElementById('gtotal').textContent = 'Total: ₱0.00';
    document.getElementById('cchange').textContent = "Change: ";
    document.getElementById('product-table-body').innerHTML = '';
    document.getElementById('cpayment').value = '';
    document.getElementById('print').disabled = false;
    document.getElementById('cpayment').disabled = true;
    document.getElementById('changebtn').disabled = true;
    document.getElementById('paylater').disabled = true;
    document.getElementById('make-receipt').disabled = true;
});


const changecalc = document.getElementById('changebtn');

changecalc.addEventListener("click", () => {

    const gtText = document.getElementById('gtotal').textContent;
    
   
    const parts = gtText.split('₱');
    
 
    const gt = parseFloat(parts[1]);
    
  
    const paymentInput = document.getElementById('cpayment').value.trim();

    if (paymentInput === "") {
        alert("Please enter an amount");
    } else if (!isNaN(paymentInput)) {
        const payment = parseFloat(paymentInput);

       
        if (gt > payment) {
            alert("Insufficient balance");
        } else {
            
            const change = payment - gt;
            const cchange = document.getElementById('cchange');
            cchange.textContent = "Change: ₱" + change.toFixed(2);
        }
    } else {
        alert("Please enter a valid amount");
    }
});


const clearButton = document.getElementById('clear-receipt');

// Add a click event listener to the clear button
clearButton.addEventListener('click', () => {

    document.getElementById("cname").value = "";
    document.getElementById("cemail").value = "";
    document.getElementById("tabless").innerHTML = "";
    document.getElementById("subtot").innerText = "Sub Total: ₱0.00";
    document.getElementById("disc").innerText = "Discount: ";
    document.getElementById("tot").innerText = "Total: ₱0.00";
    document.getElementById("mop").innerText = "Pay thru: ";
    document.getElementById("amp").innerText = "Amount paid:";
    document.getElementById("pchange").innerText = "";

    document.getElementById('print').disabled = true;
});

function updateDate() {
    var currentDateElement = document.getElementById("curdate");
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + 
                        ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + 
                        ('0' + currentDate.getDate()).slice(-2) + ' ' + 
                        ('0' + currentDate.getHours()).slice(-2) + ':' + 
                        ('0' + currentDate.getMinutes()).slice(-2) + ':' + 
                        ('0' + currentDate.getSeconds()).slice(-2);
    currentDateElement.innerText = "Date: " + formattedDate;
}

updateDate();
setInterval(updateDate, 1000);

const paylaterbtn = document.getElementById('paylater');
    
paylaterbtn.addEventListener('click', () => {
    const tableRows = document.querySelectorAll('#product-table-body tr');
const rowData = [];

const selectElement = document.getElementById('discount');
const selectedOption = selectElement.options[selectElement.selectedIndex];
const selectedOptionText = selectedOption.textContent;

const totalValueElement = document.getElementById('total-value').textContent;
const gTotalElement = document.getElementById('gtotal').textContent;

tableRows.forEach(row => {
    const productName = row.cells[1].textContent;
const idString = row.cells[0].textContent;
const id = parseInt(idString.trim()); 

const priceString = row.cells[2].textContent.replace('₱', ''); 
const productPrice = parseFloat(priceString); 
const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);
productIds.push({
      id: id,
      quantity: quantity,
      productPrice: productPrice
    });

});
    bill = getbills(customerName, customerEmail, productIds, totalValueElement, selectedOptionText, gTotalElement);
    

    selectElement.selectedIndex = 0;

    // Clear total and grand total
    document.getElementById('total-value').textContent = 'Sub Total: ₱0.00';
document.getElementById('gtotal').textContent = 'Total: ₱0.00';
document.getElementById('cchange').textContent = "Change: ";
    // Clear rowData
    document.getElementById('product-table-body').innerHTML = '';
    document.getElementById('cpayment').value = '';
    rowData.length = 0
    sendlink(bill);
});

const opentickets = document.getElementById('opentickets');
opentickets.addEventListener('click', () =>{
    window.location.href = 'paylater.php';
})

function generateReceiptID() {
    
    var currentDate = new Date();
    
    
    var year = currentDate.getFullYear();
    var month = currentDate.getMonth() + 1; 
    var day = currentDate.getDate();
    var hours = currentDate.getHours();
    var minutes = currentDate.getMinutes();
    var seconds = currentDate.getSeconds();

    // Format date and time components to ensure two digits
    month = (month < 10) ? '0' + month : month;
    day = (day < 10) ? '0' + day : day;
    hours = (hours < 10) ? '0' + hours : hours;
    minutes = (minutes < 10) ? '0' + minutes : minutes;
    seconds = (seconds < 10) ? '0' + seconds : seconds;

    // Generate three random digits
    var randomDigits = '';
    for (var i = 0; i < 3; i++) {
        randomDigits += Math.floor(Math.random() * 10);
    }

    // Concatenate date and time components with random digits to create receipt ID
    var receiptID = 'R' + year + month + day + hours + minutes + seconds + randomDigits;

    return receiptID;
}

        
    </script>
   
</body>
</html>
