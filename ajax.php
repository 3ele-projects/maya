<?php 

function get_events($start_date, $end_date){
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
	)));

    var_dump($posts);
};
	