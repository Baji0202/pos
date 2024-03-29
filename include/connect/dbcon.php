<?php
    $db = 'pos'; 
    try {
        $pdoConnect = new PDO ("mysql:host=localhost:3306;dbname=$db","root","");
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
    
