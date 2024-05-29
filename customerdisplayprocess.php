<?php
session_start();

if (isset($_POST['data'])) {
    $inputData = file_get_contents("php://input");
    var_dump($inputData);
    $data = json_decode($inputData, true);
    // if ($data !== null) {
        $_SESSION['cd'] = $data;
        echo "Data received and stored in session successfully.";
    
    
    // } else {
    //     echo "Invalid data";
    // }
}

?>