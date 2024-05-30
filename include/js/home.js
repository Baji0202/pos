
const openTicketButton = document.getElementById('open-ticket-button');
openTicketButton.addEventListener('click', () => {
    var customerName = prompt("Enter customer name:");
    if (customerName === null || customerName.trim() === "") {
        alert("Customer name cannot be empty.");
        return;
    }
    
    const productRows = document.querySelectorAll('#product-table-body tr');
    const ticketData = [];
    productRows.forEach(row => {
        const productName = row.dataset.productName;
        const productPrice = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace('₱', ''));
        const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);
        
        // Store each item in ticketData array
        ticketData.push({
            customerName: customerName,
            itemName: productName,
            itemPrice: productPrice,
            quantity: quantity
        });
    });
console.log(ticketData);
    // Send ticket data to server
    fetch('save_table.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(ticketData)
    })
    .then(response => response.text())
    .then(data => {
        console.log('Data stored in session:', data);
    })
    .catch(error => {
        console.error('Error storing data:', error);
    });
});




const scantype = document.getElementById("scantype");
    const bh = document.getElementById("barcode_hardware");
    const cam = document.getElementById("cam");
    const manual = document.getElementById("manual");
    const camreader = document.getElementById("reader");
const manualsearch = document.getElementById("manualsearch");
    // Add event listener to select element
    scantype.addEventListener("change", function() {
        const selectedscantype = scantype.value;

        //barcode hardware elements
       barsearch.style.display = "none";

       //cam elements
        camreader.style.display = "none";
        startStopButton.style.display = "none";
        
       //manual elements
       manualsearch.style.display = "none";
       barsearchbtn.style.display = "none";

        // Show the respective element based on the selected option
        if (selectedscantype === "barcode_hardware") {
            barsearch.style.display = "block";
            barsearch.focus();


        } else if (selectedscantype === "cam") {
            barsearch.style.display = "block";
            camreader.style.display = "block";
            startStopButton.style.display = "block";

        }else if (selectedscantype === "manual") {
            manualsearch.style.display = "block";
       barsearchbtn.style.display = "block";
        }
    });

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
            document.getElementById('cpayment').disabled = false;
    document.getElementById('changebtn').disabled = false;

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
        


        const startStopButton = document.getElementById('start-stop-button');
        let isScanning = false;

        startStopButton.addEventListener('click', () => {
            if (isScanning) {
                barsearch.focus();
                html5Qrcode.stop();
                startStopButton.textContent = 'Start Scanning';
                isScanning = false;
            } else {
                barsearch.focus();
                html5Qrcode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
                startStopButton.textContent = 'Stop Scanning';
                isScanning = true;
            }
        });
        
        const barsearchbtn = document.getElementById('barsearchbtn');
        barsearchbtn.addEventListener('click',() =>{
            
            const ms = document.getElementById('manualsearch').value;
            console.log(ms);
           sendBarcodeToPHP(ms);
           
           document.getElementById('manualsearch').value = '';
           
        });
        
        const barsearch = document.getElementById('barsearch');
        barsearch.addEventListener('input', (event) => {
            // event.preventDefault(); // Prevent form submission
            
            const barcodeData = barsearch.value;
            if (barcodeData) {
                sendBarcodeToPHP(barcodeData);
                barsearch.value = "";
                barsearch.focus();
            } else {
                console.warn("Invalid barcode");
            }
        });
        
        
        //
        function sendBarcodeToPHP(barcodeData) {
    fetch('barcode.php', {
        method: 'POST',
        body: new URLSearchParams({ barcode: barcodeData })
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from PHP:', data);




//         const [id, rest] = data.split(' - '); 
// const [productName, priceStr] = rest.split(' ₱');
// const productPrice = parseFloat(priceStr); 
const [id, rest] = data.split(' - ');
const [productName, priceAndQuantity] = rest.split(' ₱');
const [priceStr, quantityStr] = priceAndQuantity.split(' - ');
const productPrice = parseFloat(priceStr);
const availableQuantity = parseInt(quantityStr, 10);

        const existingProductRow = document.querySelector(`#product-table-body tr[data-product-name="${productName}"]`);
        if (existingProductRow) {
            const quantityInput = existingProductRow.querySelector('input[name="productQuantity"]');
            const currentQuantity = parseInt(quantityInput.value);
            const newQuantity = currentQuantity + 1;
  

                quantityInput.value = newQuantity;
    
                const totalPriceCell = existingProductRow.querySelector('.total-price');
                const newTotalPrice = parseFloat(totalPriceCell.dataset.price) + productPrice;
                totalPriceCell.dataset.price = newTotalPrice;
                totalPriceCell.textContent = '₱' + newTotalPrice.toFixed(2);

                quantityInput.addEventListener('input', function() {
                    const newQuantity = parseInt(this.value);
                    if (newQuantity > availableQuantity) {
                        alert(`Cannot add more ${productName}. Available quantity is only ${availableQuantity}.`);
                       
                        this.value = 1;
                    }
                });
    
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
    document.getElementById('paymentmethod').disabled = false;

    const cdsubtotal = document.getElementById('total-value').textContent;
const cdtotal = document.getElementById('gtotal').textContent;
const cdvat = vatText;
const cddiscount =document.getElementById('discount').selectedIndex;
console.log(cddiscount);
fetch('cdtotal.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        cdsubtotal: cdsubtotal,
        cdtotal: cdtotal,
        cdvat: cdvat,
        cddiscount: cddiscount
    })
})
.then(response => response.text())
.then(data => {
    console.log("total" + data);
})
.catch(error => {
    console.error('Error:', error);
});

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

const cleardisplaybtn = document.getElementById('cleardisplay');
cleardisplaybtn.addEventListener("click", () => {
    fetch('clearSessionData.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        console.log('Session data cleared:', data);
        
    })
    .catch(error => {
        console.error('Error clearing session data:', error);
    });

})

