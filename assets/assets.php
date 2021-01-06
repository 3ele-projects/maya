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
<?php 
function hook_ajax_script(){
    wp_enqueue_script( 'my_ajax_script', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ) );

}
add_action( 'init', 'script_enqueuer' );
add_action( 'wp_enqueue_scripts', 'hook_ajax_script' );
add_action( 'admin_enqueue_scripts', 'hook_ajax_script' );
function script_enqueuer() {
   // Register the JS file with a unique handle, file location, and an array of dependencies
   wp_register_script( 'my_ajax_script', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ) );
   // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
   wp_localize_script( 'my_ajax_script', 'lightwebAJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
   
   // enqueue jQuery library and the script you registered above
   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'my_ajax_script' );


}

add_action("wp_ajax_load_post", "load_post");
add_action("wp_ajax_nopriv_load_post", "load_post");


?>
<?php 
function load_post() {
    if(isset($_POST["post_id"])&& is_numeric($_POST["post_id"])){
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($_POST["post_id"], true );
    }
    
    die();
 }

 ?>