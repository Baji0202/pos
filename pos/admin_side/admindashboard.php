<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: ..\index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div>
        <a href="user_settings.php">User Settings</a>
        <a href="cashmanagement.php">Cash Management</a>
        <a href="audit_trail.php">History logs</a>
        <a href="items_settings.php">Item Settings</a>
        <a href="discount.php">Discounts</a>
        <a href="..\logout.php">Logout</a>
    </div>

    
</body>
</html>