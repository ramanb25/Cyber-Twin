<?php
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

?>
<!DOCTYPE html>
<html>
<head>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cyber Twin</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="js/app.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  

    <!-- Custom CSS -->
      <link href="css/app.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/heroic-features.css" rel="stylesheet">
<body>

 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="graph.php">Cyber Twin</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  
                </ul>
                <form name="logout" action="logout.php" class="navbar-form navbar-right"  method="post">
                        <button type="submit" class="btn btn-primary">Logout</button>
                   </form>




            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



<p id="demo"></p>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="chart_div"></div>
      

 <div id="visualization" width="15000" height="15000"></div>
 <div id="visualizatio2" width="15000" height="15000"></div>
        <?php
        if(!isset($_POST['timeline']) && !isset($_POST['past_data'])){
				?>
				        <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
				      <form  method="POST" action="graph.php">
				      <input type="hidden" value="timeline" name="timeline"></input>
				      <input type="image" src="/Cyber_Twin/icons/1.png" alt="Submit" width="150" height="150" value="<?php echo $value;?>">
				      <h4><?php echo "Timeline";?></h4>
				      </form>
				      </div>
				     <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
				      <form  method="POST" action="graph.php">
				      <input type="hidden" value="past_data" name="past_data"></input>
				      <input type="image"  src="/Cyber_Twin/icons/1.png" alt="Submit" width="150" height="150" value="<?php echo "hi";?>">
				      <h4><?php echo "Past Data";?></h4>
				      </form>
				      </div>
				      <?php
 		 }

      if(isset($_POST['timeline'])){
       // include 'chart.php';
        //$table='job';

         require_once('Database.php');
        require_once('class_button.php');
        include 'chart.php';

        if(!isset($_POST["event_name"])){
        $database = new Buttons();
         if($temp=$database->get_buttons(NULL))
          {
                ?><div class="container">
                <div class="centered text-center col-centered">
                <br>
                <br>
                <br><?php
            foreach ($temp as $key => $value) {
              # code...
              //echo $value;
              ?>

          <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
              <form  method="POST" action="graph.php">
              <input type="hidden" class="btn btn-info" name="lvl" value="<?php echo $key;?>">
              <input type="hidden" class="btn btn-info" name="event_name" value="<?php echo $value[0];?>">
              <input type="hidden" class="btn btn-info" name="timeline" value="<?php echo $value[0];?>">
              <input type="image" src="/Cyber_Twin/icons/<?php echo $key; ?>.png" alt="Submit" width="150" height="150" value="<?php echo $value[0];?>">
              <h3><?php echo $value[1];?></h3>
              </form>
              </div>
              <?php
            }
                ?></div></div><?php

          }
      }
      else{
        $graph= new chart();
        $graph->show($_POST["event_name"],"MONTH",1);}

      }



       if(isset($_POST['past_data'])){
        include 'chart.php';
        $table='job';

        $graph= new chart();
        $graph->show($table,"MONTH",0);}



      
?>



</body>
</html>