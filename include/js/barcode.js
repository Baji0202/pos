const html5Qrcode = new Html5Qrcode('reader');

const scanButton = document.getElementById('scan-button');
const barcodeInput = document.getElementById('barcode-input');
const productList = document.getElementById('product-list');
const totalPriceElement = document.getElementById('total-price');




// ... barcode scanning logic and library setup ...

// Function to fetch product data from PHP using AJAX
// function fetchProductData() {
//     fetch('barcode.php')
//       .then(response => response.json())
//       .then(data => {
//         // Process data received from PHP
//         var productName = data.name;
//         var productPrice = data.price;
    
//         // Example: Display the values
//         console.log("Product Name:", productName);
//         console.log("Product Price:", productPrice);
//       })
//       .catch(error => {
//         console.error('Error fetching data:', error);
//       });

//         }
         



// Function to display product in HTML
function displayProduct(product) {
    const listItem = document.createElement('li');
    listItem.textContent = `${product.ItemName} - ₱${product.Price.toFixed(2)}`; // Assuming these are the keys for name and price
    document.getElementById('productList').appendChild(listItem);
}

// Function to send barcode data to PHP and then fetch product data
function sendBarcodeToPHP(barcodeData) {
    fetch('barcode.php', {
        method: 'POST',
        body: new URLSearchParams({ barcode: barcodeData })
    })
    .then(response => response.json())
    .then(data => {
        // Display fetched product data
        displayProduct(data);
    })
    .catch(error => {
        console.error('Error sending data:', error);
    });
}

