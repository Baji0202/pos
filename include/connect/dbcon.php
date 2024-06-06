<?php
    $db = 'posfinale'; 
    try {
        $pdoConnect = new PDO ("mysql:host=localhost:3307;dbname=$db","root","");
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
    
