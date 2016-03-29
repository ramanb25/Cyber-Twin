<?php

function is_Manager_Logged_In(){
	
	session_start();
	$manager=1;
	if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype']))
	{
	    if (!$_SESSION['mytype']==$manager) {
	        # code...
	         echo "<script>window.location.assign('login.php')</script>";
	    }
	 
	}
	else
	     echo "<script>window.location.assign('login.php')</script>";
}

function ongoing_jobs(){

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
											  $items[$row[0]]=$row =  array_merge( array( 0 => 'JOB' ),(array)$row );
											   //  echo "JOB GOING ON \n";
											      //echo "<br>";
											  //    echo $row[4];
											    //  echo "\nstarted on ".$row[0];
											      //echo "<br>";

											  	}

											  	$query="select * from operator_unavailability where end_time ='NULL';";

											    $result=$db->query($query);
											    //echo $query;
											  //  $items= array();
											    $count=0;
											      while ($row = $result->fetch_row()) {
											      $count++;
											  $items[$row[0]]=$row=  array_merge( array( 0 => 'OPERATOR UNAVAILABLE' ),(array)$row );
											   //   echo "JOB GOING ON \n";
											      //echo "<br>";
											  //    echo $row[4];
											    //  echo "\nstarted on ".$row[0];
											      //echo "<br>";

											  	}

											  	$query="select * from production_stoppage where end_time ='NULL';";

											    $result=$db->query($query);
											    //echo $query;
											  //  $items= array();
											    $count=0;
											      while ($row = $result->fetch_row()) {
											      $count++;
											  $items[$row[0]]=$row=  array_merge( array( 0 => 'PRODUCTION STOPPAGE' ),(array)$row );
											   //   echo "JOB GOING ON \n";
											      //echo "<br>";
											  //    echo $row[4];
											    //  echo "\nstarted on ".$row[0];
											      //echo "<br>";

											  	}


											  	$query="select * from lunch_tea where end_time = 'NULL';";

											    $result=$db->query($query);
											    //echo $query;
											   // $items= array();
											    $count=0;
											      while ($row = $result->fetch_row()) {
											      $count++;
											  $items[$row[0]]=$row=  array_merge( array( 0 => 'LUNCHTEA' ),(array)$row );
											   //   echo "JOB GOING ON \n";
											      //echo "<br>";
											  //    echo $row[4];
											    //  echo "\nstarted on ".$row[0];
											      //echo "<br>";


											  	}




											  	$query="select * from machine_failure where end_time ='NULL';";

											    $result=$db->query($query);
											    //echo $query;
											    //$items= array();
											    $count=0;
											      while ($row = $result->fetch_row()) {
											      $count++;
											  $items[$row[0]]=$row=  array_merge( array( 0 => 'MACHINE FAILURE' ),(array)$row );
											   //   echo "JOB GOING ON \n";
											      //echo "<br>";
											  //    echo $row[4];
											    //  echo "\nstarted on ".$row[0];
											      //echo "<br>";


											  	}

											  	  	$query="select * from precautionary_check where end_time ='NULL';";

											    $result=$db->query($query);
											    //echo $query;
											    //$items= array();
											    $count=0;
											      while ($row = $result->fetch_row()) {
											      $count++;
											  $items[$row[0]]=$row=  array_merge( array( 0 => 'PRECAUTIONARY CHECK' ),(array)$row );
											   //   echo "JOB GOING ON \n";
											      //echo "<br>";
											  //    echo $row[4];
											    //  echo "\nstarted on ".$row[0];
											      //echo "<br>";


											  	}

				krsort($items);
				foreach ($items as $key => $row) {
					if(!strcmp($row[2],"NULL")):
									 ?><div class="col-sm-4 col-lg-4 col-md-4 img-hover">
								      <form  method="GET" action="ran.php">
								      <input type="hidden" value="timeline" name="timeline"></input>
								      <input type="image" src="icons/<?php echo $row[0];?>.png" alt="Submit" width="150" height="150" value="value">
								      <h4><?php echo "ONGOING";?></h4>
								      </form>
								      </div>
																	

				<?php endif;}
				?>

				 <?php
}





?>