<?php

/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */



include('db.php');

//$db = new MyDB();
$result = $db->query('SELECT duration,failed_unit FROM machine_failure');

function sum_the_time($time1, $time2) {
  $times = array($time1, $time2);
  $seconds = 0;
  foreach ($times as $time)
  {
    list($hour,$minute,$second) = explode(':', $time);
    $seconds += $hour*3600;
    $seconds += $minute*60;
    $seconds += $second;
  }
  $hours = floor($seconds/3600);
  $seconds -= $hours*3600;
  $minutes  = floor($seconds/60);
  $seconds -= $minutes*60;
  // return "{$hours}:{$minutes}:{$seconds}";
  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
}

function hours($time) {
  
    return $time/3600;
}

//print_r(hours("10:32:46"));

$i=0;
$data = array();
$SumDrillingUnit = 0;
//$seconds_D = 0;
$SumMillingUnit = 0;
//$seconds_M = 0;
$SumClampingUnit = 0;
//$seconds_C = 0;6
$SumFeedUnit = 0;
//$seconds_F = 0;
$SumPowerUnit = 0;
//$seconds_P = 0;
$SumCoolantUnit = 0;
//$seconds_C = 0;
$SumControlUnit = 0;
//$seconds_Cl = 0;
while ($row = $result->fetch_row()) {
   $data[$i]['duration']= $row[0];
   $data[$i]['failed_unit']= $row[1];
   switch($data[$i]['failed_unit']){
     case "Drilling Unit":
     $SumDrillingUnit+=$data[$i]['duration'];
     break ;
     case "Milling Unit":
     $SumMillingUnit+=$data[$i]['duration'];
     break;
     case "Clamping Unit":
     $SumClampingUnit+=$data[$i]['duration'];
     break;
      case "Feed Unit":
     $SumFeedUnit+=$data[$i]['duration'];
     break;
      case "Power Unit":
     $SumPowerUnit+=$data[$i]['duration'];
     break;
      case "Coolant Unit":
     $SumCoolantUnit+=$data[$i]['duration'];
     break;
      case "Control Unit":
     $SumControlUnit+=$data[$i]['duration'];
     break;
   }

   $i++;
}
$Sum = array($SumDrillingUnit,$SumMillingUnit,$SumClampingUnit,$SumFeedUnit,$SumPowerUnit,$SumCoolantUnit,$SumControlUnit);
$Sum_seconds = array(hours($SumDrillingUnit), hours($SumMillingUnit),hours($SumClampingUnit), hours($SumFeedUnit), hours($SumPowerUnit), hours($SumCoolantUnit), hours($SumControlUnit));
$Unit = array("Drilling Unit", "Milling Unit", "Clamping Unit", "Feed Unit", "Power Unit", "Coolant Unit", "Coolant Unit");
 /*for($i=0; $i<5;$i++){
  echo $Unit[$i]. "\t". $Sum[$i]."\t".$Sum_seconds[$i]."hrs"."\n";
 }
 
*/

//print_r($data);
 /*$TotalDowntime = 0;
 for($i=0;$i<5;$i++){
  $TotalDowntime += $Sum_seconds[$i];
 }
 echo "Total Downtime = $TotalDowntime hrs."*/
?>

