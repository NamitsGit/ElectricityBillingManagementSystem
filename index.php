<?php
    session_start();
    if(isset($_SESSION['useremail'])){
      echo("The condition is true");
      header("Location: user.php");
      exit();
    }
?>
<?php
    if(isset($_SESSION['empemail'])){
      echo("The condition is true");
      header("Location: employee.php");
      exit();
    }
?>
<?php
    if(isset($_SESSION['readerid'])){
      echo("The condition is true");
      header("Location: reader.php");
      exit();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS Changed to work offline -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Welcome</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand disabled" href="index.php">EBMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active disabled" aria-current="page" href="index.php"><b>Home</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usersignin.php">User</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Employee
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="staffsignin.php">Office Staff</a></li>
            <li><a class="dropdown-item" href="readersignin.php">Reader</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminsignin.php">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- <div class="container-text">
<h1>Welcome to EBMS</h2>
</div> -->
<div class="centered">
      <h1>Welcome to Electricity Billing Management System</h2>
      <p name="smallp" id="smallp">Choose your profile from the options given below...</p>
    </div>
    <section>
        <div class="container">
            <button type="button" onClick="location.href='usersignin.php' " id="button1" class="btn btn-outline-light btn-lg"><b>User</b></button>
            <button type="button" onClick="location.href='readersignin.php' " id="button2" class="btn btn-outline-light btn-lg"><b>Reader</b> </button>
            <button type="button" onClick="location.href='staffsignin.php' " id="button3" class="btn btn-outline-light btn-lg"><b>Staff</b></button>
            <button type="button" onClick="location.href='adminsignin.php' " id="button4" class="btn btn-outline-light btn-lg"><b>Admin</b></button>
        </div>
    </section>

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
