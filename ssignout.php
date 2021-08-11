<?php
    session_start();
    if(isset($_SESSION['empname'])){
        session_unset();
        session_destroy();
        header("Location: staffsignin.php");
        exit();
    }
?>