// const productIds = [];

function sendtoprocess(receipt) {
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
    alert("successfull transaction")
})
.catch(error => {
  console.error('Error:', error);
});
}


function getreceipt(receiptId,productIds, subTotal, dis,vat, total,pay,amount,cchange) {
    let subValue = parseFloat(subTotal.split("₱")[1]);
  let totalValue = parseFloat(total.split("₱")[1]);
  let cchangeValue = parseFloat(cchange.split("₱")[1]);
  console.log(cchange+"getreceipt");

    const receipts = {
        receiptId:receiptId,
    productIds: productIds,
    subtot: subValue,
    discount: dis,
    vat:vat,
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
  
 

  return JSON.stringify(bills);
}


let receipts;

const makeReceipt = document.getElementById('make-receipt');

function generateReceiptID() {
    // Simple unique ID generation example using current timestamp and a random number
    return 'REC' + Date.now() + Math.floor(Math.random() * 3);
}

makeReceipt.addEventListener("click", () => {
    const tableRows = document.querySelectorAll('#product-table-body tr');
    const rowData = [];
    const productIds = []; // Reset productIds array each time the button is clicked

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
    });

    const displayContainer = document.getElementById('tabless');
    displayContainer.innerHTML = ''; // Clear previous receipt data

    // Loop through the rowData array
    rowData.forEach(data => {
        const itemDiv = document.createElement('div');
        itemDiv.innerHTML = `
            <p>Product Name: ${data.productName}</p>
            <p>Price: ₱${data.productPrice.toFixed(2)}</p>
            <p>Quantity: ${data.quantity}</p>
        `;
        displayContainer.appendChild(itemDiv);
    });

    // Display customer and payment details
    const pm = document.getElementById("paymentmethod").value;
    const generatedReceipt = generateReceiptID(); // Generate a unique receipt ID each time
    const vatText = document.getElementById('vat').textContent;
    const vatNum = parseInt(vatText.match(/\d+/)[0]);
    console.log(generatedReceipt);
    const totalValue = parseFloat(gTotalElement.split("₱")[1]);
    const refsText = "Ref no: " + generatedReceipt;
    const mopText = "Pay thru: " + pm;
    const ampText = "Amount paid: ₱" + (pm === "Gcash" ? totalValue : paid);
    const pchangeText = (pm === "Gcash" ? "Change: ₱0" : cuschange);
    const subtotText = totalValueElement;
    const discText = selectedOptionText;
    const totText = gTotalElement;

    if (pm == "") {
        alert("Select payment method first");
    } else {
        document.getElementById('refs').textContent = refsText;
        document.getElementById('mop').textContent = mopText;
        document.getElementById('amp').textContent = ampText;
        document.getElementById('pchange').textContent = pchangeText;
        document.getElementById('subtot').textContent = subtotText;
        document.getElementById('disc').textContent = discText;
        document.getElementById('tot').textContent = totText;

        receipts = getreceipt(
            generatedReceipt, productIds, totalValueElement, selectedOptionText,
            vatNum, gTotalElement, pm, pm === "Gcash" ? gTotalElement : paid, pm === "Gcash" ? 'Change: ₱0' : cuschange
        );
    }
    sendtoprocess(receipts);

    // Clear after processing the receipt
    selectElement.selectedIndex = 0;
    document.getElementById('total-value').textContent = 'Sub Total: ₱0.00';
    document.getElementById('gtotal').textContent = 'Total: ₱0.00';
    document.getElementById('cchange').textContent = "Change: ";
    document.getElementById('product-table-body').innerHTML = '';
    document.getElementById('cpayment').value = '';
    document.getElementById('print').disabled = false;
    document.getElementById('make-receipt').disabled = true;

    fetch('clearSessionData.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        console.log('Session data cleared:', data);
        // Optionally, perform any additional actions after clearing session data
    })
    .catch(error => {
        console.error('Error clearing session data:', error);
    });
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
            document.getElementById('make-receipt').disabled = false;
        }
    } else {
        alert("Please enter a valid amount");
    }
});


