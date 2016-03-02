<?php
session_start();
echo "<script>window.location.assign('login.php')</script>";
session_destroy();
?> 