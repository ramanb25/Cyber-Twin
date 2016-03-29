<?php
session_start();
 $operator=0;
if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype']))
{
    if (!$_SESSION['mytype']==$operator) {
        # code...
         echo "<script>window.location.assign('login.php')</script>";
    }
        
        //IS EVENT GOING ON
        $going_on=false;
        $start_time_is="";;
            include('db.php');
            
            $table="lunch_tea";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    //start_time_is is deprecated can remove it
                    $start_time_is="$rows[0]";
                    //echo $row[0];
                    //echo $start_time_is;
                  }
            }

            $table="job";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                    //echo $start_time_is; 
                  }
            }

            $table="production_stoppage";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                  }
            }

            $table="precautionary_check";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                  }
            }

            $table="machine_failure";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                  }
            }


            $table="pm";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                  }
            }

            $table="operator_unavailability";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                  }
            }


            $table="setup_change";
            $query="select * from `$table` where end_time='NULL' and username='".$_SESSION['mysesi']."'";
            //echo $query;
            $result=$db->query($query);
            $rows=mysqli_num_rows ($result);
            if($rows>0){
                $going_on=$table;
                while ($row = $result->fetch_row()) {
                    $start_time_is="$rows[0]";
                  }
            }


            echo $start_time_is;

            if(!isset($_POST["start"]))
            {
                $condition2=true;
                            }
            else 
                $condition2=false;
            //echo $going_on;
            //send to event   post event name

            ?>
            <form name='fr' action='index.php?started=1' method='POST'>
            <input type='hidden' name='event_name' value='<?php echo $going_on ;?>'>
            <input type='hidden' name='start' value='1'>
            </form>
            <script type='text/javascript'>
            var condition="<?php echo $going_on ?>";
            var condition2= "<?php echo $condition2; ?>";
            if(condition!=false && condition2)
            document.fr.submit();
            </script>

<?php
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


        $database = new Buttons();
        //$database->connect();
        //$query="select * from cart";
        if(isset($_POST["lvl"]))
          $lvl=$_POST["lvl"];
        else
          $lvl=NULL;
        $event_name="";
        //echo $lvl;
        //echo $going_on;
        if(($temp=$database->get_buttons($lvl)) && !$going_on)
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
              <input type="image" src="/Cyber_Twin/icons/<?php echo $value[0]; ?>.png" alt="Submit" width="150" height="150" value="<?php echo $value[0];?>">
              <h3><?php echo $value[1];?></h3>
              </form>
              </div>
              <?php
            }
                ?></div></div><?php

          }
        if((!$temp && !$going_on)  || isset($_POST["start"])   ) :
         // echo "d";

        $event_name=$_POST["event_name"];

        ?>


            
<div class="centered text-center col-centered">
             <?php if($event_name=="production_stoppage"): ?>

                      <div id="production_stoppage" >
                                   <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
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
                                 <br>
                                  <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="production_stoppage-button">
                                  <p>Duration : <span id = "production_stoppage-duration">00:00:00</span></p>
                                <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                                </form>
                        </div>
                            


            <?php  endif; ?>


         <?php if($event_name=="operator_unavailability"): ?>


             <div id="operator_unavailability" class="tab-pane">
              <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
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





                   <br>
                   <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="operator_unavailability-button" >
                    <p>Duration : <span id = "operator_unavailability-duration">00:00:00</span></p>
                    <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                  </form>
                    </div>

                        <?php  endif; ?>

             <?php if($event_name=="job"): ?>

                      <div id="job" class="tab-pane">
                       <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
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
                  <br>

                     <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="job-button" >
                      <p>Duration : <span id = "job-duration">00:00:00</span></p>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                 </form>
              </div>


            <?php  endif; ?>

            
            <?php if($event_name=="precautionary_check"):
             ?>
             <div id="precautionary_check" class="tab-pane">
              <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Precautionary Check</h3>
                      <form class="form" id="precautionary_check-form">
                       <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                     <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="precautionary_check-button" >
                      <p>Duration : <span id = "precautionary_check-duration">00:00:00</span></p>
                     
                        </form>
                    </div>


            <?php  endif; ?>

            <?php if($event_name=="machine_failure"): ?>

                     <div id="machine_failure" class="tab-pane">
                      <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
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
                  <br>
                    <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="machine_failure-button" >
                     <p>Duration : <span id = "machine_failure-duration">00:00:00</span></p>
                     <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
              </form>
                </div>


            <?php  endif; ?>



            <?php if($event_name=="lunch_tea"): ?>


            <div id="lunch_tea" class="tab-pane">
             <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Lunch/Tea</h3>
                      <form class="form" id="lunch_tea-form">
                      
                        <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                       

                      <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="lunch_tea-button">
                      <p>Duration : <span id = "lunch_tea-duration">00:00:00</span></p>
                      </form>
                    </div>
                    <div id="precautionary_check" class="tab-pane fade">
                     <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Precautionary Check</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                      <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="precautionary_check-button" >
                      <p>Duration : <span id = "precautionary_check-duration">00:00:00</span></p>
                    </div>
                    <div id="pm" class="tab-pane fade">
                     <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Preventive Maintenance</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                    <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="pm-button" >
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
                       <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="setup_change-button" >
                       <p>Duration : <span id = "setup_change-duration">00:00:00</span></p>
                       <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
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