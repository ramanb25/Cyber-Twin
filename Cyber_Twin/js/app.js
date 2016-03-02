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

function Event(id){
  this.table = id;
  var context = this;
  //alert("here");
  this.duration_span = $("#"+id+"-duration");
  this.button = $("#"+id+"-button");
  this.form = $("#"+id+"-form");
  this.button.click(function(){
    if(!started){
      starttime =   new Date().toLocaleString(),
      currentSpan = context.duration_span;
      started = true;
      context.button.text("Stop Event");
      timer();
    }
    else{
      context.button.prop('disabled',true);
      clearTimeout(t);
      var data = {table: context.table,
              start_time: starttime,
              end_time: new Date().toLocaleString(),
              duration: currentSpan.text(),
              extra: JSON.stringify(context.form.serializeArray())
      };

     

      $.ajax({
        type: "POST",
        dataType: "json",
        url: "submit.php", //Relative or absolute path to response.php file
        data: data,
        success: function(data) {
          started = false;
          context.button.prop('disabled',false);
          context.button.text("Start Event");
          currentSpan.text("00:00:00");
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
      currentSpan.text((hours ? (hours > 9 ? hours : "0" + hours) : "00")
      + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00")
      + ":" + (seconds > 9 ? seconds : "0" + seconds));

      timer();
    }
