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

  <script type="text/javascript" >
jQuery(document).ready(function($) {
    $('.myajax').click(function(){
      var mydata = $(this).data();

      //var termID= $('#locinfo').val();
     // console.log(mydata);
        var data = {
            action: 'custom_action',
            start_date: '20201111',
         //   end_date: '20201111'

        };

        $.post('<?php echo esc_url( home_url() ); ?>/wp-admin/admin-ajax.php', data, function(response) {
           // alert('Got this from the server: ' + response);
           $('#wpajaxdisplay').html(response);      
        });
    });
});

</script>
<a href="#ajaxthing" class="myajax" data-id="600">Click On this</a>
<div id="wpajaxdisplay">Ajax Result will display here</div>

<?php


//$startPoint = $swpm_user->member_since;
$currentDate = date('Ymd');
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

  var data = {
            action: 'custom_action',
            start_date: '20201111',
         //   end_date: '2020111'

        };

        jQuery.post('<?php echo esc_url( home_url() ); ?>/wp-admin/admin-ajax.php', data, function(response) {
     //     jQuery('#wpajaxdisplay').html(response);    
          console.log(response) ;
          events = response;
           return response;

        });
};

const CustomViewConfig = {

classNames: [ 'custom-view' ],


  type: 'timeGrid',
  duration: { days: 1 },
  events: get_day_events(),

	eventContent: function(arg) {





let content = document.createElement('div')
content.innerHTML = '<img src="'+arg.event._def.extendedProps.seal+'"/>adadsa';
let arrayOfDomNodes = [ content ]
return { domNodes: arrayOfDomNodes }
},
content: function(props) {
 id = get_day_events();
 console.log(get_day_events());
 console.log(calendar.EventStore);

//console.log( props.eventStore.defs[14]);

  let html =
    '<div class="view-title">Workouts' +
    props.dateProfile.currentRange.start +
   //.forEach(element => console.log(element));

    '</div>' +
    '<div class="view-events">' +get_day_events()+
      'events' +
    'dkjfasjflkjfdlksj</div>'

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
