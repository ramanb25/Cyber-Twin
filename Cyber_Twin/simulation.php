<!DOCTYPE html>
 <?php include 'JobDataSimulation.php';?>
<html>
    <head>
        <title>Simulation</title>
          <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
       
        <div>
            <input type="text" id="messageinput"/>
        </div>
        <div>
            <button type="button" onclick="openSocket();" >Open</button>
            <button type="button" onclick="send();" >Send</button>
            <button type="button" onclick="closeSocket();" >Close</button>
        </div>
        <!-- Server responses get written here -->
        <div id="messages"></div>
        <div id="chart_div"></div>
       
        <!-- Script to utilise the WebSocket -->
        <script type="text/javascript">
                       
            var webSocket;
            var messages = document.getElementById("messages");
             var GMICamShaft_Regular = <?php echo json_encode($GMICamShaft_Regular); ?>;
      			var GMICamShaft_Regular_Endtime = <?php echo json_encode($GMICamShaft_Regular_Endtime); ?>;
            
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, "\\$&");
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }
           
            function openSocket(){
                // Ensures only one connection is open at a time
                if(webSocket !== undefined && webSocket.readyState !== WebSocket.CLOSED){
                   writeResponse("WebSocket is already opened.");
                    return;
                }
                // Create a new instance of the websocket
                webSocket = new WebSocket("ws://localhost:8080/Simulation/echo");
                 
                /**
                 * Binds functions to the listeners for the websocket.
                 */
                webSocket.onopen = function(event){
                    // For reasons I can't determine, onopen gets called twice
                    // and the first time event.data is undefined.
                    // Leave a comment if you know the answer.
                    if(event.data === undefined)
                        return;
 
                    writeResponse(event.data);
                };
 
                webSocket.onmessage = function(event){
                    writeResponse(event.data);




                  
    if(event.data!="Connection Established"){

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
    //  google.setOnLoadCallback(drawChart);

      var data =JSON.parse(event.data);
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
      }}
  




                   // alert(JSON.stringify(event.data));
                };
 
                webSocket.onclose = function(event){
                    writeResponse("Connection closed");
                };
            }
           
            /**
             * Sends the value of the text input to the server
             */
            function send(){
               // alert(JSON.stringify(GMICamShaft_Regular));
                webSocket.send(JSON.stringify(GMICamShaft_Regular));
            }
           
            function closeSocket(){
                webSocket.close();
            }
 
            function writeResponse(text){
                messages.innerHTML += "<br/>" + text;
            }
           
        </script>
       
    </body>
</html>