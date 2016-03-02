<?php
session_start();
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
?>
<html lang="en">



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cyber Twin</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="js/app.js"></script>
      <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  

    <!-- Custom CSS -->
      <link href="css/app.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
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
                <a class="navbar-brand" href="index.php">Cyber Twin</a>
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

       <?php
        require_once('Database.php');
        require_once('class_button.php');
        include 'chart.php';
        //echo "raman";

        $database = new Buttons();
        //echo "raman";
        //$database->connect();
        //$query="select * from cart";
        if(isset($_POST["lvl"]))
          $lvl=$_POST["lvl"];
        else
          $lvl=NULL;
        $event_name="";
        //echo $_POST["name"];
    //    echo $lvl;
        if($temp=$database->get_buttons($lvl))
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
              <form  method="POST" action="index.php">
              <input type="hidden" class="btn btn-info" name="lvl" value="<?php echo $key;?>">
              <input type="hidden" class="btn btn-info" name="event_name" value="<?php echo $value[0];?>">
              <input type="image" src="/Cyber_Twin/icons/<?php echo $key; ?>.png" alt="Submit" width="150" height="150" value="<?php echo $value[0];?>">
              <h3><?php echo $value[1];?></h3>
              </form>
              </div>
              <?php
            }
                ?></div></div><?php

          }
        if(!$temp&&isset($_POST["event_name"])) :
         // echo "d";

        $event_name=$_POST["event_name"];

        ?>


            
