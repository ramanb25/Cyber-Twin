<?php

/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */



class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('events.db');
    }
}

$db = new MyDB();
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
  $hours = 0;
    list($hour,$minute,$second) = explode(':', $time);
    $hours += $hours;
    $hours += $minute/60;
    $hours += $second/3600;
    return $hours;
}

$i=0;
$data = array();
$SumDrillingUnit = '00:00:00';
$seconds_D = 0;
$SumMillingUnit = '00:00:00';
$seconds_M = 0;
$SumClampingUnit = '00:00:00';
$seconds_C = 0;
$SumFeedUnit = '00:00:00';
$seconds_F = 0;
$SumPowerUnit = '00:00:00';
$seconds_P = 0;
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
   $data[$i]['duration']= $row['duration'];
   $data[$i]['failed_unit']= $row['failed_unit'];
   switch($data[$i]['failed_unit']){
     case "Drilling Unit":
     $SumDrillingUnit=sum_the_time($SumDrillingUnit,$data[$i]['duration']);
     break ;
     case "Milling Unit":
     $SumMillingUnit=sum_the_time($SumMillingUnit,$data[$i]['duration']);
     break;
     case "Clamping Unit":
     $SumClampingUnit=sum_the_time($SumClampingUnit,$data[$i]['duration']);
     break;
      case "Feed Unit":
     $SumFeedUnit=sum_the_time($SumFeedUnit,$data[$i]['duration']);
     break;
      case "Power Unit":
     $SumPowerUnit=sum_the_time($SumPowerUnit,$data[$i]['duration']);
     break;
   }

   $i++;
}
$Sum = array($SumDrillingUnit,$SumMillingUnit,$SumClampingUnit,$SumFeedUnit,$SumPowerUnit);
$Sum_seconds = array(hours($SumDrillingUnit), hours($SumMillingUnit),hours($SumClampingUnit), hours($SumFeedUnit), hours($SumPowerUnit));
$Unit = array("Drilling Unit", "Milling Unit", "Clamping Unit", "Feed Unit", "Power Unit");
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

