<?php
session_start();
include('class_operator.php');
        $operator= new Operator();
  $operator->is_operator_login();

$going_on=0;
      $items=$operator->ongoing_events();
        foreach ($items as $key => $row) {
          $going_on=1;
          if(!strcmp($row[2],"NULL")):?>
                      
                     
                      <form name='fr' method="POST" action="event.php?started=1&starttime=<?php echo $key;?>">
                      <input type="hidden" value="<?php echo $row[0];?>" name="event_name"></input>
                      </form>
                     

          <?php endif;}?>

     <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>

            <script type='text/javascript'>
            var condition=<?php echo $going_on ?>;
            if(condition)
            document.fr.submit();
            </script>

          <?php
        //IS EVENT GOING ON
    /*
        $going_on=false;
        $start_time_is=  array();
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
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
                    $start_time_is[$table]="$rows[0]";
                  }
            }*/

//echo $_SESSION['mytype'];

 include('navbar.php');
        require_once('../Database.php');
   //     include 'chart.php';


       // $database = new Buttons();
        //$database->connect();
        //$query="select * from cart";
        if(isset($_POST["lvl"]))
          $lvl=$_POST["lvl"];
        else
          $lvl=NULL;
        $event_name="";
        //echo $lvl;
        //echo $going_on;
        if(($temp=$operator->get_events($lvl)) )
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
              <form  method="POST" action="event.php">
              <input type="hidden" class="btn btn-info" name="lvl" value="<?php echo $key;?>">
              <input type="hidden" class="btn btn-info" name="event_name" value="<?php echo $value[0];?>">
              <input type="image" src="../icons/<?php echo $value[0]; ?>.png" alt="Submit" width="150" height="150" value="<?php echo $value[0];?>">
              <h3><?php echo $value[1];?></h3>
              </form>
              </div>
              <?php
            }
                ?></div></div><?php

          }
     //   if((!$temp && !$going_on)  || isset($_POST["start"])   ) :
         // echo "d";

 ?>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
    
           <?php
     //   endif;

        ?>

    </div>

</body>

</html>