<div class="centered text-center col-centered">
             <?php if($event_name=="production_stoppage"): ?>

                      <div id="production_stoppage" >
                                  <h3>Production Stoppage</h3>
                                  <form class="form" id="production_stoppage-form">
                                  <h4>Cause</h4>
                                  <div class="btn-group" data-toggle="buttons">
                                         <label class="btn btn-default active">
                                             <input type="radio"  name="cause" value="Raw Material Unavailable" checked> Raw Material Unavailable
                                         </label>
                                         <label class="btn btn-default">
                                             <input type="radio"  name="cause" value="Tools Unavailable" > Tools Unavailable
                                         </label>
                                          <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Tool Inspection"> Tool Inspection
                                      </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Tool Change" > Tool Change
                                     </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Coolant Refilling" > Coolant Refilling
                                     </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Air Failure" > Air Failure
                                     </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="No Demand" > No Demand
                                     </label>
                                 </div>
                                  <button type="button" id ="production_stoppage-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                                  <p>Duration : <span id = "production_stoppage-duration">00:00:00</span></p>
                                </form>
                        </div>
                            


            <?php  endif; ?>


         <?php if($event_name=="operator_unavailability"): ?>


             <div id="operator_unavailability" class="tab-pane">
                    <h3>Operator Unavailability</h3>
                    <form class="form" id="operator_unavailability-form">
                    <h4>Cause</h4>
                    <div class="btn-group" data-toggle="buttons">
                       <label class="btn btn-default active">
                           <input type="radio"  name="cause" value="Busy with other machine" checked> Busy with other machine
                       </label>
                       <label class="btn btn-default">
                           <input type="radio"  name="cause" value="Busy with official work" > Busy with official work
                       </label>
                        <label class="btn btn-default">
                       <input type="radio"  name="cause" value="Personal needs"> Personal needs
                    </label>
                   </div>






                    <button type="button" id ="operator_unavailability-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                    <p>Duration : <span id = "operator_unavailability-duration">00:00:00</span></p>
                  </form>
                    </div>

                        <?php  endif; ?>

             <?php if($event_name=="job"): ?>

                      <div id="job" class="tab-pane">
                  <h3>Job</h3>
                    <form class="form" id="job-form">
                    <h4>Select Job Type</h4>
                    <div class="btn-group" data-toggle="buttons">
                       <label class="btn btn-default active">
                           <input type="radio" id="jt1" name="job_type" value="Normal" checked> Normal
                       </label>
                       <label class="btn btn-default">
                           <input type="radio" id="jt2" name="job_type" value="Rework" > Rework
                       </label>
                   </div>
                   <h4>Select Component</h4>
                   <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-default active">
                          <input type="radio" id="c1" name="component" value="GMI Cam Shaft" checked> GMI Cam Shaft
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" id="c2" name="component" value="NALT Main Shaft" > NALT Main Shaft
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" id="c3" name="component" value="GMI Main Shaft" > GMI Main Shaft
                      </label>
                  </div>
                     <button type="button" id ="job-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                      <p>Duration : <span id = "job-duration">00:00:00</span></p>
                 </form>
              </div>


            <?php  endif; ?>

            
            <?php if($event_name=="precautionary_check"):
             ?>
             <div id="precautionary_check" class="tab-pane">
                      <h3>Precautionary Check</h3>
                      <button type="button" id ="precautionary_check-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                      <p>Duration : <span id = "precautionary_check-duration">00:00:00</span></p>
                    </div>


            <?php  endif; ?>

            <?php if($event_name=="machine_failure"): ?>

                     <div id="machine_failure" class="tab-pane">
                    <h3>Machine Failure</h3>
                    <form class="form" id="machine_failure-form">
                    <h4>Failed Unit</h4>
                    <div class="btn-group" data-toggle="buttons">
                       <label class="btn btn-default active">
                           <input type="radio"  name="failed_unit" value="Drilling Unit" checked> Drilling Unit
                       </label>
                       <label class="btn btn-default">
                           <input type="radio"  name="failed_unit" value="Milling Unit" > Milling Unit
                       </label>
                        <label class="btn btn-default">
                       <input type="radio"  name="failed_unit" value="Clamping Unit"> Clamping Unit
                    </label>
                   <label class="btn btn-default">
                       <input type="radio"  name="failed_unit" value="Feed Unit" > Feed Unit
                   </label>
                   <label class="btn btn-default">
                       <input type="radio"  name="failed_unit" value="Power Unit" > Power Unit
                   </label>
                   </div>
                   <h4>Mode of failure</h4>
                   <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-default active">
                          <input type="radio" name="failure_mode" value="1" checked> 1
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" name="failure_mode" value="2" > 2
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" name="failure_mode" value="3" > 3
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" name="failure_mode" value="4" > 4
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" name="failure_mode" value="5" > 5
                      </label>
                  </div>
                     <button type="button" id ="machine_failure-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                     <p>Duration : <span id = "machine_failure-duration">00:00:00</span></p>
              </form>
                </div>


            <?php  endif; ?>



            <?php if($event_name=="lunch_tea"): ?>


            <div id="lunch_tea" class="tab-pane">
                      <h3>Lunch/Tea</h3>
                      <button type="button" id ="lunch_tea-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                      <p>Duration : <span id = "lunch_tea-duration">00:00:00</span></p>
                    </div>
                    <div id="precautionary_check" class="tab-pane fade">
                      <h3>Precautionary Check</h3>
                      <button type="button" id ="precautionary_check-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                      <p>Duration : <span id = "precautionary_check-duration">00:00:00</span></p>
                    </div>
                    <div id="pm" class="tab-pane fade">
                      <h3>Preventive Maintenance</h3>
                    <button type="button" id ="pm-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                    <p>Duration : <span id = "pm-duration">00:00:00</span></p>
                    </div>
                    <div id="setup_change" class="tab-pane fade">
                      <h3>Setup Change</h3>
                      <form class="form" id="machine_failure-form">
                      <h4>Old Setup</h4>
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name="old_setup" value="GMI Cam Shaft" checked> GMI Cam Shaft
                        </label>
                        <label class="btn btn-default">
                            <input type="radio"  name="old_setup" value="NALT Main Shaft" > NALT Main Shaft
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="old_setup" value="GMI Main Shaft" > GMI Main Shaft
                        </label>
                     </div>
                     <h4>New Setup</h4>
                     <div class="btn-group" data-toggle="buttons">
                       <label class="btn btn-default active">
                           <input type="radio"  name="new_setup" value="GMI Cam Shaft" checked> GMI Cam Shaft
                       </label>
                       <label class="btn btn-default">
                           <input type="radio"  name="new_setup" value="NALT Main Shaft" > NALT Main Shaft
                       </label>
                       <label class="btn btn-default">
                           <input type="radio"  name="new_setup" value="GMI Main Shaft" > GMI Main Shaft
                       </label>
                    </div>
                       <button type="button" id ="setup_change-button" class="btn btn-primary btn-lg center-block">Start Event</button>
                       <p>Duration : <span id = "setup_change-duration">00:00:00</span></p>
                </form>
                  </div>
<div>
              <?php endif; ?>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
           <?php
        endif;

        ?>

    </div>

</body>

</html>