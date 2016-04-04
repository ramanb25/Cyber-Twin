var seconds = 0, minutes = 0, hours = 0,
    t,currentSpan,started = false;
var starttime;
var job_event = new Event("job");
var machine_failure_event = new Event("machine_failure");
var lunch_tea_event = new Event("lunch_tea");
var precautionary_check_event = new Event("precautionary_check");
var pm_event = new Event("pm");
var production_stoppage = new Event("production_stoppage");
var production_stoppage = new Event("operator_unavailability");



function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


function Event(id){
  this.table = id;
  var context = this;
  //alert("here");
  this.duration_span = $("#"+id+"-duration");
  this.button = $("#"+id+"-button");
  this.form = $("#"+id+"-form");

  if(getParameterByName('started')==1)
   {  started = true;
     // alert(getParameterByName('start'));
      currentSpan = context.duration_span;
      context.button.attr('src', '/Cyber_Twin/icons/stop.png');
      starttime=getParameterByName('starttime');
      currentSpan.text("Started on "+starttime);
    }


  this.button.click(function(){
    if(!started){
     // var starttime;
      currentSpan = context.duration_span;
      started = true;

      context.button.attr('src', '../icons/stop.png');

         var data = {table: context.table,
              start_time: starttime,
              extra: JSON.stringify(context.form.serializeArray())
      };

         $.ajax({
        type: "POST",
        dataType: "json",
        url: "submit.php", //Relative or absolute path to response.php file
        data: data,
        success: function(data) {
          starttime=data;
         // alert(starttime);
          //started = false;
         // context.button.prop('disabled',false);
         // context.button.text("Start Event");
         // currentSpan.text("00:00:00");
         // seconds = minutes = hours = 0;
         // alert("Event submitted successfully");
        }
      });



      timer();
    }
    else{
      context.button.prop('disabled',true);
      clearTimeout(t);
      //alert(starttime);
      var data = {table: context.table,
              start_time: starttime,
              extra: JSON.stringify(context.form.serializeArray())
      };

     

      $.ajax({
        type: "POST",
        dataType: "json",
        url: "submit2.php", //Relative or absolute path to response.php file
        data: data,
        success: function(data) {
          started = false;
          context.button.prop('disabled',false);
          context.button.attr('src', '../icons/start.png');
          currentSpan.text("Duration: 00:00:00");
          seconds = minutes = hours = 0;
          alert("Event submitted successfully");
        }
      });
    }
});
}
  function timer() {
      t = setTimeout(add, 1000);
  }
  function add (){
      seconds++;
      if (seconds >= 60) {
          seconds = 0;
          minutes++;
          if (minutes >= 60) {
              minutes = 0;
              hours++;
          }
      }
      currentSpan.text("Duration: "+(hours ? (hours > 9 ? hours : "0" + hours) : "00")
      + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00")
      + ":" + (seconds > 9 ? seconds : "0" + seconds));

      timer();
    }
