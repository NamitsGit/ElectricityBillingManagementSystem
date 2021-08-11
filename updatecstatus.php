<?php
session_start();
if(!isset($_SESSION['empname'])){
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

    <title>Resolve complaints</title>
    <style>
    body, html {
  height: 100%;
  font-family: 'Montserrat', sans-serif;
  min-height:100%;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img/bg10.jpg);
  background-color:grey;
  background-size:cover;
}

* {
  box-sizing: border-box;
}

/*Adding style to the table*/
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
#meterno{
border-radius:15px;
}
#generatehead{
    text-align:center;

}
#readerid{
  border-radius:15px;
}
#billdate{
  border-radius:15px;
}
#prev_reading{
  border-radius:15px;
}
#pres_reading{
  border-radius:15px;
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
          <a class="nav-link" href="employee.php"><b>Employee Home</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="providemeter.php">Provide meter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="eadduser.php">Add user</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="updatecstatus.php"><b>Update complaint status</b></a>
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
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $currcompid=$_POST['currcompid'];
        $servername="localhost";
        $username="root";
        $password="";
        $database="testing";
        $conn=mysqli_connect($servername, $username, $password, $database);
        if(!$conn){
            echo "Fatal Error! Connection to the database was not established.";
        }
       $empid=$_SESSION['empid']; 
        
        $q1="UPDATE `complaints` SET `compstatus` = 'RESOLVED',`empid`= '$empid' WHERE `complaints`.`compid` = '$currcompid' ";
        $result=mysqli_query($conn,$q1);
        
        

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>Complaint with Complaint ID : '.$currcompid.' has been RESOLVED!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong>Complaint with Complaint ID : '.$currcompid.' was NOT RESOLVED!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
        }
    }
?>
<table class="box">
    <tr>
        <td>Complaint ID</td>
        <td>User ID</td>
        <td>Complaint Description</td>
        <td>Complaint Status</td>
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
  $empid = $_SESSION['empid'];
  $empname = $_SESSION['empname'];

  //SQL Query to get all the bills generated by the reader who is logged in.
  $sql= "SELECT * FROM complaints WHERE compstatus='UNRESOLVED' ";
  $result= mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result);
  if($num>0){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>'.$num.' </strong> unresolved complaints found!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      while($row=mysqli_fetch_assoc($result)){
          echo '<tr><td>'.$row['compid'].'</td><td>'.$row['userid'].'</td><td>'.$row['compdesc'].'</td><td>'.$row['compstatus'].'</td><td><form action="updatecstatus.php" method="POST"><input type="hidden" value="'.$row['compid'].'" name="currcompid" id="currcompid"><button type="submit" class="btn btn-primary badge-pill">Resolve</button></form></td></tr>';
      }
      echo "</table>";
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    No UNRESOLVED complaints found!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }

?>

    
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