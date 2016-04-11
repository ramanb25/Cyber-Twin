<?php include 'JobDataForPlot.php';?>
<!DOCTYPE html>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      var GMICamShaft_Regular = <?php echo json_encode($GMICamShaft_Regular); ?>;
      var GMICamShaft_Regular_Endtime = <?php echo json_encode($GMICamShaft_Regular_Endtime); ?>;
      /*var NALTMainShaft_Regular = <?php echo json_encode($NALTMainShaft_Regular); ?>;
      var GMIMainShaft_Regular = <?php echo json_encode($GMIMainShaft_Regular); ?>;
      var GMICamShaft_Rework = <?php echo json_encode($GMICamShaft_Rework); ?>;
      var NALTMainShaft_Rework = <?php echo json_encode($NALTMainShaft_Regular); ?>;
      var GMIMainShaft_Rework = <?php echo json_encode($GMIMainShaft_Regwork); ?>;
*/		
function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Job End Time');
        data.addColumn('number', 'Cycle Time of GMI Cam Shaft (min)');
       for(var i=0; i<GMICamShaft_Regular.length;i++){
        data.addRows([
          [GMICamShaft_Regular_Endtime[i], GMICamShaft_Regular[i]]
          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/
        ]);
    }

        // Set chart options
        var options = {'title':'Cycle Time of GMI Cam Shaft',
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>