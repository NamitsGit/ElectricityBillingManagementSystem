<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: usersignin.php");
        exit();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $currbillno=$_POST['currbillno'];
        $servername="localhost";
        $username="root";
        $password="";
        $database="testing";
        $conn=mysqli_connect($servername, $username, $password, $database);
        if(!$conn){
            echo "Fatal Error! Connection to the database was not established.";
        }
        $datetoday=date("Y-m-d");

        $q1="SELECT paymentstatus FROM paystatus WHERE billno='$currbillno'";
        $r1=mysqli_query($conn,$q1);
        $row=mysqli_fetch_assoc($r1);
        echo "The first query was submitted successfully.";

        if($row['paymentstatus']=="UNPAID"){
        $sql="UPDATE `paystatus` SET `paymentstatus` = 'PAID', `paydate` = '$datetoday' WHERE `paystatus`.`billno` = '$currbillno' ";
        $result=mysqli_query($conn,$sql);

        if($result){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            // <strong>Success! </strong>Bill number '.$currbillno.' is paid.
            // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>';
            echo "Success! Bill was successfully paid.";
        }
        else{
            // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            // <strong>Error! </strong>Bill number '.$currbillno.' was NOT paid because of a technical error.
            // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>';
            echo "Error! The bill was able to be accessed in the DB but was not paid.";
        }
        }
        elseif($row['paymentstatus']=="PAID"){
            // echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            // <strong>Warning! </strong>Bill number '.$currbillno.' is already paid.Transactino UNSUCCESSFUL.
            // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>';
            echo "Warning! The bill has already been paid.";
        }
        else{
            // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            // <strong>Fatal Error! </strong>Bill number '.$currbillno.' was NOT paid.
            // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>';
            echo "Fatal Error! Bill was accessed and the status was neither paid nor unpaid.";
        }
    }
?>