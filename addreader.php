<?php
    session_start();
    if(!isset($_SESSION['adminid'])){
        header("Location: adminsignin.php");
        exit();
    }
    else{
        $adminid=$_SESSION['adminid'];
        $adminname=$_SESSION['adminname'];
        $adminpsw=$_SESSION['adminpsw'];
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

    <title>Add new Employee</title>
    <style>
        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            min-height:100%;
            background:linear-gradient(0deg, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(img/bg16.jpg);
            background-size:cover;
        }
        .container {
        position: absolute;
        left:15%;
        margin: 20px;
        max-width: 1000px;
        padding: 16px;
        background-color: white;
        border-radius: 20px;
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
        .box {
            background-color:white;
            position:absolute;
            margin-left:-400px; /* half of width */
            margin-top:-150px;  /* half of height */
            top:40%;
            left:50%;
            white-space:nowrap;
        }
        tr:nth-child(even) {
        background-color: #dddddd;
        }
        
        /* Full-width input fields */
        input[type=text],input[type=number],input[type=email], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: 2px blue;
        background: #f1f1f1;
        border-radius:25px;
        }

        input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
        }

        /* Set a style for the submit button */
        .btn {
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
        #empemail{
        border-radius:25px;
        }
        #empname{
        border-radius:25px;
        }
        #empphone{
        border-radius:25px;
        }
        #emppsw{
        border-radius:25px;
        }
        #emppswconf{
        border-radius:25px;
        }
        #signuphead{
        text-align:center;
        }
        .text1{
        text-align:center;
        margin: 10px;
        padding:5px;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand disabled" href="#">EBMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="adminhome.php">Admin Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="empaddrem.php">Manage Employees</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="readaddrem.php"><b>Manage Readers</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="useraddrem.php">Manage Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="achangepsw.php">Change Password</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="asignout.php">Logout</a>
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
  
  if(!$conn){
    echo "Connection to the database unsuccessful!";
  }
  if($_SERVER['REQUEST_METHOD']=="POST"){
    $readername=$_POST['readername'];
    $readerphone=$_POST['readerphone'];
    $readeremail=$_POST['readeremail'];
    $readerpsw=$_POST['readerpsw'];

  //SQL Query to add the employee into the database


  $sql= "INSERT INTO reader(readername,readerphone,readeremail,readerpsw) values('$readername','$readerphone','$readeremail','$readerpsw')";
  $result= mysqli_query($conn,$sql);
  if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success! </strong> Reader added to the database !
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! </strong> Reader was NOT added to the database !
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }

}
?>
<div class="login">
<form action="addreader.php" class="container" method="POST" oninput='readerpswconf.setCustomValidity(readerpswconf.value != readerpsw.value ? "Passwords do not match." : "")'>
    <div class="signuphead"  id="signuphead"><h1>Reader Sign-up</h1><nr><p>Please provide the following details for creating a new account.</p></br></div>
    

    <label for="readername"><b>Reader Name</b></label>
    <input type="text" id="readername" placeholder="Enter Reader's Name" name="readername" required>

    <label for="readerphone"><b>Reader's Phone Number</b></label>
    <input type="number" id="readerphone" placeholder="Enter Reader's Phone Number" name="readerphone" required>

    <label for="readeremail"><b>Reader's Email</b></label>
    <input type="email" id="readeremail" placeholder="Enter Reader's Email" name="readeremail" required>

    <label for="readerpsw"><b>Password</b></label>
    <input type="password" id="readerpsw" placeholder="Enter a password" name="readerpsw" required>

    <label for="readerpswconf"><b>Confirm Password</b></label>
    <input type="password" id="readerpswconf" placeholder="Enter the password again" name="readerpswconf" required>
    

    <button type="submit" class="btn btn-primary">Sign up</button>
  </form>
</div>



<!-- Add bootstrap validation from youtube here-->












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
