<?php
// Start PHP session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Display</title>
    <link rel="icon" type="image/png" href="include/image/sadas1.png">
    <link rel="stylesheet" href="include/styles/global.css">
    <style>


    .table {
        width: 90%;
        max-width: 600px;
        margin: 20px auto;
        margin-top: 2%;
        border-radius: 12px;
        overflow: hidden;
        background-color: #fffce4;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table div {
        padding: 10px;
        border-bottom: 1px solid #eee;
        font-size: 16px;
        
    }

    .table div:last-child {
        border-bottom: none;
    }

    .table div.highlight {
        font-weight: bold;
        color: #d9534f;
        font-size: 24px;
    }

    .table div.label {
        font-weight: bold;
        color: #333;
   
    }

    .table div.value {
        text-align: right;
        color: #555;
    }
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <img src="include/image/sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">Your Selection</div>
    </div>
</nav>

<div class="table">
    <?php
    if (isset($_SESSION['cd']) && is_array($_SESSION['cd'])) {
        foreach ($_SESSION['cd'] as $data) {
            echo '<div>' . htmlspecialchars($data) . '</div>';
        }
    } else {
        echo '<div>No Items Scanned.</div>';
    }

    if (isset($_SESSION['cdsubtotal'], $_SESSION['cdtotal'], $_SESSION['cdvat'], $_SESSION['cddiscount'])) {
        echo '<div class="label">Subtotal:</div><div class="value">' . htmlspecialchars($_SESSION['cdsubtotal']) . '</div>';
        echo '<div class="label">Discount:</div><div class="value">' . htmlspecialchars($_SESSION['cddiscount']) . '</div>';
        echo '<div class="label">VAT:</div><div class="value">' . htmlspecialchars($_SESSION['cdvat']) . '</div>';
        echo '<div class="highlight">Total:</div><div class="highlight value">' . htmlspecialchars($_SESSION['cdtotal']) . '</div>';
    } else {
        echo '<div class="label">Subtotal:</div><div class="value">N/A</div>';
        echo '<div class="label">Discount:</div><div class="value">N/A</div>';
        echo '<div class="label">VAT:</div><div class="value">N/A</div>';
        echo '<div class="highlight">Total:</div><div class="highlight value">N/A</div>';
    }
    ?>
</div>

<script>
    setInterval(function() {
        window.location.reload();
    }, 3000); // Refresh every 3 seconds
</script>
</body>
</html>