const clearButton = document.getElementById('clear-receipt');

// Add a click event listener to the clear button
clearButton.addEventListener('click', () => {

    document.getElementById("cname").value = "";
    document.getElementById("refs").textContent = "Ref no: ";
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

// const paylaterbtn = document.getElementById('paylater');
    
// paylaterbtn.addEventListener('click', () => {
//     const tableRows = document.querySelectorAll('#product-table-body tr');
// const rowData = [];

// const selectElement = document.getElementById('discount');
// const selectedOption = selectElement.options[selectElement.selectedIndex];
// const selectedOptionText = selectedOption.textContent;

// const totalValueElement = document.getElementById('total-value').textContent;
// const gTotalElement = document.getElementById('gtotal').textContent;

// tableRows.forEach(row => {
//     const productName = row.cells[1].textContent;
// const idString = row.cells[0].textContent;
// const id = parseInt(idString.trim()); 

// const priceString = row.cells[2].textContent.replace('₱', ''); 
// const productPrice = parseFloat(priceString); 
// const quantity = parseInt(row.querySelector('input[name="productQuantity"]').value);
// productIds.push({
//       id: id,
//       quantity: quantity,
//       productPrice: productPrice
//     });

// });
//     bill = getbills(customerName, customerEmail, productIds, totalValueElement, selectedOptionText, gTotalElement);
    

//     selectElement.selectedIndex = 0;

//     // Clear total and grand total
//     document.getElementById('total-value').textContent = 'Sub Total: ₱0.00';
// document.getElementById('gtotal').textContent = 'Total: ₱0.00';
// document.getElementById('cchange').textContent = "Change: ";
//     // Clear rowData
//     document.getElementById('product-table-body').innerHTML = '';
//     document.getElementById('cpayment').value = '';
//     rowData.length = 0
//     sendlink(bill);
// });

// const opentickets = document.getElementById('opentickets');
// opentickets.addEventListener('click', () =>{
//     window.location.href = 'paylater.php';
// })


