<?php

/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */



include('db.php');
$result = $db->query('SELECT end_time,duration FROM pm');

function hours($time) {
    return $time/3600;
}
$EndTime3 = array();
$Duration3 = array();
while ($row = $result->fetch_row()){
    array_push($EndTime3, $row[0]);
    array_push($Duration3, hours($row[1]));
    /*$data[$i]['end_time']= $row['end_time'];
   $data[$i]['duration']= minutes($row['duration']);
*/
   }
//print_r($EndTime3);
//print_r($Duration3);

?>