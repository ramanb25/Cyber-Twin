<?php

include 'db.php';
 //$sql = "INSERT INTO '$table' VALUES ('$start_time', '$end_time', '$duration')";
   // $db->query($sql);
$table = $_POST['table'];
//$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$duration = $_POST['duration'];
 if($end_time==="NULL")
    $end_time="NULL";//ALWAYS NULL
  else {
    $timezone=new DateTimeZone("ASIA/KOLKATA");
        $now = new DateTime();
        $now->setTimezone($timezone );
    $end_time=$now->format('Y-m-d H:i:s');
  }
   $timezone=new DateTimeZone("ASIA/KOLKATA");
        $now = new DateTime();
        $now->setTimezone($timezone );
    $start_time=$now->format('Y-m-d H:i:s');

switch($table)
{

 
  case "job":
   $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var2 = $extra[1]['value'];
    $var3 = $extra[2]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1', '$var2','$var3')";
    $db->query($sql);
    break;
  case "machine_failure":
   $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var2 = $extra[1]['value'];
    $var3 = $extra[2]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1', '$var2','$var3')";
    $db->query($sql);
    break;
  case "setup_change":
    $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var2 = $extra[1]['value'];
    $var3 = $extra[2]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1', '$var2','$var3')";
    $db->query($sql);
    break;
  case "production_stoppage":
   $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var12 = $extra[1]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1','$var12')";
    $db->query($sql);
    break;
  case "operator_unavailability":
    $extra = json_decode($_POST['extra'],true);
    $cause = $extra[0]['value'];
    $var1 = $extra[1]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$cause','$var1')";
    $db->query($sql);
    break;
  case "pm":
  case "precautionary_check":
  $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time','$duration','$var1')";
    $db->query($sql);
    break;
  case "lunch_tea":
    $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration','$var1')";
    $db->query($sql);
    break;
}
echo json_encode($start_time);
?>
