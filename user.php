<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">

    <title>User Home</title>
    <style>
        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            min-height:100%;
            background:linear-gradient(0deg, rgba(0, 0, 0, 0.70), rgba(0, 0, 0, 0.70)), url(img/bg9.jpg);
            background-size:cover;
        }
        .centered {
            position: absolute;
            top: 35%;
            margin:20px;
            text-align: center;
            left: 50%;
            color:blanchedalmond;
            transform: translate(-50%, -50%);
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
        #button1{
            margin:35px;
            border-radius: 30px;
            text-align: center;
            white-space:nowrap;
        }
        #button2{
            margin:35px;
            border-radius: 30px;
            white-space:nowrap;
            text-align: center;
        }
        #button3{
            margin:35px;
            border-radius: 30px;
            text-align: center;
            white-space:nowrap;
        }
        #button4{
            margin:35px;
            border-radius: 30px;
            text-align: center;
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
          <a class="nav-link active disabled" href="user.php"><b>User Home</b></a>
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
session_start();
    if(!isset($_SESSION['username'])){
        header("Location: usersignin.php");
        exit();
    }
    else{
        $username=$_SESSION['username'];
        $userid=$_SESSION['userid'];
        $useremail=$_SESSION['useremail'];
    }
    

?>
    <div class="centered">
        <h1><b>Welcome to the portal, <?php echo $username; ?>.</b></h1>
        <h6><b>Please choose the purpose of your visit.<b></h6>
    </div>
    <section>
        <div class="container">
            <button type="button" onClick="location.href='upaidbills.php' " id="button2" class="btn btn-outline-light btn-lg"><b>Paid Bills</b> </button>
            <button type="button" onClick="location.href='uviewbills.php' " id="button2" class="btn btn-outline-light btn-lg"><b>View Bills</b> </button>
            <button type="button" onClick="location.href='writecomplaint.php' " id="button3" class="btn btn-outline-light btn-lg"><b>Write a complaint</b></button>
            <button type="button" onClick="location.href='uchangeaddr.php' " id="button3" class="btn btn-outline-light btn-lg"><b>Change My Address</b></button>
            <button type="button" onClick="location.href='uchangepsw.php' " id="button2" class="btn btn-outline-light btn-lg"><b>Change Password</b> </button>
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