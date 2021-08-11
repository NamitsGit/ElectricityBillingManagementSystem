<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">

    <title>Provide a meter</title>
    <style>
    body, html {
  height: 100%;
  font-family: 'Montserrat', sans-serif;
  min-height:100%;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(img/bg10.jpg);
  background-size:cover;
}

* {
  box-sizing: border-box;
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
  border: 2px blue;
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
#empid{
border-radius:15px;
}
#providehead{
    text-align:center;
}
#userid{
  border-radius:15px;
}
#qty{
  border-radius:15px;
}

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
        <li class="nav-item">
          <a class="nav-link" href="employee.php">Employee Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="providemeter.php"><b>Provide meter</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="eadduser.php">Add user</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="updatecstatus.php">Update complaint status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="echangepsw.php">Change password</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="ssignout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php
  $servername="localhost";
  $username="root";
  $password="";
  $database="testing";
  $conn=mysqli_connect($servername, $username, $password, $database);
  session_start();
  if(!$conn){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error! </strong>Database connection was not established.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  if(!isset($_SESSION['empname'])){
    header("Location: staffsignin.php");
    exit();
  }
  $empid=$_SESSION['empid'];
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $datetoday=date("Y-m-d");
    $userid=$_POST['userid'];
    $qty=$_POST['qty'];
    $empid=$_SESSION['empid'];

    $curr=1;
    $sql2="SELECT * FROM meter WHERE userid=$userid AND issuedate=$datetoday AND empid=$empid";
    $res2=mysqli_query($conn,$sql2);
    $num=mysqli_num_rows($res2);
    
    if($num!=$qty){
    while($curr<=$qty){
    $sql1="INSERT INTO meter(userid,issuedate,empid) values('$userid','$datetoday','$empid')";
    $res1=mysqli_query($conn,$sql1);
    $curr = $curr + 1;
    }
    if($res1){
      $curr= $curr-1;
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success! </strong>The '.$curr.' number of meter(s) was successfully added to the user.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      // $_SESSION['lastaddedqty']=$qty;
      // $_SESSION['lastaddeddate']=$datetoday;
      // $_SESSION['lastaddedempid']=$empid;
      // $_SESSION['lastaddeduserid']=$userid;
      
    }
    else{
      echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
      <strong>Error! </strong>The meter(s) was not added to the user.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
  }
  }
   
?>

<div class="providemetere">
    <form action="providemeter.php" class="container" method="post">
    <div class="providehead"  id="providehead"><h1>Provide a meter</h1></div>

    <label for="empid"><b>Employee id</b></label>
    <input type="number" tabindex="-1" id="empid" value="<?php echo $empid; ?>" name="empid" readonly>

    <label for="userid"><b>User id</b></label>
    <input type="number" tabindex="-1" placeholder="Enter the userid" id="userid" name="userid" required>
    
    <label for="qty"><b>Quantity</b></label>
    <input type="number" tabindex="-1" id="qty" name="qty" required>

    <button type="submit" tabindex="-1" class="btn">Issue meter(s)</button>
  </form>
</div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    
    -->
    
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>
  </body>
</html>