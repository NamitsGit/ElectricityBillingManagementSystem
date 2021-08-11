<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: usersignin.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">

    <title>View My Bills</title>
    <style>
    body, html {
  height: 100%;
  font-family: 'Montserrat', sans-serif;
  min-height:100%;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img/bg10.jpg);
  background-color:grey;
  background-size:cover;
}

* {
  box-sizing: border-box;
}

/*Adding style to the table*/
.box {
    background-color:white;
    position:absolute;
    margin-left:-400px; /* half of width */
    margin-top:-150px;  /* half of height */
    top:40%;
    left:40%;
    white-space:nowrap;
}
tr:nth-child(even) {
  background-color: #dddddd;
}


/* Add styles to the form container */
.container {
  position: absolute;
  left:25%;
  top:20%;
  margin: 20px;
  max-width: 700px;
  padding: 16px;
  background-color:#cacfd2;
  border-radius: 20px;
}

/* Full-width input fields */
input[type=text], input[type=password],input[type=date],input[type=number] {
  width: 100%;
  padding: 10px;
  margin: 10px 0 22px 0;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #33CC33;
  color: white;
  padding: 16px 20px;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  border-radius: 25px;
}

.btn:hover {
  opacity: 1;
}
#meterno{
border-radius:15px;
}
#generatehead{
    text-align:center;

}
#readerid{
  border-radius:15px;
}
#billdate{
  border-radius:15px;
}
#prev_reading{
  border-radius:15px;
}
#pres_reading{
  border-radius:15px;
}
table {
  font-family: 'Montserrat', sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid black;
  text-align: center;
  padding: 8px;
  color:black;
}






/* TODO : HAVE TO LINK ALL FILES WITH OFFLINE BOOTSTRAP JS */









</style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">EBMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active disabled">
          <a class="nav-link" href="user.php">User Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upaidbills.php">Paid Bills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="uviewbills.php"><b>View Bills</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uchangeaddr.php">Change Address</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="writecomplaint.php">Write a Complaint</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uchangepsw.php">Change password</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="usignout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php
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

        



        if($row['paymentstatus']=="UNPAID"){
        $sql="UPDATE `paystatus` SET `paymentstatus` = 'PAID', `paydate` = '$datetoday' WHERE `paystatus`.`billno` = '$currbillno' ";
        $result=mysqli_query($conn,$sql);

        if($result){
            $q2="SELECT * FROM paystatus WHERE billno='$currbillno'";
            $r2=mysqli_query($conn,$q2);
            $row2=mysqli_fetch_assoc($r2);

            $paydate=$row2['paydate'];
            $billduedate=$row2['billdue'];

            if(strtotime($paydate)>strtotime($billduedate)){
              //If the payment date is after penalty then calculate penalty
            $q3="CALL penalty_calc('$currbillno')";
            $r3=mysqli_query($conn,$q3);
            

            $q4="SELECT * FROM paystatus WHERE billno='$currbillno'";
            $r4=mysqli_query($conn,$q4);
            $rowPen=mysqli_fetch_assoc($r4);
            $penaltyamt=$rowPen['penalty'];
            }

            if($r2){
            $billdate=$row2['billdate'];
            $totalamt=$row2['total'];
            $subtotalamt=$row2['subtotal'];
            $taxamt=$row2['tax'];
            
            }
            else{
                die;
            }
            $paydate=$row2['paydate'];
            if(strtotime($paydate)<=strtotime($billduedate)){

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>Bill number '.$currbillno.' is paid. Subtotal='.$subtotalamt.' Tax='.$taxamt.' Total='.$totalamt.' no penalty was charged.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
                // echo "Success! Bill was successfully paid.";
            }
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning ! </strong>Bill number '.$currbillno.' is paid LATE. Subtotal='.$subtotalamt.' Tax='.$taxamt.' Total='.$totalamt.' Penalty='.$penaltyamt.'(due to late payment of the bill)
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong>Bill number '.$currbillno.' was not paid becuase of technical issues. Please try agian.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            // echo "Error! The bill was able to be accessed in the DB but was not paid.";
        }
        }
        else{
            // echo " The bill is already paid! ";
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning ! </strong>Bill number '.$currbillno.' was not paid because it is already paid.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        
    }
?>
<table class="box">
    <tr>
        <td>Bill no</td>
        <td>Meter no</td>
        <td>Bill date</td>
        <td>Bill Due</td>
        <td>First Reading</td>
        <td>Second Reading</td>
        <td>Subtotal</td>
        <td>Tax</td>
        <td>Total</td>
        <td>Penalty</td>
        <td>Payment Status</td>
        <td>Action</td>
    </tr>

<?php
  $servername="localhost";
  $username="root";
  $password="";
  $database="testing";
  $conn=mysqli_connect($servername, $username, $password, $database);
  
  if(!$conn){
    echo "Connection to the database unsuccessful!";
  }
  $userid = $_SESSION['userid'];
  $username = $_SESSION['username'];

  //SQL Query to get all the bills generated by the reader who is logged in.
  $sql= "CALL `userbills`('$userid')";
  $result= mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result);
  if($num>0){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>'.$num.' </strong>bills of '.$username.' with User ID:'.$userid.' found!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      while($row=mysqli_fetch_assoc($result)){
        if($row['paymentstatus']=="UNPAID"){
          echo '<tr><td>'.$row['billno'].'</td><td>'.$row['meterno'].'</td><td>'.$row['billdate'].'</td><td>'.$row['billdue'].'</td><td>'.$row['prev_reading'].'</td><td>'.$row['pres_reading'].'</td><td>'.$row['subtotal'].'</td><td>'.$row['tax'].'</td><td>'.$row['total'].'</td><td>N/A</td><td>'. $row['paymentstatus'].'</td><td><form action="uviewbills.php" method="POST"><input type="hidden" value="'.$row['billno'].'" name="currbillno" id="currbillno"><button type="submit" class="btn btn-primary badge-pill">Pay</button></form></td></tr>';
        }
        else{
          echo '<tr><td>'.$row['billno'].'</td><td>'.$row['meterno'].'</td><td>'.$row['billdate'].'</td><td>'.$row['billdue'].'</td><td>'.$row['prev_reading'].'</td><td>'.$row['pres_reading'].'</td><td>'.$row['subtotal'].'</td><td>'.$row['tax'].'</td><td>'.$row['total'].'</td><td>'.$row['penalty'].'</td><td>'. $row['paymentstatus'].'</td><td><form action="uviewbills.php" method="POST"><input type="hidden" value="'.$row['billno'].'" name="currbillno" id="currbillno"><button type="submit" class="btn btn-primary badge-pill" disabled>Paid</button></form></td></tr>';
        }
      }
      echo "</table>";
  }
  else{
      echo "No bills found for the user, ".$username;
  }

?>

    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.0.0-beta1-dist/js/bootstrap.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>