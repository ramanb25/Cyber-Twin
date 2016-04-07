
<!DOCTYPE html>
<html>
  <head>
    <!--Load the AJAX API-->
   
      <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

<?php
		include 'navbar.php';
		include 'class_manager.php';
		$manager= new Manager();
		$manager->is_manager_logged_in();
		if(isset($_GET['event'])){
				
				$event=$_GET['event'];
		        $manager->show($event);
		}

		 
		 	//foreach ($_GET as $key=>$value) {
    		//	echo $key;
    		//	echo "<br>";
    			//echo $value;

		 	//$data=$_GET['data'];
		else if(isset($_POST['data'])){
			//echo htmlentities( $_POST['data']);
			$xml = simplexml_load_string($_POST['data']);

//print_r($xml);

$comp_FC21=array();
$comp_FC11=array();

//echo $xml->comp_FC2;
$i=0;
  foreach($xml->comp_FC2 as $value) {
  // echo $value;
   $i++;
   array_push($comp_FC21,$value[0]);
    }

     foreach($xml->comp_FC1 as $value) {
  // echo $value;
   $i++;
   array_push($comp_FC11,$value[0]);
    }



    $comp_FC33=array();

//echo $xml->comp_FC2;
$i=0;
  foreach($xml->comp_FC3 as $value) {
  // echo $value;
   $i++;
   array_push($comp_FC33,$value[0]);
    }
foreach ($comp_FC21 as $key => $value) {
	# code...
	//echo $value;
}
//echo json_encode($comp_FC21);
$i=0;
    //echo $comp_FC21;
  			?>


 
<div id="chart_div"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>     
          <script type="text/javascript">

           
             

             google.charts.load('current', {packages: ['corechart', 'bar']});
          google.charts.setOnLoadCallback(drawRightY);

          function drawRightY() {
                var data = google.visualization.arrayToDataTable([
                    ['Month', 'comp_FC1'],
                    <?php foreach ($comp_FC21 as $key => $value)  { $i++;?>
                    [
                     '<?php echo $i; ?>', 
                      <?php echo $value; ?>],
                      
                      <?php  } ?>
                    
                ]);

                var options = {
                  chart: {
                    title: 'Failed Unit Monthwise',
                    subtitle: 'Based on previous data'
                  },
                  hAxis: {
                    title: 'failed times',
                    minValue: 0,
                  },
                  vAxis: {
                    title: 'Month'
                  },
                  bars: 'horizontal',
                  axes: {
                    y: {
                      0: {side: 'right'}
                    }
                  }
                };
                var material = new google.charts.Bar(document.getElementById('chart_div'));
                material.draw(data, options);
                drawRightY2();
              }





              					
           
             

           

          function drawRightY2() {
                var data = google.visualization.arrayToDataTable([
                    ['Month', 'comp_FC2'],
                    <?php $i=0; foreach ($comp_FC11 as $key => $value)  { $i++;?>
                    [
                     '<?php echo $i; ?>', 
                      <?php echo $value; ?>],
                      
                      <?php  } ?>
                    
                ]);

                var options = {
                  chart: {
                    title: 'comp_FC',
                    subtitle: 'Based on previous data'
                  },
                  hAxis: {
                    title: 'failed times',
                    minValue: 0,
                  },
                  vAxis: {
                    title: 'Month'
                  },
                  bars: 'horizontal',
                  axes: {
                    y: {
                      0: {side: 'right'}
                    }
                  }
                };
                var material = new google.charts.Bar(document.getElementById('chart_div2'));
                material.draw(data, options);
                drawRightY3();
              }



                function drawRightY3() {
                var data = google.visualization.arrayToDataTable([
                    ['Month', 'comp_FC3'],
                    <?php $i=0; foreach ($comp_FC33 as $key => $value)  { $i++;?>
                    [
                     '<?php echo $i; ?>', 
                      <?php echo $value; ?>],
                      
                      <?php  } ?>
                    
                ]);

                var options = {
                  chart: {
                    title: 'Failed Unit Monthwise',
                    subtitle: 'Based on previous data'
                  },
                  hAxis: {
                    title: 'failed times',
                    minValue: 0,
                  },
                  vAxis: {
                    title: 'Month'
                  },
                  bars: 'horizontal',
                  axes: {
                    y: {
                      0: {side: 'right'}
                    }
                  }
                };
                var material = new google.charts.Bar(document.getElementById('chart_div3'));
                material.draw(data, options);
              }


           

          </script>


















           

          </script>











  			<?php
}
		 	//$manager->view_predictions($_POST['data']);		 	
		 //}
		 //print_r($_GET);


?>