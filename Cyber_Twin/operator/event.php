<script src="../js/jquery-1.12.2.js"></script><?php
session_start();
  include('class_operator.php');
  $operator= new Operator();
  $operator->is_operator_login();
  if(!isset($_POST["event_name"])):
  $going_on=0;
      $items=$operator->ongoing_events();
        foreach ($items as $key => $row) {
          $going_on=1;
          if(!strcmp($row[2],"NULL")):?>
                      
                     
                      <form name='fr' method="POST" action="event.php?started=1&starttime=<?php echo $key;?>">
                      <input type="hidden" value="<?php echo $row[0];?>" name="event_name"></input>
                      </form>
                     

          <?php endif;}

          ?>


    <script src="../js/app.js"></script>

            <script type='text/javascript'>
            var condition=<?php echo $going_on ?>;
            if(condition)
            document.fr.submit();
            </script>

          <?php endif;
//echo $_SESSION['mytype'];
        include('navbar.php');
        //require_once('Database.php');
       // require_once('class_button.php');
      //  include 'chart.php';


       

    //  if((!$temp && !$going_on)  || isset($_POST["start"])   ) :
         // echo "d";
        if(isset($_GET["event_name"]))
          $_POST["event_name"]=$_GET["event_name"];

        $event_name=$_POST["event_name"];

        ?>


            
