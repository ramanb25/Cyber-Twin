<script src="../dist/vis.js"></script>
            <link href="../dist/vis.css" rel="stylesheet" type="text/css" />
                                <script type="text/javascript">
                                var dates = JSON.parse('<?php echo json_encode($items); ?>');
                                dates.toString();
                                //document.getElementById("demo").innerHTML = unavailabledates;
                                //for (i = 0; i < unavailabledates.length; i++) { 
                                  //  alert(unavailabledates[i]) ;
                                //}
                                //

                                  // DOM element where the Timeline will be attached
                                  var container = document.getElementById('visualization');

                                  // Create a DataSet (allows two way data-binding)
                                  var items = new vis.DataSet();
                                  var date = vis.moment(dates[0]);
                                  for (var i = 0; i < dates.length; i++) {
                                    date.add(5, 'hour');
                                    var date1=dates[i];
                                    var date2=dates[i+1];
                                    i++;

                                    items.add({
                                      id:      i,
                                      content: ' ' + i,
                                      start:   date1,
                                      end:     date2
                                    });
                                  }

                                  function customOrder (a, b) {
                                    // order by id
                                    return a.id - b.id;
                                  }

                                  // Configuration for the Timeline
                                  var options = {
                                    order: customOrder,
                                    editable: true,
                                    margin: {item: 0}
                                  };

                                  // Create a Timeline
                                  var timeline = new vis.Timeline(container, items, options);

                                  var ordering = document.getElementById('ordering');
                                  ordering.onchange = function () {
                                    timeline.setOptions({
                                      order: ordering.checked ? customOrder: null
                                    });
                                  };
                                </script>