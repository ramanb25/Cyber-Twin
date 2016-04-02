  <?php 
  //$db  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    include('../db.php');          
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