<?php
    include('db.php');
    include('navbar.php');
    include 'class_manager.php';
    $manager= new Manager();
    $manager->is_Manager_Logged_In();
?>

<div class="container">
              <div class="centered text-center col-centered">
                  <?php
                     // include('../db.php');
                      $manager->ongoing_jobs();
                  ?>      
                    <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                    
                    <form  method="POST" action="timeline.php">
                    <input type="hidden" value="timeline" name="timeline"></input>
                    <input type="image" src="../icons/1.png" alt="Submit" width="150" height="150" value="<?php echo "hi";?>">
                    <h4><?php echo "Timeline";?></h4>
                    </form>

                    </div>
                    
                    <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                    <form  method="GET" action="Plot.php">
                    <input type="hidden" name="event" value="PastFailurePlot"></input>
                    <input type="image"  src="../icons/1.png" alt="Submit" width="150" height="150" value="<?php echo "hi";?>">
                    <h4><?php echo "Past Failure Data";?></h4>
                    </form>
                    </div>

                    
                    <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                    <form  method="GET" action="Plot.php">
                    <input type="hidden" name="event" value="ran"></input>
                    <input type="image"  src="../icons/1.png" alt="Submit" width="150" height="150" value="<?php echo "hi";?>">
                    <h4><?php echo "Timeline All events";?></h4>
                    </form>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                    <form  method="GET" action="Plot.php">
                    <input type="hidden" name="event" value="LunchTeaPlot"></input>
                    <input type="image"  src="../icons/1.png" alt="Submit" width="150" height="150" value="<?php echo "hi";?>">
                    <h4><?php echo "Line Plots";?></h4>
                    </form>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                    <form  method="GET" action="Simulation.php">
                    <input type="hidden" name="event" value="LunchTeaPlot"></input>
                    <input type="image"  src="../icons/1.png" alt="Submit" width="150" height="150" value="<?php echo "hi";?>">
                    <h4><?php echo "Simulation";?></h4>
                    </form>
                    </div>
              </div>
</div>
                 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>

</body>
</html>