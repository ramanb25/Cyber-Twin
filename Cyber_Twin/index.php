<?php
session_start();
  $manager=1;
  if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype']))
  {
      if (!$_SESSION['mytype']==$manager) {
          # code...
           echo "<script>window.location.assign('operator/index.php')</script>";
      }
   
   	echo "<script>window.location.assign('manager/index.php')</script>";
  }
  else
       echo "<script>window.location.assign('login.php')</script>";



?>