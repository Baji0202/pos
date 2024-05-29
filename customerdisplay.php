<?php
// Start PHP session
session_start();

// Check if table data is stored in session

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link rel="icon" type="image/png" href="include\image\sadas1.png">
    
</head>
<body>

<?php
if (isset($_SESSION['cd']) && is_array($_SESSION['cd'])) {
    // Loop through each element of the array
    foreach ($_SESSION['cd'] as $data) {
        // Echo the data
        echo $data . "<br>";
    }
} else {
    // Handle case where $_SESSION['cd'] is not set or is not an array
    echo "No data available.";
}



?>

<script>
    setInterval(function() {
    window.location.reload();
}, 3000); // Refresh every 5 seconds


    </script>
</body>
</html>