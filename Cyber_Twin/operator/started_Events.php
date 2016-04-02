<?php
  //include('manager_functions.php');
 // is_Manager_Logged_In();
  session_start();
  include('class_operator.php');
  $operator= new Operator();
  $operator->is_operator_login();
  include('navbar.php');
?>     

<div class="container">
                <div class="centered text-center col-centered">
        <?php
        $items=$operator->ongoing_events();
        foreach ($items as $key => $row) {
          if(!strcmp($row[2],"NULL")):?>
                      
                      <div class="col-sm-4 col-lg-4 col-md-4 img-hover">
                      <form  method="POST" action="event.php?started=1&starttime=<?php echo $key;?>">
                      <input type="hidden" value="<?php echo $row[0];?>" name="event_name"></input>
                      <input type="image" src="../icons/<?php echo $row[0];?>.png" alt="Submit" width="150" height="150" value="value">
                      <h4><?php echo "ONGOING";?></h4>
                      </form>
                      </div>

          <?php endif;}?>



</body>
</html>