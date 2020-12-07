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

$events = getcolorfromdate($date);
$calendar_events = array();
foreach($events as $event){
$image = get_field('seal_image', sealoftheday(get_field('date',$event->ID), $startPoint));
$workout_id = sealoftheday(get_field('date',$event->ID), $startPoint);
$aufwaermuebung = get_posts_from_color($event->ID, 'aufwaermuebung');

$content = $post_content->post_content;
$cal_event = array();
$cal_event['id'] = $event->ID;
$cal_event['start'] = get_field('date',$event->ID);
$cal_event['classNames'] = get_field('color',$event->ID);
$cal_event['classNames'] = get_field('color',$event->ID);
$cal_event['seal'] = $image;
$cal_event['workout_title'] = get_the_title($workout_id);
$cal_event['workout_content'] = $content;
$cal_event['atemuebung_title'] = get_the_title(10);
//$post_content= Frontend::get_builder_content( 38, false );

$content = $post_content->post_content;
$cal_event['atemuebung_content'] = $content;
$cal_event['aufwaermuebung_title'] = get_the_title(38);
$cal_event['aufwaermuebung_content'] = get_the_content(38);
$calendar_events[] = $cal_event;

}
//var_dump($calendar_events);
?>

<?php



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
         //   end_date: '2020111'

        };

        jQuery.post('<?php echo esc_url( home_url() ); ?>/wp-admin/admin-ajax.php', data, function(response) {
     //     jQuery('#wpajaxdisplay').html(response);    
          console.log(response) ;
          events = response;
           return response;

        });
};



document.addEventListener('DOMContentLoaded', function() {




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
        right: 'custom,dayGridWeek,dayGridMonth'
      },



events : <?php echo json_encode($calendar_events);?>,
views: {
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
  
  .accordion {
   overflow:hidden;
  }
  </style>



<?php
get_footer();
