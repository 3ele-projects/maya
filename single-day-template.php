<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Maya Calendar
 */

get_header();
?>

	<main id="primary" class="site-main">

<?php


//$startPoint = $swpm_user->member_since;
$currentDate = date('Y-m-d');
$startPoint = date_create("2020-07-02");
//$last_day = date('Y-m-d', strtotime($swpm_user->member_since. ' + 365 days')); 
$begin = new DateTime($currentDate);
$end = date_create("2023-07-02");

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {



}
if (isset($_GET['date'])) {
	$date = $_GET['date'];
  } else {
	$date = Date('Ymd');
  }
//$date = 20201101;

$image = get_field('seal_image', sealoftheday($date , $startPoint));
//var_dump($image);
//var_dump($date);
$events = getcolorfromdate($date);
$calendar_events = array();
foreach($events as $event){
$image = get_field('seal_image', sealoftheday(get_field('date',$event->ID), $startPoint));
  
$cal_event = array();
$cal_event['id'] = $event->ID;

$cal_event['start'] = get_field('date',$event->ID);
$cal_event['classNames'] = get_field('color',$event->ID);
$cal_event['seal'] = $image;
$calendar_events[] = $cal_event;
}
//var_dump($calendar_events);
?>
<?php



?>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/locales-all.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
<!-- Button trigger modal -->

<script>
function get_day_events(){
  return <?php json_encode($calendar_events)[0];?>;
};

const CustomViewConfig = {

classNames: [ 'custom-view' ],
visibleRange: function(currentDate) {
    // Generate a new date for manipulating in the next step
    var startDate = new Date(currentDate.valueOf());
    var endDate = new Date(currentDate.valueOf());

    // Adjust the start & end dates, respectively
    startDate.setDate(startDate.getDate() - 1); // One day in the past
    endDate.setDate(endDate.getDate() + 2); // Two days into the future

    return { start: startDate, end: endDate };
  },

  type: 'timeGrid',
  duration: { days: 1 },
  events: get_day_events,
content: function(props) {
console.log(props);

  let html =
    '<div class="view-title">Workouts' +
    props.dateProfile.currentRange.start +

    '</div>' +
    '<div class="view-events">' +
     ' events' +
    '</div>'

  return { html: html }
}

}



document.addEventListener('DOMContentLoaded', function() {


function handleDatesRender(arg) {
    console.log('viewType:', arg.view.calendar.state.viewType);
  }

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
  //  plugins: [ customViewPlugin ],

	eventContent: function(arg) {





  let content = document.createElement('div')
  content.innerHTML = '<img src="'+arg.event._def.extendedProps.seal+'"/>';
  let arrayOfDomNodes = [ content ]
  return { domNodes: arrayOfDomNodes }
},

	timeZone: 'UTC',
      themeSystem: 'bootstrap',
      headerToolbar: {
        left: 'prev,next,today',
        center: 'title',
        right: 'custom,timeGridDay,timeGridWeek,dayGridMonth'
      },



events : <?php echo json_encode($calendar_events);?>,
views: {
timeGridDay: {
  titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
    },

    custom: CustomViewConfig
  
  },
initialView: 'custom',


  });
  calendar.render();
});




</script>
<div id='calendar'></div>



</main>
	

<style>
.myclass12 {

	background:#000000 url('https://www.cbronline.com/wp-content/uploads/2016/06/what-is-URL-770x503.jpg')!important;
	background-size: 100%, 20px;
}

</style>

<?php
get_footer();
