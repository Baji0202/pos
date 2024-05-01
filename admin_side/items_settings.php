<?php
    session_start();
    $pdoConnect = new PDO ("mysql:host=localhost:3306;dbname=pos","root","");
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!isset($_SESSION['user_id'])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="../include/styles/discount.css">
    <title>Document</title>
</head>
<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div><a href="admindashboard.php">Back</a>
</div>

</nav>

<body>  
    <?php
        $sql = "SELECT * FROM groceryitems";
        $result = $pdoConnect->query($sql);
        if ($result->rowCount() > 0) {
            echo "<table border='5'>";
            echo "<tr>";
            echo "<th>barcode</th>";
            echo "<th>name</th>";
            echo "<th>category</th>";
            echo "<th>price</th>";
            echo "</tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["barcode"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td><a href='#'>Update</a> | <a href='#'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    ?>
</body>
</html>