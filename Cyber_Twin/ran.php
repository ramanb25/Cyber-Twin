

<head>
		
		
		
		
		
		
		
		
		
		
		
		
		

		<title>Today</title>
		
		
<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    	<meta name="msapplication-tap-highlight" content="no"/>
		<meta name="fragment" content="!">

<link rel="stylesheet" type="text/css" href="css/all.min.css">
		

		

		
	<style type="text/css"></style></head>



<div id="fullView" class="full-view show"><div class="widget txn full-size"><header>History</header>  <ul><div class="txn-date">February, 2016
</div> 
<?php
include('db.php');

$query="select * from job;";
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

							  	$query="select * from operator_unavailability;";

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

							  	$query="select * from production_stoppage;";

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


							  	$query="select * from lunch_tea;";

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




							  	$query="select * from machine_failure;";

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

							  	  	$query="select * from precautionary_check;";

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

							
?>
							      	<li class="transaction-unit" data-txn="FCVA160224326278835" data-status="success">
<div class="left"> <img src="icons/<?php echo $row[0];?>.png" width="35" height="35"> 

<h4 class="txn-header"> <?php echo $row[0]; ?></h4> 

<span class="txn-id">
		<?php $date = new DateTime($key); echo date_format($date, 'g:ia \o\n l jS F') ?>, 
		<?php 	
				if(strcmp($row[2],"NULL")):
				$date = new DateTime($row[2]); echo date_format($date, 'g:ia \o\n l jS F'); endif;
				if(!strcmp($row[2],"NULL")): echo "ONGOING" ; endif;
		?></span>
</div>


<?php  if(strcmp($row[0], "JOB")):   ?>
<div class="right"><h4 ><?php echo $row[4]; ?></h4> 
<?php
endif;//another class is failed
if(!strcmp($row[0], "JOB")):?>
<div class="right"><h4 ><?php echo $row[5]; ?></h4> 
<?php endif;

?>


<?php  if(strcmp($row[2], "NULL")):   ?>
<span class="success">COMPLETED</span></div>
<?php
endif;//another class is failed
if(!strcmp($row[2], "NULL")):?>
<span class="debited">ONGOING</span></div>
<?php endif;

?>

<div class="extra-details"><p class="prod-meta"></p><p class="prod-vendor"></p></div></li> 

<?php }
?>

  </ul>  </div></div>