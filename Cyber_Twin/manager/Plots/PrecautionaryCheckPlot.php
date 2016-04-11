<?php include 'PrecautionaryCheckDataForPlot.php';?>
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

      var PrecautionaryCheck_Endtime = <?php echo json_encode($EndTime2); ?>;
      var PrecautionaryCheck_duration = <?php echo json_encode($Duration2); ?>;

function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Precautionary Check Endtime');
        data.addColumn('number', 'Duration of Precautionary Check (min)');
       for(var i=0; i<PrecautionaryCheck_duration.length;i++){
        data.addRows([
          [PrecautionaryCheck_Endtime[i], PrecautionaryCheck_duration[i]]
        ]);
    }

        // Set chart options
        var options = {'title':'Time for Precautionary Check',
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