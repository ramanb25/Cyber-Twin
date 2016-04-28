<?php
   include 'class_manager.php';
   $manager= new Manager();
  $manager->is_Manager_Logged_In();


include('navbar.php')
?>

<p id="demo"></p>
    <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>  
  <div id="chart_div"></div>
      

 <div id="visualization" width="15000" height="15000"></div>
 <div id="visualizatio2" width="15000" height="15000"></div>
        <?php
         if(isset($_GET['timeline'])){
       // include 'chart.php';
        //$table='job';

      //   require_once('../Database.php');
        //require_once('../operator/class_operator.php');
        
        //$operator new operator();

        if(!isset($_GET["event_name"])){
        //$database = new Buttons();
         if($temp=$manager->get_events(NULL))
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
              <form  method="GET" action="timeline.php">
              <input type="hidden" class="btn btn-info" name="lvl" value="<?php echo $key;?>">
              <input type="hidden" class="btn btn-info" name="event_name" value="<?php echo $value[0];?>">
              <input type="hidden" class="btn btn-info" name="timeline" value="<?php echo $value[0];?>">
              <input type="image" src="../icons/<?php echo $value[0]; ?>.png" alt="Submit" width="150" height="150" value="<?php echo $value[0];?>">
              <h3><?php echo $value[1];?></h3>
              </form>
              </div>
              <?php
            }
                ?></div></div><?php

          }
      }
      else{
        
        $manager->timeline($_GET["event_name"],"MONTH",1);}

      }



      



      
?>



</body>
</html>