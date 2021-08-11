<?php
    session_start();
    if(!isset($_SESSION['empemail'])){
      header("Location: staffsignin.php");
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
    <title>Change Password</title>
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
          <a class="nav-link" href="providemeter.php">Provide meter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="eadduser.php">Add user</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="updatecstatus.php">Update complaint status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="echangepsw.php"><b>Change password</b></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="ssignout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
 <style>
body, html {
  height: 100%;
  font-family: 'Montserrat', sans-serif;
  min-height:100%;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img/bg6.jpg);
  background-size:cover;
}

* {
  box-sizing: border-box;
}


/* Add styles to the form container */
.container {
  position: absolute;
  left:35%;
  top:20%;
  margin: 20px;
  max-width: 400px;
  padding: 16px;
  background-color: #FFFDD0;
  border-radius: 20px;
}

/* Full-width input fields */
input[type=text],input[type=email], input[type=password] {
  width: 100%;
  padding: 10px;
  margin: 10px 0 22px 0;
  border: 2px blue;
  background: white;
}

input[type=text]:focus,input[type=email]:focus, input[type=password]:focus {
  background-color: #dddddd;
  outline:none;
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
#emppswold{
border-radius:15px;
}
#emppswnew{
border-radius:15px;
}
#changepswhead{
text-align:center;
}
#emppswnewconf{
border-radius:15px;
}

</style>
<?php
  $servername="localhost";
  $username="root";
  $password="";
  $database="testing";
  $conn=mysqli_connect($servername, $username, $password, $database);
  if(!$conn){
    echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
    <strong>Error!</strong>Connection to the database unsuccessful!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    die();
  }

  $empid=$_SESSION['empid'];
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $emppswold=$_POST['emppswold'];
    $emppswnew=$_POST['emppswnew'];
    $emppswnewconf=$_POST['emppswnewconf'];

    if($emppswnew!=$emppswnewconf){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Unsuccessful!</strong> Your new passwords do not match. Please try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else{
    $q2="SELECT * from `employee` where  `empid`='$empid' and `emppsw`='$emppswold'";
    $res2=mysqli_query($conn,$q2);
    $row= mysqli_fetch_assoc($res2);

    $num = mysqli_num_rows($res2);
    if($num>0){
       $q7="UPDATE employee SET emppsw='$emppswnew' WHERE empid='$empid' ";
       $r7=mysqli_query($conn,$q7);
       
       if($r7){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your password has been successfully changed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
       }
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> The old password does not match. Please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
  }
  
  // $q1="SELECT * FROM user";
  // $res1=mysqli_query($conn,$q1);
  // if($res1){
  //   echo "<br>Retrived info successfully!<br>One data is $res1['useremail']";
  // }
  // else{
  //   echo "Cannot retrive info from table -->". mysqli_error($conn);
  // }

?>
<div class="login">
    <form action="echangepsw.php" class="container" method="post">
    <div class="changepswhead"  id="changepswhead"><h1>Change Password</h1></div>

    <label for="emppswold"><b>Old Password</b></label>
    <input type="password" id="emppswold" placeholder="Enter your old password" tabindex="-1" name="emppswold" required>

    <label for="emppswnew"><b>New Password</b></label>
    <input type="password" id="emppswnew" placeholder="Enter the new password" tabindex="-1" name="emppswnew" required>

    <label for="emppswnewconf"><b>Confirm New Password</b></label>
    <input type="password" id="emppswnewconf" placeholder="Enter the new password" tabindex="-1" name="emppswnewconf" required>

    <button type="submit" class="btn">Change password</button>
  </form>
</div>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="bootstrap-5.0.0-beta1-dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>
