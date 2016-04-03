<?php

/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */


include('db.php');

//$db = new MyDB();
$result = $db->query('SELECT end_time,duration FROM lunch_tea where end_time!="NULL"');

function minutes($time) {
  $minutes = 0;
   // list($hour,$minute,$second) = explode(':', $time);
    $minutes += (int) $time/60;
    //$minutes += $minute;
    //$minutes += $second/60;
    return $minutes;
}
$EndTime1 = array();
$Duration1 = array();
while ($row = $result->fetch_row()){
	$time = strtotime($row[0]);
	//echo $time;
	//echo "<br>";
	$newformat = date('Y-m-d',$time);
	//echo $newformat;
    
	if (in_array($newformat, $EndTime1)) {
       	//echo "The 'first' element is in the array";
       	$Duration1[$newformat]+=minutes($row[1]);
       //	echo "me";
    }
    else{
    	array_push($EndTime1, $newformat);
    	$Duration1[$newformat]=minutes($row[1]);
    }/*$data[$i]['end_time']= $row['end_time'];
   $data[$i]['duration']= minutes($row['duration']);
*/
   }
//print_r($EndTime1);
//print_r($Duration1);

?>