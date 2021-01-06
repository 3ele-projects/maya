<?php 
function lwmedia_include_styles() {
        wp_enqueue_script( 'momentjs', plugin_dir_url( __FILE__ ) .'node_modules/moment/moment.js', array( 'jquery' ) );
        wp_enqueue_script( 'fullcalendar', plugin_dir_url( __FILE__ ) .'node_modules/fullcalendar-year-view/dist/fullcalendar.js', array( 'jquery' ) );
        wp_enqueue_script( 'fullcalendarlocal', plugin_dir_url( __FILE__ ) .'node_modules/fullcalendar-year-view/dist/locale-all.js', array( 'jquery' ) );
		wp_enqueue_script( 'fullcalendar-templates', plugin_dir_url( __FILE__ ) . 'js/fullcalendar-templates.js', array( 'jquery' ) );
		wp_enqueue_script( 'accordionjs', plugin_dir_url( __FILE__ ) . 'js/bootstrap.js', array( 'jquery' ) );

        wp_enqueue_style( 'boostrap.css' , plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );
        wp_enqueue_style ( 'accordion' , plugin_dir_url( __FILE__ ) . 'css/accordion.css' );
        wp_enqueue_style ( 'fullcalendarmain' , plugin_dir_url( __FILE__ ) .'node_modules/fullcalendar-year-view/dist/fullcalendar.css', array(), '1.1', 'all');


}

add_action( 'wp_enqueue_scripts', 'lwmedia_include_styles');

?>