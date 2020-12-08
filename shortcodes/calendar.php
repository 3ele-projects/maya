<?php

add_shortcode('maya_calendar2', 'maya_show_calendar2');

function maya_show_calendar2()
{
  ob_start();

  //$startPoint = $swpm_user->member_since;
  $currentDate = date('Ymd');
  $startPoint = date_create("2020-07-02");
  //$last_day = date('Y-m-d', strtotime($swpm_user->member_since. ' + 365 days')); 
  $begin = new DateTime($currentDate);
  $end = date_create("2023-07-02");

  if (isset($_GET['date'])) {
    $date = $_GET['date'];
  } else {
    $date = Date('Ymd');
  }
  $end_date = date('Ymd', strtotime('51 days'));
  $events = getcolorfromdate($date, $end_date);
  $calendar_events = array();
  $Maya_Calendar = new MayaCalender();
  foreach ($events as $event) {
    $cal_event = $Maya_Calendar->build_day($event->ID, $startPoint);
    $calendar_events[] = $cal_event;
  }
  //var_dump($calendar_events);
?>




  <!-- Button trigger modal -->

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        eventContent: function(arg) {
          let content = document.createElement('div')
          content.innerHTML = '<img is="' + arg.event._def.extendedProps.seal_id + '" src="' + arg.event._def.extendedProps.seal + '"/>';
          let arrayOfDomNodes = [content]
          return {
            domNodes: arrayOfDomNodes
          }
        },
        height: 'auto',
        timeZone: 'UTC',
        themeSystem: 'bootstrap',
        headerToolbar: {
          left: 'prev,next,today',
          center: 'title',
          right: 'custom,dayGridWeek,dayGridMonth,year'
        },

        events: <?php echo json_encode($calendar_events); ?>,
        views: {
          custom: CustomViewConfig,
          year: CustomViewYear

        },
        initialView: 'custom',
        eventClick: function(info) {
          calendar.changeView('custom', info.event.start);
        }

      });
      calendar.setOption('locale', 'de');
      calendar.render();

    });
  </script>
  <div id='calendar'></div>
  <style>
    .accordion {
      overflow: hidden;
    }
  </style>

<?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
  wp_reset_postdata();
}




add_shortcode('maya_calendar', 'maya_show_calendar');

function maya_show_calendar()
{
  ob_start();

  //$startPoint = $swpm_user->member_since;
  $currentDate = date('Ymd');
  $startPoint = date_create("2020-07-02");
  //$last_day = date('Y-m-d', strtotime($swpm_user->member_since. ' + 365 days')); 
  $begin = new DateTime($currentDate);
  $end = date_create("2023-07-02");

  if (isset($_GET['date'])) {
    $date = $_GET['date'];
  } else {
    $date = Date('Ymd');
  }
  $end_date = date('Ymd', strtotime('51 days'));
  $events = getcolorfromdate($date, $end_date);
  $calendar_events = array();
  $Maya_Calendar = new MayaCalender();
  foreach ($events as $event) {
    $cal_event = $Maya_Calendar->build_day($event->ID, $startPoint);
    $calendar_events[] = $cal_event;
  }
  //var_dump($calendar_events);
?>

  <script>
    $(document).ready(function() {

      var today = moment().day();
      var calendar = $('#calendar').fullCalendar({
        height: 'parent',
        //height: auto,
        timeZone: 'UTC',

        header: {
          left: 'prev,next today',
          center: 'title',
          //  right: 'month,agendaWeek,agendaDay,listWeek, year'
          right: 'basicDay,basicWeek,month,year'
        },

        //   initialView: 'custom',
        defaultView: 'basicDay',
        firstDay: today,
        defaultDate: $('#calendar').fullCalendar('today'),
        eventClick: function(event) {


          $('#calendar').fullCalendar('changeView', 'basicDay', event.start._i);


        },
        eventRender: function(event, element, view) {

          if (view.name != 'basicDay') {


            let content = document.createElement('div')

            //    content.innerHTML = '<img is="' + arg.event._def.extendedProps.seal_id + '" src="' + arg.event._def.extendedProps.seal + '"/>';
            content.innerHTML = '<img src="' + event.seal + '"/>'


            element = content
            return element
          } else {
            let aufwaermuebung = '';

            event.aufwaermuebung.forEach(function(entry) {
              aufwaermuebung += '<div>' + entry.title + '</div>';
              aufwaermuebung += '<div>' + entry.content + '</div>';
            });
            let atemuebung = '';

            event.atemuebung.forEach(function(entry) {
              atemuebung += '<div>' + entry.title + '</div>';
              atemuebung += '<div>' + entry.content + '</div>';
            });

            let html = '<div class="view-title"><img style="width:200px;" id="" src="' + event.seal + '"/><label for="repeat">Wähle Wiederholung:</label>' +
              '<select id="repeat" name="repeat"><option value="4">4</option> <option value="7">7</option><option value="13">13</option><option value="20">20</option><option value="20">20</option><option value="33">33</option><option value="40">40</option><option value="44">44</option><option value="51">51</option></select>' +
              '<span id="moon_cycle">Vollmond</span>' +
              '</div>'

              +
              `<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >` +
              event.workout_title + `
      </button>
    </h5>
  </div>

  <div id="collapseOne" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion">
    <div class="card-body">
    `
            `
    </div>
  </div>
</div>

</div>
` + atemuebung +
              `<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
Workouts
      </button>
    </h5>
  </div>

  <div id="collapseTwo" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion" style="height:0px">
    <div class="card-body">
    `+  aufwaermuebung+`
    </div>
  </div>
</div>` + atemuebung +
              `<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
Atemübungen
      </button>
    </h5>
  </div>

  <div id="collapseThree" class="collapse accordion " aria-labelledby="headingOne" data-parent="#accordion" style="height:0px">
    <div class="card-body">
 
` + atemuebung +
              `
    </div>
  </div>
</div>
</div>

`

            let content_header = document.createElement('div')
            let content = document.createElement('div')
            content.innerHTML = '<img src="' + event.seal + '"/>'
            content_header.innerHTML = '<img src="' + event.seal + '"/>'
            element = html
            return element

          }
        },
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: <?php echo json_encode($calendar_events); ?>,
      });
      //calendar.setOption('locale', 'de');
    });
  </script>



  <div id='calendar'></div>
  <style>
    .fc-basic-view .fc-body .fc-row {
      min-height: 8em;
    }

    #content {
      min-height: 80vh;
    }
  </style>
<?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
  wp_reset_postdata();
}
