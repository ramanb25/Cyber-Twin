<?php
  session_start();
  include('class_operator.php');
  $operator= new Operator();
  $operator->is_operator_login();
  
  $table = $_POST['table'];
  $start_time = $_POST['start_time'];
  
  $result=$operator->end_event($start_time,$table);
  
  echo json_encode($result);
?>
