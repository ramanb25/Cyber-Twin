<?php include 'FailureDataForPlot.php';?>
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

      var unit = <?php echo json_encode($Unit); ?>;
      var duration = <?php echo json_encode($Sum_seconds); ?>;



      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Failed Unit');
        data.addColumn('number', 'Downtime (Hrs.)');
        data.addRows([
          [unit[0], duration[0]],
          [unit[1], duration[1]],
          [unit[2], duration[2]],
          [unit[3], duration[3]],
          [unit[4], duration[4]],
          [unit[5], duration[5]],
          [unit[6], duration[6]]
        ]);

        // Set chart options
        var options = {'title':'Downtime due to failure of different units',
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>