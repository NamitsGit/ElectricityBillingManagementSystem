<?php
    session_start();
    if(isset($_SESSION['useremail'])){
      echo("The condition is true");
      header("Location: user.php");
      exit();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS changed to work offline -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">
    <title>EBMS</title>
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
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active disabled"  href="usersignin.php"><b>User</b></a>
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
 <style>
body, html {
  height: 100%;
  font-family: 'Montserrat', sans-serif;
  min-height:100%;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img/bg5.jpg);
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
  background-color: #cacfd2;
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
#useremail{
border-radius:15px;
}
#userpsw{
border-radius:15px;
}
#loginhead{
text-align:center;
}
#createuacc{
  text-align:center;
  margin: 2px;
}
li{
  list-style-type:none;
  cursor:pointer;
  color:blue;
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
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $useremail=$_POST['useremail'];
    $userpsw=$_POST['userpsw'];

    $q2="SELECT * from `user` where  `useremail`='$useremail' and `userpsw`='$userpsw'";
    $res2=mysqli_query($conn,$q2);
    $row= mysqli_fetch_assoc($res2);

    $num = mysqli_num_rows($res2);
    if($num>0){
      $_SESSION['username'] = $row['username'];
      $_SESSION['useremail'] = $row['useremail'];
      $_SESSION['userid'] = $row['userid'];
      $_SESSION['useraddress']= $row['useraddress'];
      $_SESSION['userphone']=$row['userphone'];
    header("Location: user.php");
    exit();
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error Logging in!</strong> No such account found!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
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
    <form action="usersignin.php" class="container" method="post">
    <div class="loginhead"  id="loginhead"><h1>User Login</h1></div>

    <label for="useremail"><b>Email</b></label>
    <input type="email" id="useremail" placeholder="Enter Email" tabindex="-1" name="useremail"  required>

    <label for="userpsw"><b>Password</b></label>
    <input type="password" id="userpsw" placeholder="Enter Password" tabindex="-1" name="userpsw" required>

    <button type="submit" class="btn">Login</button>
    <br>
    <div class="createuacc" id="createuacc" onClick="location.href='usersignup.php' "> <br><h8>Don't have an account? <li>Create a new one here!</li></h8></div>
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
  </body>
</html>
