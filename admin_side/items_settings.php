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

    <title>Document</title>
</head>
<body>  
    <?php
        $sql = "SELECT * FROM clothingitems";
        $result = $pdoConnect->query($sql);
        if ($result->rowCount() > 0) {
            echo "<table border='5'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Barcode</th>";
            echo "<th>Item Name</th>";
            echo "<th>Brand</th>";
            echo "<th>Size</th>";
            echo "<th>Color</th>";
            echo "<th>Material</th>";
            echo "<th>Category</th>";
            echo "<th>Style</th>";
            echo "<th>Price</th>";
            echo "<th>Modify</th>";
            echo "</tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["item_id"] . "</td>";
                echo "<td>" . $row["Barcode"] . "</td>";
                echo "<td>" . $row["ItemName"] . "</td>";
                echo "<td>" . $row["Brand"] . "</td>";
                echo "<td>" . $row["Size"] . "</td>";
                echo "<td>" . $row["Color"] . "</td>";
                echo "<td>" . $row["Material"] . "</td>";
                echo "<td>" . $row["Category"] . "</td>";
                echo "<td>" . $row["Style"] . "</td>";
                echo "<td>" . $row["Price"] . "</td>";
                echo "<td><a href='#'>Update</a> <a href='#'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    ?>
</body>
</html>