<?php
// Start or resume the session
session_start();

// Clear the session data
unset($_SESSION['cd']);

// Optionally, perform any additional actions or logic

// Respond with a success message
echo "Session data cleared successfully.";
?>
