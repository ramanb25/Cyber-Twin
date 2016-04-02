<?php
		
		include 'class_manager.php';
		$manager= new Manager();
		if(isset($_GET['event'])){
				include('navbar.php');
				$event=$_GET['event'];
		        $manager->show($event);
		}

		 
		 	//foreach ($_GET as $key=>$value) {
    		//	echo $key;
    		//	echo "<br>";
    			//echo $value;

		 	//$data=$_GET['data'];
		if(isset($_POST['data']))
		 	$manager->view_predictions($_POST['data']);		 	
		 //}
		 //print_r($_GET);


?>