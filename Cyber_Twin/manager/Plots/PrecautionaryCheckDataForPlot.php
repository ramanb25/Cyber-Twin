<?php

/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */



include("db.php");
$result = $db->query('SELECT end_time,duration FROM precautionary_check');

function minutes($time) {
    return $time/60;
}
$EndTime2 = array();
$Duration2 = array();
while ($row = $result->fetch_row()){
    array_push($EndTime2, $row[0]);
    array_push($Duration2, minutes($row[1]));
    /*$data[$i]['end_time']= $row['end_time'];
   $data[$i]['duration']= minutes($row['duration']);
*/
   }
//print_r($EndTime);
//print_r($Duration);

?>