<?php

class MayaCalender {

    public function build_day($color_ID, $startPoint){
        $aufwaermuebung = get_posts_from_color(get_field('color',$color_ID), 'aufwaermuebung');
        $atemuebung = get_posts_from_color(get_field('color',$color_ID), 'atemuebung');
  
        $image = get_field('seal_image', sealoftheday(get_field('date',$color_ID), $startPoint));
        $workout_id = sealoftheday(get_field('date',$color_ID), $startPoint);
        $workout_id = sealoftheday(get_field('date',$color_ID), $startPoint);
        $post_content = get_post($workout_id);
        $cal_event = array();
        $cal_event['id'] = $color_ID;
        $cal_event['start'] = get_field('date',$color_ID);
        $cal_event['classNames'] = get_field('color',$color_ID);
        $cal_event['classNames'] = get_field('color',$color_ID);
        $cal_event['seal'] = $image;
        $cal_event['workout_title'] = get_the_title($workout_id);
        $cal_event['workout_content'] = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($workout_id, true );
        $cal_event['atemuebung'] = $atemuebung;
        $cal_event['aufwaermuebung'] = $aufwaermuebung;
        return $cal_event;
    }

}