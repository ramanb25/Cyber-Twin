<?php
 include('../db.php');
//require_once ('../Cyber_Twin/src/jpgraph.php');
//require_once ('../Cyber_Twin/src/jpgraph_bar.php');


//include 'x.php';
/**
* 
*/
class Manager
{

      public function get_events($under){
      if(is_null($under)){
        $query="select id,name,show_name from buttons where under is NULL";
        //echo $query;
        //statement($query);
        include('db.php');
        if($fetch=$db->query($query)) {
            $temp = array();
             while ($row = $fetch->fetch_row()) {
                   $temp[$row[0]]=array($row[1],$row[2]);
                   //echo $row[0];
                   //echo "as";
              }
            //print_r($temp);
            //$this->buttons=$temp;
              return $temp;
        }
        return false;
      }else{
        $query="select id,name,show_name from buttons where under = $under";
        //echo $query;
        //statement($query);
        include('db.php');
        if($fetch=$db->query($query)) {
            $temp = array();
             while ($row = $fetch->fetch_row()) {
                   $temp[$row[0]]=array($row[1],$row[2]);
                   //echo $row[0];
                   //echo "as";
              }
            //print_r($temp);
            //$this->buttons=$temp;
              return $temp;
        }
        return false; 
      }
    }
  function timeline($table,$group,$type){
            include('Plots/TimelineData.php');
            include('Plots/TimelinePlot.php');          
  }
  
    function show($event)
  {
            include('Plots/'.$event.'.php');
  }

  function is_Manager_Logged_In(){
    session_start();
    $manager=1;
    if (isset($_SESSION['mysesi']) && isset($_SESSION['mytype']))
    {
        if (!$_SESSION['mytype']==$manager) {
            # code...
             echo "<script>window.location.assign('../login.php')</script>";
        }
     
    }
    else
         echo "<script>window.location.assign('../login.php')</script>";
}


    function ongoing_jobs(){

        include('../db.php');

        $query="select * from job where end_time = 'NULL';";
        $items=array();
        $table=array();
        //array_push($table, 'JOB');
                          $result=$db->query($query);
                          //echo $query;
                         // $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                           // array_push( $row,"JOB")
                        $items[$row[0]]=$row =  array_merge( array( 0 => 'JOB' ),(array)$row );
                         //  echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";

                          }

                          $query="select * from operator_unavailability where end_time ='NULL';";

                          $result=$db->query($query);
                          //echo $query;
                        //  $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'OPERATOR UNAVAILABLE' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";

                          }

                          $query="select * from production_stoppage where end_time ='NULL';";

                          $result=$db->query($query);
                          //echo $query;
                        //  $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'PRODUCTION STOPPAGE' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";

                          }


                          $query="select * from lunch_tea where end_time = 'NULL';";

                          $result=$db->query($query);
                          //echo $query;
                         // $items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'LUNCHTEA' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";


                          }




                          $query="select * from machine_failure where end_time ='NULL';";

                          $result=$db->query($query);
                          //echo $query;
                          //$items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'MACHINE FAILURE' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";


                          }

                              $query="select * from precautionary_check where end_time ='NULL';";

                          $result=$db->query($query);
                          //echo $query;
                          //$items= array();
                          $count=0;
                            while ($row = $result->fetch_row()) {
                            $count++;
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'PRECAUTIONARY CHECK' ),(array)$row );
                         //   echo "JOB GOING ON \n";
                            //echo "<br>";
                        //    echo $row[4];
                          //  echo "\nstarted on ".$row[0];
                            //echo "<br>";


                          }

                krsort($items);
                foreach ($items as $key => $row) {
                  if(!strcmp($row[2],"NULL")):
                           ?><div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                              <form  method="GET" action="Plot.php">
                              <input type="hidden" value="ran" name="event"></input>
                              <input type="image" src="../icons/<?php echo $row[0];?>.png" alt="Submit" width="150" height="150" value="value">
                              <h4><?php echo "ONGOING";?></h4>
                              </form>
                              </div>
                                          

                <?php endif;}
                ?>

                 <?php
    }




    public function view_predictions($simulation_Data){
      //echo 'success';
      include('Plots/SimulationPlot.php');          


    }

    public function register_manager($user,$pass){
      include 'db.php';
      
        if(!empty($user)) //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
          { 
                      $sql="SELECT * FROM login WHERE username = '".$user."'";
            //echo $sql;
          $query = $db->query($sql);// or die(mysql_error()); 
          //..echo 'SELECT * FROM login WHERE username = '.$_POST[user;].''";
          if(!$row = $query->fetch_row()) {
            $userName = $user;
          // $email = $_POST['email'];
          $password = md5($pass);
            // $type=$_POST['type'];
            $query = "INSERT INTO login (name_login,username,password,type_login) VALUES ('$userName','$userName','$password','1')";
           $data = $db->query($query);//or die(mysql_error()); 
           if($data) { return "YOUR REGISTRATION IS COMPLETED..."; } 
          
          } 
          else {

           return "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
          } 
        }

      } 

      public function register_operator($user,$pass){
      include 'db.php';
      
        if(!empty($user)) //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
          { 
                      $sql="SELECT * FROM login WHERE username = '".$user."'";
            //echo $sql;
          $query = $db->query($sql);// or die(mysql_error()); 
          //..echo 'SELECT * FROM login WHERE username = '.$_POST[user;].''";
          if(!$row = $query->fetch_row()) {
            $userName = $user;
          // $email = $_POST['email'];
          $password = md5($pass);
            // $type=$_POST['type'];
            $query = "INSERT INTO login (name_login,username,password,type_login) VALUES ('$userName','$userName','$password','0')";
           $data = $db->query($query);//or die(mysql_error()); 
           if($data) { return "YOUR REGISTRATION IS COMPLETED..."; } 
          
          } 
          else {

           return "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
          } 
        }

      } 

  


}










