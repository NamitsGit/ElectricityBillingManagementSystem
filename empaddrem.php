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

    <title>Manage Employees</title>
    <style>
        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            min-height:100%;
            background:linear-gradient(0deg, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(img/bg16.jpg);
            background-size:cover;
        }
        .container{
            border:none;
            width:10%;
            height: 85vh;
            display:flex;
            left:50%;
            align-items: center;
            justify-content: center;
            background-color:none;
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
            margin-right:100px; /* half of width */
            margin-top:200px;  /* half of height */
            top:5%;

            left:23%;
            white-space:nowrap;
        }
        tr:nth-child(even) {
        background-color: #dddddd;
        }
        .btn{
            border-radius:25px;
        }
        #addempbutton{
          position:absolute;
          background-color:#0d6efd;
          opacity:0.9;
          transform:translate(25px,-12px);
        }
        #addempbutton:hover{
          opacity:1.0;
        }
        .newbox{
          max-width:500px;
          align-items:center;
          position:relative;
          justify-content:center;
          transform:translate(500px,40px);
          border-radius:25px;
        }
        #empnamesearch{
          border-radius:35px;
          color:black;
          padding:10px;
          
        }
        #serchbutton{
          white-space:nowrap;
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
          <a class="nav-link active disabled" href="empaddrem.php"><b>Manage Employees</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="readaddrem.php">Manage Readers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="useraddrem.php">Manage Users</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="asignout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<table class="box">
    <tr>
        <td>Employee ID</td>
        <td>Employee Name</td>
        <td>Employee Email</td>
        <td>Employee Phone</td>
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


      $sql="SELECT * FROM employee";
      $result=mysqli_query($conn,$sql);
      $num=mysqli_num_rows($result);

      if($num>0){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>'.$num.' </strong> Employee(s) found!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        
        
          while($row=mysqli_fetch_assoc($result)){
              echo '<tr><td>'.$row['empid'].'</td><td>'.$row['empname'].'</td><td>'.$row['empemail'].'</td><td>'.$row['empphone'].'</td><td><form action="rememp.php" method="POST"><input type="hidden" value="'.$row['empid'].'" name="currreadid" id="currreadid"><button type="submit" class="btn btn-danger badge-pill">Remove</button></form></td></tr>';
          }
          echo "</table>";
      }
      else if($num==0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>'.$num.' </strong> Employee(s) found!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Fatal Error! </strong> The variable num was not assigned properly in readersearch.php line 150 !
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
    ?>
<div class="newbox">
    <form class="d-flex" action="empsearch.php" method="post">
      <input class="form-control me-2" id="empnamesearch" name="empnamesearch" type="search" placeholder="Search an employee by name" aria-label="Search" required>
      <button class="btn btn-success" name="searchbutton" id="searchbutton" type="submit">Search</button>
    </form>
</div>
<button class="btn btn-success badge-pill btn-lg" name="addempbutton" id="addempbutton" onClick="location.href='addemployee.php' "><b>Add Employee</b></button>





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
