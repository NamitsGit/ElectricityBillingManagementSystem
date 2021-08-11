<?php
    session_start();
    if(isset($_SESSION['readername'])){
        session_unset();
        session_destroy();
        header("Location: readersignin.php");
        exit();
    }
?>