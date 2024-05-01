<?php
function loghistory($pdoConnect,$message){
    $timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `log`(`action`, `timestamp`, `user_id`) VALUES (?,?,?)";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$message,$timestamp,$_SESSION['user_id']]);
    header("loacation:user_settings");

}
