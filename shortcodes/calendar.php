<?php 

add_shortcode('maya_calendar', 'maya_show_calendar');

function maya_show_calendar(){
   
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
$end_date = date('Ymd', strtotime('28 days'));
$events = getcolorfromdate($date, $end_date);
$calendar_events = array();
$Maya_Calendar = new MayaCalender();
foreach($events as $event){
  $cal_event = $Maya_Calendar->build_day($event->ID, $startPoint); 
$calendar_events[] = $cal_event;


}
//var_dump($calendar_events);
?>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/locales-all.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.css">
<!--<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script> -->
<!-- Button trigger modal -->

<script>
function get_day_events(){

  var data = {
            action: 'custom_action',
            start_date: '20201111',


        };

        jQuery.post('<?php echo esc_url( home_url() ); ?>/wp-admin/admin-ajax.php', data, function(response) {
          events = response;
           return response;

        });
};



document.addEventListener('DOMContentLoaded', function() {

  const CustomViewYear = {

classNames: ['year'],


contentHeight: 'auto',
  height: 'auto',
  buttonText: 'year',
  type: 'listYear',
dateIncrement: { years: 1 },
slotDuration: { months: 1 },
visibleRange: function (currentDate) {
                            return {
                                start: currentDate.clone().startOf('year'),
                                end: currentDate.clone().endOf("year")
                            };
                        },

                        events: [],
  }


  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {

	eventContent: function(arg) {
  let content = document.createElement('div')
  content.innerHTML = '<img src="'+arg.event._def.extendedProps.seal+'"/>';
  let arrayOfDomNodes = [ content ]
  return { domNodes: arrayOfDomNodes }
},
height: 'auto',
	timeZone: 'UTC',
      themeSystem: 'bootstrap',
      headerToolbar: {
        left: 'prev,next,today',
        center: 'title',
        right: 'custom,dayGridWeek,dayGridMonth,year'
      },



events : <?php echo json_encode($calendar_events);?>,
views: {
    custom: CustomViewConfig,
    year: CustomViewYear

  },
initialView: 'custom',
eventClick:function(info){
  calendar.changeView('custom', info.event.start);
}

  });
  calendar.render();
  
});




</script>
<div id='calendar'></div>
<style>
  
  .accordion {
   overflow:hidden;
  }
  </style>
  <script>
  
  
  </script>
<?php 
}