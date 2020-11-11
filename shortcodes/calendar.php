<?php 

add_shortcode('maya_calendar', 'maya_show_calendar');

function maya_show_calendar(){
    $currentDate = date('Y-m-d');
    $startPoint = date_create("2020-07-02");
    //$last_day = date('Y-m-d', strtotime($swpm_user->member_since. ' + 365 days')); 
    $begin = new DateTime($currentDate);
    $end = date_create("2023-07-02");
    var_dump($currentDate);?>
    <?php  var_dump(sealoftheday( $currentDate , $startPoint)); ?>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
  <script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  function redirect_to_event(info){
    alert('clicked ' + info.dateStr);
      console.log(info)
      window.location.href = "http://maya-calendar.de.ddev.site/beispiel-seite/?date="+ info.dateStr;
}

  var calendar = new FullCalendar.Calendar(calendarEl, {
    selectable: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'timeGridDay,timeGridWeek, dayGridMonth'
    },
    lang: 'de',

    dateClick: function(info) {

     // redirect_to_event(info)
    },
   

  });

  calendar.render();

  var event={id:1 , title: 'New event', start:  new Date()};

});

</script>
<div id='calendar'></div>
    <?php
}