<?php
// Start or resume the session
session_start();

// Clear the session data
unset($_SESSION['cd']);
unset ($_SESSION['cdsubtotal']); 
unset($_SESSION['cdtotal']);
unset($_SESSION['cdvat']);
unset($_SESSION['cddiscount']);
unset($_SESSION['url']);
// Optionally, perform any additional actions or logic

// Respond with a success message
echo "Session data cleared successfully.";
?>