<div class="centered text-center col-centered">
             <?php if($event_name=="production_stoppage"): ?>

                      <div id="production_stoppage" >
                                   <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                                  <h3>Production Stoppage</h3>
                                  <form class="form" id="production_stoppage-form">
                                  <h4>Cause</h4>
                                  <div class="btn-group" data-toggle="buttons">
                                         <label class="btn btn-default active">
                                             <input type="radio"  name="cause" value="Raw Material Unavailable" checked> <img src="../icons/Raw Material Unavailable.jpg" width="200" height="50">
                                         </label>
                                         <label class="btn btn-default">
                                             <input type="radio"  name="cause" value="Tools Unavailable" > <img src="../icons/Tools Unavailable.jpg" width="200" height="50">
                                         </label>
                                          <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Tool Inspection"> <img src="../icons/Tool Inspection.jpg" width="200" height="50">
                                      </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Tool Change" ><img src="../icons/Tool Change.jpg" width="200" height="50">
                                     </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Coolant Refilling" > <img src="../icons/Coolant Refilling.jpg" width="200" height="50">
                                     </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="Air Failure" > <img src="../icons/Air Failure.jpg" width="200" height="50">
                                     </label>
                                     <label class="btn btn-default">
                                         <input type="radio"  name="cause" value="No Demand" > <img src="../icons/No Demand.jpg" width="200" height="50">
                                     </label>
                                 </div>
                                 <br>
                                  <img src="../icons/start.png" width="300" height="300" id ="production_stoppage-button">
                                  <p id="duration"> <span id = "production_stoppage-duration">Duration: 00:00:00</span></p>
                                <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                                </form>
                        </div>
                            


            <?php  endif; ?>


         <?php if($event_name=="operator_unavailability"): ?>


             <div id="operator_unavailability" class="tab-pane">
              <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                    <h3>Operator Unavailability</h3>
                    <form class="form" id="operator_unavailability-form">
                    <h4>Cause</h4>
                    <div class="btn-group" data-toggle="buttons" >
                       <label class="btn btn-default active">
                           <input type="radio"  name="cause" value="Busy with other machine"  checked> <img src="../icons/Busy with other machine.jpg" width="200" height="50">
                       </label>
                       <label class="btn btn-default">
                           <input type="radio"  name="cause" value="Busy with official work" ><img src="../icons/Busy with official work.jpg" width="200" height="50">
                       </label>
                        <label class="btn btn-default">
                       <input type="radio"  name="cause" value="Personal needs"><img src="../icons/Personal needs.jpg" width="200" height="50">
                    </label>
                   </div>





                   <br>
                   <img src="../icons/start.png" width="300" height="300" id ="operator_unavailability-button" >
                    <p id="duration"> <span id = "operator_unavailability-duration">Duration: 00:00:00</span></p>
                    <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                  </form>
                    </div>

                        <?php  endif; ?>

             <?php if($event_name=="job"): ?>

                      <div id="job" class="tab-pane">
                       <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
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
                          <input type="radio" id="c1" name="component" value="GMI Cam Shaft" checked> <img src="../icons/GMI Cam Shaft.jpg" width="200" height="50">
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" id="c2" name="component" value="NALT Main Shaft" ><img src="../icons/NALT Main Shaft.jpg" width="200" height="50">
                      </label>
                      <label class="btn btn-default">
                          <input type="radio" id="c3" name="component" value="GMI Main Shaft" > <img src="../icons/GMI Main Shaft.jpg" width="200" height="50">
                      </label>
                  </div>
                  <br>

                     <img src="../icons/start.png" width="300" height="300" id ="job-button" >
                      <p id="duration"> <span id = "job-duration">Duration: 00:00:00</span></p>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                 </form>
              </div>


            <?php  endif; ?>

            
            <?php if($event_name=="precautionary_check"):
             ?>
             <div id="precautionary_check" class="tab-pane">
              <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                      <h3>Precautionary Check</h3>
                      <form class="form" id="precautionary_check-form">
                       <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                     <img src="../icons/start.png" width="300" height="300" id ="precautionary_check-button" >
                      <p id="duration"> <span id = "precautionary_check-duration">Duration: 00:00:00</span></p>
                     
                        </form>
                    </div>


            <?php  endif; ?>

            <?php if($event_name=="machine_failure"): ?>

                     <div id="machine_failure" class="tab-pane">
                      <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                    <h3>Machine Failure</h3>
                    <form class="form" id="machine_failure-form">
                    <h4>Failed Unit</h4>
                    <div class="btn-group" data-toggle="buttons">
                       <label class="btn btn-default active">
                           <input type="radio"  name="failed_unit" value="Drilling Unit" checked><img src="../icons/Drilling Unit.jpg" width="200" height="50">
                       </label>
                       <label class="btn btn-default">
                           <input type="radio"  name="failed_unit" value="Milling Unit" > <img src="../icons/Milling Unit.jpg" width="200" height="50">
                       </label>
                        <label class="btn btn-default">
                       <input type="radio"  name="failed_unit" value="Clamping Unit"> <img src="../icons/Clamping Unit.jpg" width="200" height="50">
                    </label>
                   <label class="btn btn-default">
                       <input type="radio"  name="failed_unit" value="Feed Unit" > <img src="../icons/Feed Unit.jpg" width="200" height="50">
                   </label>
                   <label class="btn btn-default">
                       <input type="radio"  name="failed_unit" value="Power Unit" > <img src="../icons/Power Unit.jpg" width="200" height="50">
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
                    <img src="../icons/start.png" width="300" height="300" id ="machine_failure-button" >
                     <p id="duration"> <span id = "machine_failure-duration">Duration: 00:00:00</span></p>
                     <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
              </form>
                </div>


            <?php  endif; ?>



            <?php if($event_name=="lunch_tea"): ?>


            <div id="lunch_tea" class="tab-pane">
             <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                      <h3>Lunch/Tea</h3>
                      <form class="form" id="lunch_tea-form">
                      
                        <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                       

                      <img src="../icons/start.png" width="300" height="300" id ="lunch_tea-button">
                      <p id="duration"> <span id = "lunch_tea-duration">Duration: 00:00:00</span></p>
                      </form>
                    </div>
                    <div id="precautionary_check" class="tab-pane fade">
                     <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                      <h3>Precautionary Check</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                      <img src="../icons/start.png" width="300" height="300" id ="precautionary_check-button" >
                      <p id="duration"> <span id = "precautionary_check-duration">Duration: 00:00:00</span></p>
                    </div>
                    <div id="pm" class="tab-pane fade">
                     <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                      <h3>Preventive Maintenance</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                    <img src="../icons/start.png" width="300" height="300" id ="pm-button" >
                    <p id="duration"> <span id = "pm-duration">Duration: 00:00:00</span></p>
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
                       <img src="../icons/start.png" width="300" height="300" id ="setup_change-button" >
                       <p id="duration"> <span id = "setup_change-duration">Duration: 00:00:00</span></p>
                       <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                </form>
                  </div>
<div>
              <?php endif; ?>




              <?php if($event_name=="pm"): ?>
               <div id="pm" class="tab-pane fade">
                     <img src="../icons/<?php echo $event_name; ?>.png" width="300" height="300">
                      <h3>Preventive Maintenance</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                    <img src="../icons/start.png" width="300" height="300" id ="pm-button" >
                    <p id="duration"> <span id = "pm-duration">Duration: 00:00:00</span></p>
                    </div>
                  <?php endif; ?>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
           <?php
      //  endif;

        ?>

    </div>

</body>

</html>