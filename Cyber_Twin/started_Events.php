<?php
  //include('manager_functions.php');
 // is_Manager_Logged_In();

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
     <script src="js/jquery-1.12.2.js"></script>
     <script src="js/app.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  

    <!-- Custom CSS -->
     <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
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

     

<div class="container">
                <div class="centered text-center col-centered">
        <?php
     //   if(!isset($_POST['timeline']) && !isset($_POST['past_data'])){
        			include('db.php');

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
                        $items[$row[0]]=$row =  array_merge( array( 0 => 'job' ),(array)$row );
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
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'operator_unavailability' ),(array)$row );
                         // =  echo "JOB GOING ON \n";
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
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'production_stoppage' ),(array)$row );
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
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'lunch_tea' ),(array)$row );
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
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'machine_failure' ),(array)$row );
                           // echo "JOB GOING ON \n";
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
                        $items[$row[0]]=$row=  array_merge( array( 0 => 'precautionary_check' ),(array)$row );
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
                      <form  method="POST" action="event.php?started=1&starttime=<?php echo $key;?>">
                      
                      <input type="hidden" value="<?php echo $row[0];?>" name="event_name"></input>
                      <input type="image" src="icons/<?php echo $row[0];?>.png" alt="Submit" width="150" height="150" value="value">
                      <h4><?php echo "ONGOING";?></h4>
                      </form>
                      </div>
                                  

        <?php endif;}
        










      
?>



</body>
</html>