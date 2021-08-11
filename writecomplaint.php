<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">

    <title>Complaint</title>
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
  left:18%;
  top:20%;
  margin: 20px;
  max-width: 1000px;
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
#userid{
border-radius:15px;
}
#complainhead{
    text-align:center;
}
#compdesc{
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
        <li class="nav-item active disabled">
          <a class="nav-link" href="user.php">User Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upaidbills.php">Paid Bills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uviewbills.php">View Bills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uchangeaddr.php">Change Address</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="writecomplaint.php"><b>Write a Complaint</b></a>
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
  $servername="localhost";
  $username="root";
  $password="";
  $database="testing";
  $conn=mysqli_connect($servername, $username, $password, $database);
  session_start();
  if(!isset($_SESSION['userid'])){
    header("Location: uesrsignin.php");
    exit();
  }
  if(!$conn){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Fatal Error !</strong>Cannot connect to the database.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userid=$_SESSION['userid'];
      $compdesc=$_POST['compdesc'];
      

      $sql="INSERT INTO `complaints` (`userid`, `compdesc`) VALUES ('$userid', '$compdesc')";
      $result=mysqli_query($conn,$sql);
      if(!$result){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error !</strong>Cannot submit the complaint.Please retry.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      else{
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success !</strong>Your complaint has been submitted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $_SESSION['recentcomplaint']=$compdesc;
      }
    
    
  }

?>

<div class="complaint">
    <form action="writecomplaint.php" class="container" method="post">
    <div class="complainhead"  id="complainhead"><h1>Write a complaint</h1></div>

    
    <label for="compdesc"><b>Complain Description</b></label>
    <p>We are very sorry for the inconvenience caused.Please explain the problem faced by you.</p>

    <input type="text" placeholder="Please explain your concern here..." id="compdesc" name="compdesc">

    

    <label for="userid"><b>User id</b></label>
    <input type="text" class="disabled" value="<?php echo $_SESSION['userid']; ?>" id="userid" name="userid" readonly>
    

    <button type="submit" class="btn">Submit complaint</button>
  </form>
</div>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>