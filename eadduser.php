<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">
    <title>Add user</title>
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
          <a class="nav-link active disabled" href="eadduser.php"><b>Add user</b></a>
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
  if(!$conn){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Error! </strong>Connection to the database was not established.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username=$_POST['usernameup'];
    $userphone=$_POST['userphoneup'];
    $useraddr=$_POST['useraddrup'];
    $useremail=$_POST['useremailup'];
    $userpsw=$_POST['userpswup'];
    $q1=" INSERT INTO user(username,userphone,useraddress,useremail,userpsw) values('$username','$userphone','$useraddr','$useremail','$userpsw')";
      $res1=mysqli_query($conn,$q1);
      if($res1){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>Your acccount has been created successfully!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
      }
      else{
        echo "Cannot insert info into table -->". mysqli_error($conn);
      }  
  }

?>
 <style>
body, html {
  height: 100%;
  font-family: 'Montserrat', sans-serif;
  min-height:100%;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(img/bg1.jpg);
  background-size:cover;
}

* {
  box-sizing: border-box;
}


/* Add styles to the form container */
.container {
  position: absolute;
  left:15%;
  margin: 20px;
  max-width: 1000px;
  padding: 16px;
  background-color: white;
  border-radius: 20px;
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
  background-color: #18b1ef;
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
border-radius:25px;
}
#userpsw{
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
<div class="login">
<form action="eadduser.php" class="container" method="POST">
    <div class="signuphead"  id="signuphead"><h1>User Sign-up</h1><nr><p>Please provide the following details for creating a new account for the user.</p></br></div>
    

    <label for="usernameup"><b>Name</b></label>
    <input type="text" id="usernameup" placeholder="Enter User's Name" name="usernameup" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required>
    

    <label for="userphoneup"><b>Phone Number</b></label>
    <input type="number" id="userphoneup" placeholder="Enter User's Phone Number" name="userphoneup" required>

    <label for="useraddrup"><b>Address</b></label>
    <input type="text" id="useraddrup" placeholder="Enter User's Address" name="useraddrup" required>

    <label for="useremailup"><b>Email</b></label>
    <input type="email" id="useremailup" placeholder="Enter User's Email" name="useremailup" required>

    <label for="userpswup"><b>Password</b></label>
    <input type="password" id="userpswup" placeholder="Enter a password" name="userpswup" required>

    <label for="userpswconfup"><b>Confirm Password</b></label>
    <input type="password" id="userpswconfup" oninput="return checkpassword()" placeholder="Enter the password again" name="userpswconfup" required>
    <!--HAVE TO CHECK CONFIRM VALIDATION-->
    <?php
        if(isset($userpswup) && strlen($userpswup)==strlen($userpswconfup) && $userpswup!=$userpswconf){
            echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
            <strong>Error! </strong>Your passwords do not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>

    <button type="submit" class="btn">Sign up</button>
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
