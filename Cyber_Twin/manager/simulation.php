<!DOCTYPE html>
  <?php include 'Plots/JobDataSimulation.php';
        include 'navbar.php';
        $manager= new Manager();
		$manager->is_manager_logged_in();
  ?>
<html>
    <head>
        <title>Simulation</title>
          <script src="../js/jquery-1.12.2.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="../js/bootstrap.min.js"></script>
           
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
          <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
       
        
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
                webSocket = new WebSocket("ws://192.168.1.33:8080/Simulation/echo");
                 
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
                              var data=JSON.stringify(event.data);
                              var text='{"data":"'+event.data+'"}';
                              $('#chart_div').load('Plot.php',{data:event.data});
                        } 
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