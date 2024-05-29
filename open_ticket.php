<?php
session_start();

// Check if ticket data is stored in session
if (isset($_SESSION['ticketData'])) {
    $ticketData = $_SESSION['ticketData'];

    // Loop through each ticket in the ticket data
    foreach ($ticketData as $ticket) {
        $customerName = isset($ticket['customerName']) ? htmlspecialchars($ticket['customerName']) : 'Unknown';

        echo "<h2>Customer Name: $customerName</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Item name</th>
                    <th>Item price</th>
                    <th>Quantity</th>
                </tr>";

        // Loop through each item in the current ticket
        foreach ($ticket['items'] as $item) {
            echo "<tr>
                    <td>" . htmlspecialchars($item['itemName']) . "</td>
                    <td>" . htmlspecialchars($item['itemPrice']) . "</td>
                    <td>" . htmlspecialchars($item['quantity']) . "</td>
                  </tr>";
        }
           echo '<a href="home.php">Back</a>';
        echo "</table>";
    }
} else {
    echo "No ticket data found in session.";
}
?>
