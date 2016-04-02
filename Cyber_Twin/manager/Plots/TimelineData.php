<?php
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