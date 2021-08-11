<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="testing";
    $conn=mysqli_connect($servername, $username, $password, $database);
    session_start();
    
    if(!$conn){
      echo "Connection to the database unsuccessful!";
    }
    if(!isset($_SESSION['adminid'])){
        header("Location: adminsignin.php");
        exit();
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $currreadid=$_POST['currreadid'];
    
        $sql="DELETE FROM reader WHERE readerid='$currreadid' ";
        $result=mysqli_query($conn,$sql);
    
        if($result){
          header("Location: readaddrem.php");
          exit();
        }
        else{
          echo "Removing the employee was NOT successful!";
        }
    }
?>