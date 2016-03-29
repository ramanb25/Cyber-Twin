<?php
 require_once('dbconfig.php');
//require_once ('../Cyber_Twin/src/jpgraph.php');
//require_once ('../Cyber_Twin/src/jpgraph_bar.php');

//include 'x.php';
/**
* 
*/
class chart
{
  function timeline($table,$group,$type){
               $db  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
              
          $timeline=1;
           $query="select * from `$table`;";
              $result=$db->query($query);
              $items= array();
              $i=0;
                while ($row = $result->fetch_row()) {
                $i++;
                array_push($items, $row[0]); //start time
                if(strcmp($row[1],"NULL"))
                  array_push($items, $row[1]); //end time
                else{
                  echo $row[1];
                  $timezone=new DateTimeZone("ASIA/KOLKATA");
                  $now = new DateTime();
                  $now->setTimezone($timezone );
                  array_push($items, $now->format('Y-m-d H:i:s'));  //hasnt ended yet current time
                }
                //$items[]=array($row[0] => $row[1] );
               // echo $items[$row[0]];
              }



              ?>           
                
                <script src="../Cyber_Twin/dist/vis.js"></script>
            <link href="../Cyber_Twin/dist/vis.css" rel="stylesheet" type="text/css" />
                                <script type="text/javascript">
                                var dates = JSON.parse('<?php echo json_encode($items); ?>');
                                dates.toString();
                                //document.getElementById("demo").innerHTML = unavailabledates;
                                //for (i = 0; i < unavailabledates.length; i++) { 
                                  //  alert(unavailabledates[i]) ;
                                //}
                                //

                                  // DOM element where the Timeline will be attached
                                  var container = document.getElementById('visualization');

                                  // Create a DataSet (allows two way data-binding)
                                  var items = new vis.DataSet();
                                  var date = vis.moment(dates[0]);
                                  for (var i = 0; i < dates.length; i++) {
                                    date.add(5, 'hour');
                                    var date1=dates[i];
                                    var date2=dates[i+1];
                                    i++;

                                    items.add({
                                      id:      i,
                                      content: ' ' + i,
                                      start:   date1,
                                      end:     date2
                                    });
                                  }

                                  function customOrder (a, b) {
                                    // order by id
                                    return a.id - b.id;
                                  }

                                  // Configuration for the Timeline
                                  var options = {
                                    order: customOrder,
                                    editable: true,
                                    margin: {item: 0}
                                  };

                                  // Create a Timeline
                                  var timeline = new vis.Timeline(container, items, options);

                                  var ordering = document.getElementById('ordering');
                                  ordering.onchange = function () {
                                    timeline.setOptions({
                                      order: ordering.checked ? customOrder: null
                                    });
                                  };
                                </script>





          <?php
  }
  
  function past_data($table,$group,$type)
  {
              $db  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
              
          $timeline=1;


          $group="MONTH";
          $i=0;

          $months=array();
          $values=array();
          $query ="SELECT MONTH(end_time),count(end_time),YEAR(end_time) FROM `machine_failure` WHERE failed_unit='Clamping unit' and end_time is not null group by MONTH(end_time)";
           $result=$db->query($query);
              $items= array();
               while ($row = $result->fetch_row()) {
                $i++;
                //array_push($items, $row[0]);
                if(!in_array($row[2]*100+$row[0], $months))
               array_push($months, $row[2]*100+$row[0]);
             //echo 
                $clamping[$row[2]*100+$row[0] ]= $row[1] ;
               // echo $items[$row[0]];
              }
              $query ="SELECT MONTH(end_time),count(end_time),YEAR(end_time) FROM `machine_failure` WHERE failed_unit='Drilling unit' group by MONTH(end_time)";
           $result=$db->query($query);
              $ite= array();
              $groups= array();
              $i=0;
                while ($row = $result->fetch_row()) {
                $i++;
                 if(!in_array($row[2]*100+$row[0], $months))
               array_push($months, $row[2]*100+$row[0]);
                //array_push($items, $row[0]);
               // if(!in_array($row[1], $groups))
                //array_push($groups, $row[1]);
                $drilling[$row[2]*100+$row[0]]= $row[1] ;
               // echo $items[$row[0]];
              }


               $query ="SELECT MONTH(end_time),count(end_time),YEAR(end_time) FROM `machine_failure` WHERE failed_unit='Milling unit' group by MONTH(end_time)";
           $result=$db->query($query);
              $ite= array();
              $groups= array();
              $i=0;
                while ($row = $result->fetch_row()) {
                $i++;
                 if(!in_array($row[2]*100+$row[0], $months))
               array_push($months, $row[2]*100+$row[0]);
                //array_push($items, $row[0]);
               // if(!in_array($row[1], $groups))
                //array_push($groups, $row[1]);
                $milling[$row[2]*100+$row[0]]= $row[1] ;
               // echo $items[$row[0]];
              }

               $query ="SELECT MONTH(end_time),count(end_time),YEAR(end_time) FROM `machine_failure` WHERE failed_unit='Feed unit' group by MONTH(end_time)";
           $result=$db->query($query);
              $ite= array();
              $groups= array();
              $i=0;
                while ($row = $result->fetch_row()) {
                $i++;
                 if(!in_array($row[2]*100+$row[0], $months))
               array_push($months, $row[2]*100+$row[0]);
                //array_push($items, $row[0]);
               // if(!in_array($row[1], $groups))
                //array_push($groups, $row[1]);
                $feed[$row[2]*100+$row[0] ]= $row[1] ;
               // echo $items[$row[0]];
              }
              function figure($value,$array){

                 if(array_key_exists($value, $array))
                  return $array[$value];
                  else  return 0;
              }
              //TODO sort array  months
              asort($months);
              foreach ($months as $key => $value) {
                # code...
                array_push($values, array(
                                    $value,
                                    figure($value,$feed),
                                    figure($value,$drilling) ,
                                    figure($value,$clamping),//TODO if no data then error
                                    figure($value,$milling)
                                )
                          );
              }
          //echo $query;

           //foreach ($values as $key => $value) echo $value[0];
          ?>
                    
          <script type="text/javascript">

           
            

             google.charts.load('current', {packages: ['corechart', 'bar']});
          google.charts.setOnLoadCallback(drawRightY);

          function drawRightY() {
                var data = google.visualization.arrayToDataTable([
                    ['Month', 'Feeding unit', 'Drilling unit','Clamping unit','Milling unit'],
                    <?php foreach ($values as $key => $value)  { ?>
                    [
                      '<?php 
                                $which_month=$value[0]%100;
                                $which_year=(integer) ($value[0]/100);
                      echo ''.date('F', mktime(0, 0, 0, $which_month, 2)).' '.$which_year; ?>', 
                      <?php echo $value[1]; ?>,
                      <?php echo $value[2]; ?>,
                      <?php echo $value[3]; ?>,
                      <?php echo $value[4]; ?>],
                      <?php  } ?>
                    ]
                );

                var options = {
                  chart: {
                    title: 'Failed Unit Monthwise',
                    subtitle: 'Based on previous data'
                  },
                  hAxis: {
                    title: 'failed times',
                    minValue: 0,
                  },
                  vAxis: {
                    title: 'Month'
                  },
                  bars: 'horizontal',
                  axes: {
                    y: {
                      0: {side: 'right'}
                    }
                  }
                };
                var material = new google.charts.Bar(document.getElementById('chart_div'));
                material.draw(data, options);
              }

           

          </script>









            <?php
            
            //TODO close connection
  }

}










?>