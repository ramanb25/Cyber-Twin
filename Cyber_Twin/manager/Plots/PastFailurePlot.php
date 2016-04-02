
  <?php  include('PastFailureData.php'); ?>
<div id="chart_div"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>     
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