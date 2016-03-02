<?php

include 'db.php';
 //$sql = "INSERT INTO '$table' VALUES ('$start_time', '$end_time', '$duration')";
   // $db->query($sql);
$table = $_POST['table'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$duration = $_POST['duration'];
switch($table)
{

  case "job":
   $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var2 = $extra[1]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration', '$var1', '$var2')";
    $db->query($sql);
    break;
  case "machine_failure":
   $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var2 = $extra[1]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration', '$var1', '$var2')";
    $db->query($sql);
    break;
  case "setup_change":
    $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $var2 = $extra[1]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration', '$var1', '$var2')";
    $db->query($sql);
    break;
  case "production_stoppage":
   $extra = json_decode($_POST['extra'],true);
    $var1 = $extra[0]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration', '$var1')";
    $db->query($sql);
    break;
  case "operator_unavailability":
    $extra = json_decode($_POST['extra'],true);
    $cause = $extra[0]['value'];
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration', '$cause')";
    $db->query($sql);
    break;
  case "pm":
  case "precautionary_check":
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration')";
    $db->query($sql);
    break;
  case "lunch_tea":
    $sql = "INSERT INTO `$table` VALUES ('$start_time', CURRENT_TIMESTAMP, '$duration')";
    $db->query($sql);
    break;
}
echo json_encode($sql);
?>
