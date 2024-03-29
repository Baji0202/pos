<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}

require_once "include\connect\dbcon.php";

try {
    $sql = "SELECT * FROM discount";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();
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
   <style>
    *{
    margin: 0;
    align-items: center;
}
.header{
    height: 10%;
}
.maincontainer{
    height: 100vh;
    display: flex;
    flex-direction: row;
    .maincontent{
        background: blue;
        height: 100%;
        width: 75%;
    }
    .sidebar{
        background: red;
        height: 100%;
        width: 25%;
        .receipt{
            background: green;
            height: 50%;
        }
    }
    .buttons{
display: flex;

    }
}
   </style>
</head>
<body>
    <header><a href="logout.php">Logout</a></header>
<div class="maincontainer">
    <div class="maincontent">
    Customer Name:
    <input type="text" name="cfname" id="cfname"><br>
    Customer Email:
    <input type="email" name="cemail" id="cemail"><br>
<div>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            
     
    </table> 
    <p id="total-value">Sub Total: ₱0.00</p>
    discount:
    <select name="discount" id="discount">
        <option value="1">No Discount</option>
        <?php
        if ($stmt->rowCount()>0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['value'] . "'>" . $row['name']."</option>";
                
                        }
        }
           
        
        ?>
    </select>
    <p>Tax: 12%</p>
    <p id="gtotal">Total: ₱0.00</p>
    <button id="total-button">Total</button>
    </div>
   
    Cash Payment:
    <input type="text" id="cpayment" pattern="[0-9]*">
    <button id="changebtn">Change</button>
    <p id="cchange"></p>
    <button id="make-receipt">Make a receipt</button>
<button>Pay Later</button>
<button>Gcash</button>

    </div>


    <div class="sidebar">
<div class="receipt">
<h3>***************************</h3>
<h2>DILAW CLOTHING</h2>
<h3>***************************</h3>
            <p>Date: <?php echo date('Y-m-d H:i:s'); ?></p>
            <p id="cdetails"></p>
<h3>***************************</h3>
    <div id="tabless"></div>
<h3>***************************</h3>
    <p id="subtot">Sub Total: ₱0.00</p>
    <p id="disc">Discount: </p>
    <p id="tot">Total: ₱0.00</p>
    <p>Tax: VAT 12%</p>
    <p id="mop">Pay thru: </p>
    <p id="amp">Amount paid:</p>
    <p id="pchange"></p>
<h3>***************************</h3>

<h3>THANK YOU</h3>
<div class="buttons">
<button id="print">Print</button>
<button>Email</button>
</div>
</div class="qr">

    Barcode: <br>
    <input type="text" name="barsearch" id="barsearch">
    <button type="button" name="barsearchbtn" id="barsearchbtn">Search Barcode</button>

<div id="reader" style="width: 500px;" ></div>
    <button id="start-stop-button">Start Scanning</button>
    </div>
</div>




       
 
   
   

   

    <script src="include\js\qrScript.js"></script>

    <script> 
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
            fps: 5,
            qrbox: {
                width: 250,
                height: 250,
            },
        };
        
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
        });
        
  
        function sendBarcodeToPHP(barcodeData) {
    fetch('barcode.php', {
        method: 'POST',
        body: new URLSearchParams({ barcode: barcodeData })
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from PHP:', data);

 
        const [productName, priceStr] = data.split(' ₱');
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

            const productNameCell = document.createElement('td');
            productNameCell.textContent = productName;
            tableRow.appendChild(productNameCell);

            const productPriceCell = document.createElement('td');
            productPriceCell.textContent = '₱' + productPrice.toFixed(2);
            tableRow.appendChild(productPriceCell);

            const quantityCell = document.createElement('td');
            quantityCell.innerHTML = `<input type="number" name="productQuantity" value="1" min="1">`;
            tableRow.appendChild(quantityCell);

            // const totalPriceCell = document.createElement('td');
            // totalPriceCell.classList.add('total-price');
            // totalPriceCell.dataset.price = productPrice;
            // totalPriceCell.textContent = '₱' + productPrice.toFixed(2);
            // tableRow.appendChild(totalPriceCell);

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
  
        const price = parseFloat(row.querySelector('td:nth-child(2)').textContent.replace('₱', ''));
        const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);
         
      
        total += price * quantity;
    });

    const discount = parseFloat(document.getElementById('discount').value);
    
    document.getElementById('gtotal').textContent = 'Total: ₱' + (discount * total * (1 + 0.12)).toFixed(2);

    document.getElementById('total-value').textContent = 'Sub Total: ₱' + total.toFixed(2);
    
   
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

const makereceipt = document.getElementById('make-receipt');
makereceipt.addEventListener("click", () => {
    const tableRows = document.querySelectorAll('#product-table-body tr');
const rowData = [];
const customerName = document.getElementById('cfname').value;
const customerEmail = document.getElementById('cemail').value;
document.getElementById('cdetails').textContent = customerName+"  "+customerEmail;
// Get the selected value of the discount dropdown
const selectElement = document.getElementById('discount');

// Get the selected option
const selectedOption = selectElement.options[selectElement.selectedIndex];

// Get the text content of the selected option
const selectedOptionText = selectedOption.textContent;

// Get the total and sub total elements
const totalValueElement = document.getElementById('total-value').textContent;
const gTotalElement = document.getElementById('gtotal').textContent;


tableRows.forEach(row => {
    const productName = row.cells[0].textContent; // Get product name from the first cell
    const priceString = row.cells[1].textContent.replace('₱', ''); // Get price string from the second cell and remove currency symbol
    const productPrice = parseFloat(priceString); // Convert price string to a floating-point number
    const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);

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
        <p>Discount:      </p>
        
    `;

    // Append the itemDiv to the display container
    displayContainer.appendChild(itemDiv);
    
});

document.getElementById('subtot').textContent = totalValueElement;
document.getElementById('disc').textContent = selectedOptionText;
document.getElementById('tot').textContent = gTotalElement;

rowData.length = 0;
});

console.log(rowData);

});

const changecalc = document.getElementById('changebtn');
changecalc.addEventListener("click", () => {
    // Retrieve the total amount to be paid
    const gtText = document.getElementById('gtotal').textContent;
    
    // Split the text at the Peso sign (₱)
    const parts = gtText.split('₱');
    
    // Get the second part of the resulting array
    const gt = parseFloat(parts[1]);
    
    // Retrieve the payment amount entered by the user
    const paymentInput = document.getElementById('cpayment').value;

    // Check if the payment input is a valid number
    if (!isNaN(paymentInput)) {
        const payment = parseFloat(paymentInput);

        // Check if the payment is insufficient
        if (gt > payment) {
            alert("Insufficient balance");
        } else {
            // Calculate and display the change
            const change = payment - gt;
            const cchange = document.getElementById('cchange').textContent = "₱" + parseFloat(change).toFixed(2);
            document.getElementById('mop').textContent = "Pay thru: Cash";
        document.getElementById('amp').textContent = "Amount paid: ₱"+payment;
document.getElementById('pchange').textContent = "Change: "+cchange;
        }
        
    } else {
        alert("Invalid input for payment amount");
    }
});




    </script>
   
</body>
</html>