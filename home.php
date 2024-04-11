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
    <link rel="icon" type="image/png" href="include\image\logo.png">
    <link rel="stylesheet" href="include\styles\home.css">
</head>
<body>
<nav>
    <div class="logo">
        <img src="include\image\logo-black.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</nav>

<div class="maincontainer">
    <div class="maincontent">
    Customer Name:
    <input type="text" name="cfname" id="cfname"><br>
    Customer Email:
    <input type="email" name="cemail" id="cemail" placeholder="N/A"> <br>
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
            echo "<option value='" . $row['value'] . "'>" . $row['name']."</option>";
        }
    }
    ?>
</select>

    <p>Tax: 12%</p>
    <p id="gtotal">Total: ₱0.00</p>
    <button id="total-button" >Total</button>
    </div>
    <button id="paylater" disabled>Pay Later</button>
    Cash Payment:
    <input type="text" id="cpayment" pattern="[0-9]*" disabled>
    <button id="changebtn" disabled>Change</button>
    <p id="cchange">Change:</p>
    <button id="gcash" disabled>Gcash</button>
    <button id="make-receipt" disabled>Make a receipt</button>
    
    </div>


    <div class="sidebar">
<div class="receipt">
<h3>***************************</h3>
<h2>BANANA CLOTHING</h2>
<h3>***************************</h3>
            <p id="curdate">Date:</p>
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
<button id="print" disabled>Print</button>
<button id ="email">Email</button>
<button id="clear-receipt">Clear</button>
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
            fps: 1,
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

    const discount = parseFloat(document.getElementById('discount').value);
    
    document.getElementById('gtotal').textContent = 'Total: ₱' + (discount * total * (1 + 0.12)).toFixed(2);

    document.getElementById('total-value').textContent = 'Sub Total: ₱' + total.toFixed(2);
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
emailButton.addEventListener("click", () => {

    const receiptContent = document.getElementsByClassName('receipt')[0].innerHTML;
const customerEmail = email;
const customerName = emailname;
console.log(email,emailname);
console.log(customerEmail,customerName);
    if (customerEmail === '') {
        alert("Please provide customer email");
    } else {
        // Generate PDF receipt content
        const pdfContent = generatePDFContent(customerName, receiptContent);

        // Send email with PDF content
        sendEmail(customerName, customerEmail, pdfContent);
    }
});

function generatePDFContent(customerName, receiptContent) {
    // Generate PDF content here using a library like jsPDF or html2pdf
    // For example:
    const pdfContent = `
        <h1>Receipt for ${customerName}</h1>
        <p>${receiptContent}</p>
    `;
    return pdfContent;
}

function sendEmail(customerName, customerEmail, pdfContent) {
    const emailInfo = {
        name: customerName,
        email: customerEmail,
        pdfContent: pdfContent
    };

    fetch('sendmail.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(emailInfo)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to send email');
        }
        return response.text();
    })
    .then(data => {
        console.log(data);
        alert("Email sent successfully");
    })
    .catch(error => {
        console.error('Error:', error);
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
// function fetchLastInsertedId() {
//     return fetch('process.php')
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json(); // Parse the response as JSON
//         })
//         .then(data => {
//             // Check if the response contains the last inserted ID
//             if (data.hasOwnProperty('last_inserted_id')) {
//                 const bill_id = data.last_inserted_id;
//                 console.log('Last inserted ID:', bill_id);
//                 return bill_id; // Return the last inserted ID
//             } else {
//                 throw new Error('Last inserted ID not found in response');
//             }
//         })
//         .catch(error => {
//             console.error('There was a problem with the fetch operation:', error);
//         });
// }
// function getreceipt(pay, amount, cchange) {
    
//             const receipt = {
//                 bill: fetchedbill,
//                 pay: pay,
//                 amount: amount,
//                 cchange: cchange
//             };
//             console.log(receipt);
//             return JSON.stringify(receipt);
       
// }

// function sendreceipt(receipt) {
//     fetch('receipt.php', {
//   method: 'POST',
//   headers: {
//     'Content-Type': 'application/json'
//   },
//   body: receipt
// })
// .then(response => response.text())
// .then(data => {
// })
// .catch(error => {
//   console.error('Error:', error);
// });
// }

function getreceipt(name, email, productIds, subTotal, dis, total,pay,amount,cchange) {
    let subValue = parseFloat(subTotal.split("₱")[1]);
  let totalValue = parseFloat(total.split("₱")[1]);
  let cchangeValue = parseFloat(total.split("₱")[1]);
    const receipts = {
    name: name,
    email: email,
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
let emailname;
let email;
makeReceipt.addEventListener("click", () => {
    const tableRows = document.querySelectorAll('#product-table-body tr');
    const rowData = [];
    const customerName = document.getElementById('cfname').value;
    const customerEmail = document.getElementById('cemail').value;
    const selectElement = document.getElementById('discount');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const selectedOptionText = selectedOption.textContent;
    const totalValueElement = document.getElementById('total-value').textContent;
    const gTotalElement = document.getElementById('gtotal').textContent;
    const paid = document.getElementById('cpayment').value;
    const cuschange = document.getElementById('cchange').textContent;

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
    document.getElementById('cdetails').textContent = customerName + "  " + customerEmail;
    document.getElementById('mop').textContent = "Pay thru: Cash";
    document.getElementById('amp').textContent = "Amount paid: ₱" + paid;
    document.getElementById('pchange').textContent = cuschange;
    document.getElementById('subtot').textContent = totalValueElement;
    document.getElementById('disc').textContent = selectedOptionText;
    document.getElementById('tot').textContent = gTotalElement;

    // Generate and send bill
    emailname = customerName;
    email = customerEmail;
    receipt = getreceipt(customerName, customerEmail, productIds, totalValueElement, selectedOptionText, gTotalElement,"Cash",paid,cuschange);
    sendbill(receipt);

    // Reset form inputs and states
    document.getElementById('cfname').value = '';
    document.getElementById('cemail').value = '';
    selectElement.selectedIndex = 0;
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
    document.getElementById('make-receipt').disabled = false;
});


const clearButton = document.getElementById('clear-receipt');

// Add a click event listener to the clear button
clearButton.addEventListener('click', () => {

    document.getElementById("cdetails").innerText = "";
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
    const customerName = document.getElementById('cfname').value;
const customerEmail = document.getElementById('cemail').value;

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
    

    document.getElementById('cfname').value = '';
    document.getElementById('cemail').value = '';
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
    </script>
   
</body>
</html>
