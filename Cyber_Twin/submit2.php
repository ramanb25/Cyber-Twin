<?php
session_start();

include 'db.php';

 $operator=0;
if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype']))
{
    if (!$_SESSION['mytype']==$operator) {
        # code...
         echo "<script>window.location.assign('login.php')</script>";
    }
}
else
     echo "<script>window.location.assign('login.php')</script>";
//echo $_SESSION['mytype'];
 //$sql = "INSERT INTO '$table' VALUES ('$start_time', '$end_time', '$duration')";
   // $db->query($sql);
$table = $_POST['table'];
//$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$duration = $_POST['duration'];
 if($end_time==="NULL")
    $end_time="NULL";
  else {
    $timezone=new DateTimeZone("ASIA/KOLKATA");
        $now = new DateTime();
        $now->setTimezone($timezone );
    $end_time=$now->format('Y-m-d H:i:s');
  }
$user=$_SESSION['mysesi'];

//TODO
$duration=1;

    $sql = "UPDATE `$table` SET `end_time`='$end_time',`duration`='$duration' WHERE end_time='NULL' and username='$user'";
    $db->query($sql);

    $sql ="SELECT TIMESTAMPDIFF(SECOND,start_time,end_time) from `$table` where end_time='$end_time' and username='$user'";
   // echo $sql;
    $result=$db->query($sql);
                while ($rows = $result->fetch_row()) {
                    $duration=$rows[0];
                    //echo $rows[0];
                    //echo $start_time_is;
                  }
            
    $sql = "UPDATE `$table` SET `duration`='$duration' WHERE end_time='$end_time' and username='$user'";
    $db->query($sql);
          
echo json_encode($sql);
?>
