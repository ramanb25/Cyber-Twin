<?php

/**
* 
*/
class Operator
{
	
	//public $buttons=array();
		


		public function get_events($under){
			if(is_null($under)){
				$query="select id,name,show_name from buttons where under is NULL";
				//echo $query;
				//statement($query);
				include('db.php');
				if($fetch=$db->query($query)) {
						$temp = array();
						 while ($row = $fetch->fetch_row()) {
	        				 $temp[$row[0]]=array($row[1],$row[2]);
	        				 //echo $row[0];
	        				 //echo "as";
	    				}
	    			//print_r($temp);
	    			//$this->buttons=$temp;
	    				return $temp;
				}
				return false;
			}else{
				$query="select id,name,show_name from buttons where under = $under";
				//echo $query;
				//statement($query);
				include('db.php');
				if($fetch=$db->query($query)) {
						$temp = array();
						 while ($row = $fetch->fetch_row()) {
	        				 $temp[$row[0]]=array($row[1],$row[2]);
	        				 //echo $row[0];
	        				 //echo "as";
	    				}
	    			//print_r($temp);
	    			//$this->buttons=$temp;
	    				return $temp;
				}
				return false;	
			}
		}




	function is_operator_login()
	{
					 $operator=0;
			if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype']))
			{
			    if (!$_SESSION['mytype']==$operator) {
			        # code...
			         echo "<script>window.location.assign('../login.php')</script>";
			    }
			}
			else
			     echo "<script>window.location.assign('../login.php')</script>";
				}
	

	function ongoing_events(){
		include('db.php');
        $query="select * from job where end_time = 'NULL';";
        $items=array();
        $table=array();
        //array_push($table, 'JOB');
                          $result=$db->query($query);
                          //echo $query;
                         // $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                           // array_push( $row,"JOB")
                        $items[$row[0]]=$row =  array_merge( array( 0 => 'job' ),(array)$row );
                         //  echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";

                          }

                          $query="select * from operator_unavailability where end_time ='NULL' and username='".$_SESSION['mysesi']."';";

                          $result=$db->query($query);
                          //echo $query;
                        //  $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'operator_unavailability' ),(array)$row );
                         // =  echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";

                          }

                          $query="select * from production_stoppage where end_time ='NULL'  and username='".$_SESSION['mysesi']."';";

                          $result=$db->query($query);
                          //echo $query;
                        //  $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'production_stoppage' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";

                          }


                          $query="select * from lunch_tea where end_time = 'NULL' and username='".$_SESSION['mysesi']."';";

                          $result=$db->query($query);
                          //echo $query;
                         // $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'lunch_tea' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";


                          }




                          $query="select * from machine_failure where end_time ='NULL' and username='".$_SESSION['mysesi']."';";
                          $result=$db->query($query);
                          //echo $query;
                          //$items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'machine_failure' ),(array)$row );
                           // echo "JOB GOING ON \n";
                        //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";


                          }

                              $query="select * from precautionary_check where end_time ='NULL' and username='".$_SESSION['mysesi']."';";

                          $result=$db->query($query);
                          //echo $query;
                          //$items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'precautionary_check' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";


                          }

				        krsort($items);
				        return $items;
	}
	public function end_event($start_time,$table){
		include 'db.php';

		$timezone=new DateTimeZone("ASIA/KOLKATA");
		$now = new DateTime();
		$now->setTimezone($timezone );
		$end_time=$now->format('Y-m-d H:i:s');
		$user=$_SESSION['mysesi'];
		//TODO
		$duration=1;

		$sql = "UPDATE `$table` SET `end_time`='$end_time',`duration`='$duration' WHERE end_time='NULL' and start_time='$start_time' and username='$user'";
		$db->query($sql);

		$sql ="SELECT TIMESTAMPDIFF(SECOND,start_time,end_time) from `$table` where end_time='$end_time' and start_time='$start_time' and username='$user'";
		$result=$db->query($sql);
		while ($rows = $result->fetch_row()) {
		    $duration=$rows[0];
		}
		            
		$sql = "UPDATE `$table` SET `duration`='$duration' WHERE end_time='$end_time' and  start_time='$start_time' and username='$user'";
		$db->query($sql);
		return $sql;
	}


	public function start_event($table,$extra){
		include 'db.php' ;
		$duration=NULL;
        $timezone=new DateTimeZone("ASIA/KOLKATA");
        $now = new DateTime();
        $now->setTimezone($timezone );
        $start_time=$now->format('Y-m-d H:i:s');
        $end_time="NULL";

        switch($table)
        {
		  case "job":
            $var1 = $extra[0]['value'];
            $var2 = $extra[1]['value'];
            $var3 = $extra[2]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1', '$var2','$var3')";
            $db->query($sql);
            break;
          case "machine_failure":
            $var1 = $extra[0]['value'];
            $var2 = $extra[1]['value'];
            $var3 = $extra[2]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1', '$var2','$var3')";
            $db->query($sql);
            break;
          case "setup_change":
            $var1 = $extra[0]['value'];
            $var2 = $extra[1]['value'];
            $var3 = $extra[2]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1', '$var2','$var3')";
            $db->query($sql);
            break;
          case "production_stoppage":
            $var1 = $extra[0]['value'];
            $var12 = $extra[1]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$var1','$var12')";
            $db->query($sql);
            break;
          case "operator_unavailability":
            $cause = $extra[0]['value'];
            $var1 = $extra[1]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration', '$cause','$var1')";
            $db->query($sql);
            break;
          case "pm":
          case "precautionary_check":
            $var1 = $extra[0]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time','$duration','$var1')";
            $db->query($sql);
            break;
          case "lunch_tea":
            $var1 = $extra[0]['value'];
            $sql = "INSERT INTO `$table` VALUES ('$start_time', '$end_time', '$duration','$var1')";
            $db->query($sql);
            break;
        }
        return $start_time;
	}
}





