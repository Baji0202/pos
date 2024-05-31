<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax</title>
</head>
<body>
<?php 
    require_once "..\include\connect\dbcon.php";
   
    $sql = "SELECT * FROM tax";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>" . $tax_name. "</td>";
        echo "<td>" . $tax_percent . "</td>";
        echo "<td class='modify'><a href='tax_update.php?id=$id'>Update</a></td>";

        echo "</tr>";
    }
    echo '</table>';
    
?>
</body>
</html>