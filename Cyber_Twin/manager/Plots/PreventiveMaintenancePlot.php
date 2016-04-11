<?php include 'PreventiveMaintenanceDataForPlot.php';?>
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

      var PreventiveMaintenance_Endtime = <?php echo json_encode($EndTime3); ?>;
      var PreventiveMaintenance_duration = <?php echo json_encode($Duration3); ?>;

function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'PM Endtime');
        data.addColumn('number', 'Duration of PM (hrs)');
       for(var i=0; i<PreventiveMaintenance_duration.length;i++){
        data.addRows([
          [PreventiveMaintenance_Endtime[i], PreventiveMaintenance_duration[i]]
        ]);
    }

        // Set chart options
        var options = {'title':'Time for PM',
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