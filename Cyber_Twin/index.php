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
            }


           // echo $start_time_is;

            if(!isset($_POST["start"]))
            {
                $condition2=true;
                            }
            else 
                $condition2=false;
            //echo $going_on;
            //send to event   post event name

            ?>
            <form name='fr' action='started_Events.php' method='POST'>
            <input type='hidden' name='event_name' value='<?php echo $going_on ;?>'>
            <input type='hidden' name='start' value='1'>
            </form>
            <script type='text/javascript'>
            var condition="<?php echo $going_on ?>";
            var condition2= "<?php echo $condition2; ?>";
            if(condition!=false && condition2)
            ;
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
    <script src="js/jquery-1.12.2.js"></script>
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
               <form name="logout" action="started_events.php" class="navbar-form navbar-right"  method="post">
                        <button type="submit" class="btn btn-primary">Old Events</button>
                   </form>
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
        if(($temp=$database->get_buttons($lvl)) )
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
              <input type="image" src="/Cyber_Twin/icons/<?php echo $value[0]; ?>.png" alt="Submit" width="150" height="150" value="<?php echo $value[0];?>">
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
            <script src="js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
           <?php
     //   endif;

        ?>

    </div>

</body>

</html>