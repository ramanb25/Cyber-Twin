<script type="text/javascript">

 // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
    //  google.setOnLoadCallback(drawChart);
      var data = <?php echo $simulation_Data; ?>;
  //alert(data["2016-03-18 14:44:13"]);	
drawChart();
function drawChart() {
        // Create the data table.
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Job Number');
        data1.addColumn('number', 'Cycle Time of GMI Cam Shaft (min)');
     for (var key in data) {

     	data1.addRows([
          [key,data[key]]
          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);
  // ...
}
        // Set chart options
        var options = {'title':'Cycle time of GMI Cam Shaft units',
                       'width':1200,
                       'height':600};
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data1, options);
      }
      </script>