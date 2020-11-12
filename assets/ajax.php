<?php 

function get_events($start_date, $end_date){
    var_dump($start_date);
    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'color',
        'meta_key'		=> 'date',
        'meta_query' => array(
            array(
                'key' => '_',
                'value' => array($start_date, $end_date),
                'compare' => 'BETWEEN',
                'type' => 'DATE'
            )
    	)	));

    var_dump($posts);
};


function get_event($start_date){
    $posts = get_posts(array(
        'numberposts'	=> 1,
        'post_type'		=> 'color',
        'meta_key'		=> 'date',
		'meta_value'	=> $start_date,
        'meta_compare'=>'='	
    ));

   // var_dump($posts);
   $event = $posts[0];

    $cal_event = array();
$cal_event['id'] = $event->ID;
$image = get_field('seal_image', sealoftheday(get_field('date',$event->ID), $startPoint));
//$cal_event['content'] = do_shortcode("[maya_calendar]");
$cal_event['content'] = $event->post_content;

$cal_event['start'] = get_field('date',$event->ID);
$cal_event['classNames'] = get_field('color',$event->ID);
$cal_event['seal'] = $image;
echo  json_encode($cal_event);
//return json_encode($cal_event);

};



add_action('wp_ajax_custom_action', 'custom_action_callback_wp');
add_action( 'wp_ajax_nopriv_custom_action', 'custom_action_callback_wp' );

function custom_action_callback_wp() {
 //  var_dump($_POST);
    if (isset($_POST["start_date"]) && isset($_POST["end_date"])) {
  get_events($_POST["start_date"], $_POST["end_date"]);     

    } else {
        get_event($_POST["start_date"]);
    }
     exit() ;
; // this is required to return a proper result
} ?>
	