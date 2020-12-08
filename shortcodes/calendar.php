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


  var calendar =  $('#calendar').fullCalendar({
  height: 'auto',
  timeZone: 'UTC',

  header: {
    left: 'prev,next today',
    center: 'title',
  //  right: 'month,agendaWeek,agendaDay,listWeek, year'
   right: 'custom,basicWeek,month,year'
  },

     //   initialView: 'custom',
        defaultView: 'custom',
        eventClick: function(event) {

console.log(event.start._i);
$('#calendar').fullCalendar('changeView', 'custom', event.start._i);


},
/*
        eventClick: function(info) {
          calendar.changeView('custom', info.event.start);
        },
        */
  navLinks: true, // can click day/week names to navigate views
  editable: false,
  eventLimit: true, // allow "more" link when too many events
     events: <?php echo json_encode($calendar_events); ?>,
});
//calendar.setOption('locale', 'de');
});

</script>



<div id='calendar'></div>

<?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
  wp_reset_postdata();
}
