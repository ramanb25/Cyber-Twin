
<!DOCTYPE html>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  




 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  
  <script type="text/javascript">
     // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
   
    function drawChart() {
   var data1 = new google.visualization.DataTable();
        data1.addRows([
          

          ['1', 0.000000],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);       data1.addRows([
          

          ['2', 0.000000],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);       data1.addRows([
          

          ['3', 0.000000],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);       data1.addRows([
          

          ['4', 0.000000],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);       data1.addRows([
          

          ['5', 402.378110],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);       data1.addRows([
          

          ['6', 232.622806],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);       data1.addRows([
          

          ['7', 0.000000],          /*[GMICamShaft_Regular_Endtime[1], GMICamShaft_Regular[1]],
          [GMICamShaft_Regular_Endtime[2], GMICamShaft_Regular[2]],
          [GMICamShaft_Regular_Endtime[3], GMICamShaft_Regular[3]],*/

        ]);  // ...


      var view = new google.visualization.DataView(data1);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
      chart.draw(view, options);
  }
  </script>  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>

















        