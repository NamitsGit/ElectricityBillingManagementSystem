<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css">

    <title>Bill Generation</title>
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
          <a class="nav-link" href="reader.php">Reader Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="generatebill.php"><b>Generate a bill</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rviewbills.php">View Bills</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="rsignout.php">Logout</a>
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
  if(!isset($_SESSION['readername'])){
    header("Location: readersignin.php");
    exit();
  }

  if(!$conn){
    echo "Connection to the database unsuccessful!";
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $billdate=$_POST['billdate'];
    $prev_reading=$_POST['prev_reading'];
    $pres_reading=$_POST['pres_reading'];
    $readerid=$_POST['readerid'];
    $meterno=$_POST['meterno'];
    

    
          $sql="INSERT INTO `bill` (`billdate`, `billdue`, `prev_reading`, `pres_reading`, `subtotal`, `readerid`, `meterno`, `tax`) VALUES ('$billdate', NULL, '$prev_reading', '$pres_reading', NULL, '$readerid', '$meterno', NULL);";
          $result=mysqli_query($conn,$sql);
          if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong>Bill generated.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              $_SESSION['prev_reading']=$prev_reading;
              $_SESSION['pres_reading']=$pres_reading;
              $_SESSION['meterno']=$meterno;
              $_SESSION['billdate']=$billdate;
          }
          else{
            echo "Bill not submitted, because of this error -->". mysqli_error($conn);
          }

        
        
  }
?>

<div class="billgenerate">
    <form action="generatebill.php" class="container" method="post">
    <div class="generatehead"  id="generatehead"><h1>Bill Generation</h1></div>

    <label for="meterno"><b>Meter no.</b></label>
    <input type="text" id="meterno" placeholder="Enter meter number" name="meterno" required>

    <label for="readerid"><b>Reader id</b></label>
    <input type="text" class="disabled" value="<?php echo $_SESSION['readerid']; ?>" id="readerid" name="readerid" readonly>
    
    <div class="row">
    <div class="col">
      <label for="prev_reading"><b>Previous Reading</b></label>
      <input type="number"  id="prev_reading" placeholder="Enter previous meter reading" name="prev_reading" required>
    </div>
    <div class="col">
      <label for="pres_reading"><b>Present Reading</b></label>
      <input type="number"  id="pres_reading" placeholder="Enter present meter reading" name="pres_reading" required>
    </div>
    </div>
    <label for="billdate"><b>Bill date</b></label>
    <input type="date" id="billdate" name="billdate" required>

    <button type="submit" class="btn">Generate Bill</button>
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