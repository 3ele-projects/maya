<?php

add_shortcode('maya_calendar', 'maya_show_calendar');

function maya_show_calendar()
{
  ob_start();






  $startPoint = date_create("2020-12-02");
  if ($s2member_auto_eot_time = get_user_field("s2member_auto_eot_time")) {
    //echo "EOT : ".date("F j, Y", $s2member_auto_eot_time)."";
    $start_date = date("Y-m-d");
    $end_date = date("Y-m-d", $s2member_auto_eot_time);
  } else {
    $start_date = date("Y-m-d");
    $end_date = date('Y-m-d', strtotime('365 days'));
  }

  $events = getcolorfromdate($start_date, $end_date);
  $calendar_events = array();
  //var_dump($events);
  $Maya_Calendar = new MayaCalender();
  foreach ($events as $event) {

    $cal_event = $Maya_Calendar->build_day($event->ID, $startPoint);
    $calendar_events[] = $cal_event;
    // var_dump($cal_event);
  }

?>

  <script>
    jQuery(document).ready(function() {

      var today = moment().day();
      //   console.log(today);
      var calendar = jQuery('#calendar').fullCalendar({

        height: set_new_height(),
        //height: auto,
        timeZone: 'UTC',
        contentHeight: 999,

        header: {
          left: 'prev,next today',
          center: 'title',
          //  right: 'month,agendaWeek,agendaDay,listWeek, year'
          right: 'basicDay,basicWeek,month,year'
        },

        //   initialView: 'custom',
        defaultView: 'basicDay',
        firstDay: today,
        defaultDate: jQuery('#calendar').fullCalendar('today'),
        eventClick: function(event) {


          jQuery('#calendar').fullCalendar('changeView', 'basicDay', event.start._i);


        },
        eventRender: function(event, element, view) {

          if (view.name != 'basicDay') {


            let content = document.createElement('div')

            //    content.innerHTML = '<img is="' + arg.event._def.extendedProps.seal_id + '" src="' + arg.event._def.extendedProps.seal + '"/>';
            //    content.innerHTML = '<img class="skip-lazy" src="' + event.seal + '"/>'
           // content.innerHTML = event.color_title
           var moon_phase =  event.moon_phase
            var moon_phase = (typeof moon_phase === 'undefined') ? '' : moon_phase;
			content.innerHTML += '<div class="m-1 moon_phase"> '+ moon_phase +'</div>'
			
			content.innerHTML += '<img class="skip-lazy" src="' + event.seal + '"/>'


            element = content
            return element
          } else {
            element = single_day_template(event, element, view)

            return element

          }
        },
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        handleWindowResize: true,
        windowResize: function(view) {
          set_new_height()

        },
        events: <?php echo json_encode($calendar_events); ?>,


        <?php if (defined('ICL_LANGUAGE_CODE')) { ?>

          locale: '<?php echo ICL_LANGUAGE_CODE; ?>'

        <?php } else { ?>
          locale: 'de'
        <?php } ?>

      });


    });
  </script>
  <script>
    function set_new_height() {
      var height = jQuery('.fc-event-container').height();

      // $('#calendar').fullCalendar.setOption('height', 9999999);
      // $('#calendar').fullCalendar.setOption('contentHeight', 9999999);
      jQuery('.fc-day-grid-container').height(height);
      //   calendar.setOption('contentHeight', height);
      return jQuery('.fc-content-skeleton').height()
    }
  </script>


  <div id='calendar'></div>
  <style>
    #content {
      min-height: 100%;
      height: 100%;
    }

    .fc-basicDay-view .fc-basic-view .fc-body .fc-row {
      min-height: 8em;
    }

    .fc-basicDay-view .fc-row.fc-rigid {
      /*  overflow: auto !important; */
      height: 100% !important;
    }


    .fc-row.fc-rigid {
      overflow: unset;
    }

    .fc-basicDay-view .fc-day-grid-container {
      /*height:100%!important; */
      overflow: unset !important;


    }

    .fc-basicDay-view .fc-scroller>.fc-day-grid,
    .fc-scroller>.fc-time-grid {
      position: relative;
      width: 100%;
      height: 100%;
      /*   min-width: 100vh; */
    }

    .fc-basicDay-view .fc-row.fc-rigid .fc-content-skeleton {
      position: relative !important;
      top: 0;
      left: 0;
      right: 0;
    }

    .fc-basicDay-view .fc-day-grid-container {
      height: auto !important;
    }

    .fc-basicDay-view .fc-event-container {
      overflow-x: hidden;
      width: 100%;
    }

    .fc-year-view .fc-day-grid-container {
      display: none;
    }
  </style>
<?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
  wp_reset_postdata();
}
