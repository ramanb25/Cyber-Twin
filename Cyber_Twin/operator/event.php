<?php
session_start();
  include('class_operator.php');
  $operator= new Operator();
  $operator->is_operator_login();
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
                                  <p id="duration"> <span id = "production_stoppage-duration">Duration: 00:00:00</span></p>
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
                    <p id="duration"> <span id = "operator_unavailability-duration">Duration: 00:00:00</span></p>
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
                      <p id="duration"> <span id = "job-duration">Duration: 00:00:00</span></p>
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
                      <p id="duration"> <span id = "precautionary_check-duration">Duration: 00:00:00</span></p>
                     
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
                     <p id="duration"> <span id = "machine_failure-duration">Duration: 00:00:00</span></p>
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
                      <p id="duration"> <span id = "lunch_tea-duration">Duration: 00:00:00</span></p>
                      </form>
                    </div>
                    <div id="precautionary_check" class="tab-pane fade">
                     <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Precautionary Check</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                      <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="precautionary_check-button" >
                      <p id="duration"> <span id = "precautionary_check-duration">Duration: 00:00:00</span></p>
                    </div>
                    <div id="pm" class="tab-pane fade">
                     <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Preventive Maintenance</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                    <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="pm-button" >
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
                       <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="setup_change-button" >
                       <p id="duration"> <span id = "setup_change-duration">Duration: 00:00:00</span></p>
                       <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                </form>
                  </div>
<div>
              <?php endif; ?>




              <?php if($event_name=="pm"): ?>
               <div id="pm" class="tab-pane fade">
                     <img src="/Cyber_Twin/icons/<?php echo $event_name; ?>.png" width="100" height="100">
                      <h3>Preventive Maintenance</h3>
                      <input type="hidden" name="Name" value="<?php echo $_SESSION['mysesi']; ?>">
                    <img src="/Cyber_Twin/icons/start.png" width="100" height="100" id ="pm-button" >
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