<?php
session_start();
 if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype'])){
 $operator=0;
if ($_SESSION['mytype']==$operator)
{
  echo "<script>window.location.assign('index.php')</script>";
}
 $manager=1;
if (!$_SESSION['mytype']==$manager)
{//echo $_SESSION['mytype'];
  echo "<script>window.location.assign('graph.php')</script>";
}}
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Session</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <p>
</p>
  <div class="container">
   
<?php
require_once('dbconfig.php');
include('db.php');
if(isset($_POST['password'])    &&    isset($_POST['username'])){
$username=$_POST['username'];
$password=$_POST['password'];
$login=$_POST['login'];
if(isset($login)){
  $mysqli  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  }
  $res = $mysqli->query("SELECT * FROM login where username='$username' and password='$password'");
  $row = $res->fetch_assoc();
  $name = $row['name_login'];
  $user = $row['username'];
  $pass = $row['password'];
  $type = $row['type_login'];
  $manager=1;
  $operator=0;
  if($user==$username && $pass=$password){
    session_start();
    if($type==$manager){
      $_SESSION['mysesi']=$name;
      $_SESSION['mytype']=$manager;
      echo "<script>window.location.assign('graph.php')</script>";
    } else if($type==$operator){
      $_SESSION['mysesi']=$name;
      $_SESSION['mytype']=$operator;
      echo "<script>window.location.assign('index.php')</script>";
    } else{
?>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
  <strong>Maaf!</strong> Tidak sesuai dengan type user.
</div>
<?php
    }
  } else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
  <strong>Warning!</strong> This username or password not same with database.
</div>
<?php
  }
}}
?>
   
    <div class="panel panel-default">
      <div class="panel-body">
     
    <h2>Login Session</h2>
    <form role="form" method="post">
      <div class="form-group">
 <label for="username">Username</label>
 <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
 <label for="password">Password</label>
 <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
       
      </div>
     </div>
     
  </div>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>