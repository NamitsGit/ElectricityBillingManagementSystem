<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">
    <title>EBMS</title>
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
 <?php
  $servername="localhost";
  $username="root";
  $password="";
  $database="testing";
  $conn=mysqli_connect($servername, $username, $password, $database);
  if(!$conn){
    die("Connection to the database unsuccessful because of this error -->". mysqli_connect_error($conn));
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
         Your email ' . $useremail . ' and password ' . $userpsw . ' have been submitted successfully
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
  background-color: #cacfd2;
  border-radius: 20px;
}

/* Full-width input fields */
input[type=text],input[type=number],input[type=email], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: 2px blue;
  background: white;
  border-radius:25px;
}

input[type=text]:focus,input[type=number]:focus, input[type=password]:focus {
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
<form action="usersignup.php" class="container" method="POST" name="form"> 
    <div class="signuphead"  id="signuphead"><h1>User Sign-up</h1><nr><p>Please provide the following details for creating a new account.</p></br></div>
    

    <label for="usernameup"><b>Name</b></label>
    <input type="text" id="usernameup" tabindex="-1" placeholder="Enter your Name" name="usernameup" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode === 32)" required>

    <label for="userphoneup"><b>Phone Number</b></label>
    <input type="text" id="userphoneup" tabindex="-1" maxlegth="10" placeholder="Enter your Phone Number" onkeypress="return (event.charCode > 47 && 
event.charCode < 58)" pattern="[0-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number, excluding the country code(IND +91)" name="userphoneup" required>

    <label for="useraddrup"><b>Address</b></label>
    <input type="text" id="useraddrup" tabindex="-1" placeholder="Enter your Address" name="useraddrup" required>

    <label for="useremailup"><b>Email</b></label>
    <input type="text" id="useremailup" tabindex="-1" placeholder="Enter your Email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" title="A valid email address should contain atleast one letter before @ ,some domain followed by a '.'(dot) and a remaining part" name="useremailup" required>

    <label for="userpswup"><b>Password</b></label>
    <input type="password" id="userpswup" maxlength="10" tabindex="-1" placeholder="Enter a password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" name="userpswup" required>

    
    <label for="userpswconfup"><b>Confirm Password</b></label>
    <input type="password" id="userpswconfup" maxlength="10" tabindex="-1" placeholder="Enter the password again" oninput="return validatepassword()" name="userpswconfup" required>
    <span id="message" name="message"></span>
    <div class="text1"><h7>Please remember this email and password for logging into the system.</h7></div>

    <button type="submit" class="btn" onclick="return validatepassword()">Sign up</button>
  </form>
</div>




<!-- The changed part is here -->

<!-- The validation function is not working -->









<script type="text/javascript">
var form=document.getElementById("form");
    function validatepassword(form) { 
                var password1 = form.userpswup.value; 
                var password2 = form.userpswconfup.value; 
  
                // If password not entered 
                if (password1 == '') 
                    alert ("Please enter Password"); 
                      
                // If confirm password not entered 
                else if (password2 == '') 
                    alert ("Please enter confirm password"); 
                      
                // If Not same return False.     
                else if (password1 != password2) { 
                    alert ("\nPassword did not match: Please try again...") 
                    return false; 
                } 
  
                // If same return True. 
                else{ 
                    alert("Password Match: Welcome to GeeksforGeeks!") 
                    return true; 
                } 
            }
</script>








<!-- Till here -->






 


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
