<?php

/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */



include('db.php');
$result = $db->query('SELECT end_time,duration,job_type, component FROM job  where end_time!="NULL"');

function minutes($time) {
  //$minutes = 0;
  //  list($hour,$minute,$second) = explode(':', $time);
    //$minutes += $hour*60;
   // $minutes += $minute;
    //$minutes += $second/60;
    return $time/60;
}
$i=0;
$GMICamShaft_Regular = array();
$GMICamShaft_Regular_Endtime = array();
$NALTMainShaft_Regular= array();
$NALTMainShaft_Regular_Endtime = array();
$GMIMainShaft_Regular = array();
$GMIMainShaft_Regular_Endtime = array();
$GMICamShaft_Rework = array();
$NALTMainShaft_Rework = array();
$GMIMainShaft_Rework = array();
while ($row = $result->fetch_row()){
	$data[$i]['end_time']= $row[0];
   $data[$i]['duration']= $row[1];
   $data[$i]['job_type']= $row[2];
   $data[$i]['component']= $row[3];
   //echo $data[$i]['component']."\t".$data[$i]['job_type']."\t".$data[$i]['duration']."\n";
   
   //$array = array($data[$i]['job_type'], $data[$i]['component']);
   switch (true){
   	case ( $data[$i]['job_type']=="Normal"&& $data[$i]['component']=="GMI Cam Shaft"):
   	$GMICamShaft_Regular[$data[$i]['end_time']]=minutes($data[$i]['duration']);
  // 	array_push($GMICamShaft_Regular_Endtime, $data[$i]['end_time']);
    break;
   	case ( $data[$i]['job_type']=="Normal"&& $data[$i]['component']=="NALT Main Shaft"):
   	array_push($NALTMainShaft_Regular, minutes($data[$i]['duration']));
   	array_push($NALTMainShaft_Regular_Endtime, $data[$i]['end_time']);
   	break;
   	case ( $data[$i]['job_type']=="Normal"&& $data[$i]['component']=="GMI Main Shaft"):
   	array_push($GMIMainShaft_Regular, minutes($data[$i]['duration']));
   	array_push($GMIMainShaft_Regular_Endtime, $data[$i]['end_time']);
   	break;
	case ( $data[$i]['job_type']=="Rework"&& $data[$i]['component']=="GMI Cam Shaft"):
   	array_push($GMICamShaft_Rework, minutes($data[$i]['duration']));
   	break;
   	case ( $data[$i]['job_type']=="Rework"&& $data[$i]['component']=="NALT Main Shaft"):
   	array_push($NALTMainShaft_Rework, minutes($data[$i]['duration']));
   	break;
   	case ( $data[$i]['job_type']=="Rework"&& $data[$i]['component']=="GMI Main Shaft"):
   	array_push($GMIMainShaft_Rework, minutes($data[$i]['duration']));
   	break;
   }
   $i++;
}

//print_r($GMIMainShaft_Regular);

?>