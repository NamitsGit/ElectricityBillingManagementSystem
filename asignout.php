<?php
    session_start();
    if(isset($_SESSION['adminid'])){
        session_unset();
        session_destroy();
        header("Location: adminsignin.php");
        exit();
    }
?>