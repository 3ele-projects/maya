<?php
/**
 * Plugin Name:     Maya
 * Plugin URI:      www.lightweb-media.de
 * Description:     The Plugin insert an CPT "Workouts"
 * Author:          Sebastian Weiss
 * Author URI:      www.lightweb-media.de
 * Text Domain:     maya
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Maya
 */

// Your code starts here.
include( plugin_dir_path( __FILE__ ) . 'assets/ajax.php');
include( plugin_dir_path( __FILE__ ) . 'event.php');

include( plugin_dir_path( __FILE__ ) . 'acf/fields.php');

include( plugin_dir_path( __FILE__ ) . 'post-types/atemuebung.php');
include( plugin_dir_path( __FILE__ ) . 'post-types/aufwaermuebung.php');
include( plugin_dir_path( __FILE__ ) . 'post-types/workout.php');
include( plugin_dir_path( __FILE__ ) . 'post-types/color.php');
include( plugin_dir_path( __FILE__ ) . 'shortcodes/calendar.php');



function getpostfromfield($seal_id, $field){
    $posts = get_posts(array(
        'numberposts'	=> 1,
        'post_type'		=> 'workout',
        'meta_key'		=> $field,
        'meta_value'	=> $seal_id
	));
	if ($posts):
	return($posts[0]->ID);
	endif;
}

add_action('template_redirect', 'load_custom_workouts');

function load_custom_workouts(){
    $currentDate = date('Y-m-d');
    $startPoint = date_create("2020-07-02");
    $seal_post_id = sealoftheday($currentDate , $startPoint);
}

function sealoftheday($currentDate , $startPoint){
    
    $now = date_create($currentDate);
    $diff = date_diff($startPoint, $now);
    $d = (int)($diff->days/20);


    $seal_id =$diff->days -($d*20);
    $seal_post_id = getpostfromfield($seal_id, 'seal_id');
    return $seal_post_id;
    
}


class PageTemplater {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

	/**
	 * Returns an instance of this class. 
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		} 

		return self::$instance;

	} 

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data', 
			array( $this, 'register_project_templates' ) 
		);


		// Add a filter to the template include to determine if the page has our 
		// template assigned and return it's path
		add_filter(
			'template_include', 
			array( $this, 'view_project_template') 
		);


		// Add your templates to this array.
		$this->templates = array(
			'single-day-template.php' => 'single-day',
		);
			
	} 

	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list. 
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		} 

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	} 

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {
		
		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta( 
			$post->ID, '_wp_page_template', true 
		)] ) ) {
			return $template;
		} 

		$file = plugin_dir_path( __FILE__ ). get_post_meta( 
			$post->ID, '_wp_page_template', true
		);

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}

} 
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );




function themeprefix_bootstrap_modals() {
		wp_enqueue_script( 'fullcalendar','https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'fullcalendar-templates', plugin_dir_url( __FILE__ ) . '/assets/js/fullcalendar-templates.js', array( 'jquery' ) );
		wp_enqueue_script( 'accordionjs', plugin_dir_url( __FILE__ ) . '/assets/js/bootstrap.js', array( 'jquery' ) );
		wp_register_style ( 'fullcalendar_main' ,'https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.css', array('style') );

		wp_register_style ( 'boostrap.css' , plugin_dir_url( __FILE__ ) . '/assets/css/bootstrap.min.css' );
		wp_register_style ( 'accordion' , plugin_dir_url( __FILE__ ) . '/assets/css/accordion.css' );

}

add_action( 'wp_enqueue_scripts', 'themeprefix_bootstrap_modals');





	function my_page_columns($columns) {
		$columns = array(
		 'cb' => '< input type="checkbox" />',
		 'title' => 'Title',
		 'c_date' => 'MYDate',
		 'color' => 'Color'
		);
		return $columns;
	   };
	   function my_custom_columns($column) {
		global $post;
		if($column == 'c_date') {
		 echo get_field('date', $post->ID);
		} else {
		 echo '';
		}
		if($column == 'color') {
			echo get_field('color', $post->ID);
		   } else {
			echo '';
		   }
	   };
	   
	   add_action("manage_color_posts_custom_column", "my_custom_columns");
	   add_filter("manage_edit-color_columns", "my_page_columns");


	   function atemuebung_page_columns($columns) {
		$columns = array(
		 'cb' => '< input type="checkbox" />',
		 'title' => 'Title',
		 'c_date' => 'MYDate',
		 'color' => 'Color'
		);
		return $columns;
	   };
	   function atemuebung_columns($column) {
		global $post;
		if($column == 'c_date') {
		 echo get_field('date', $post->ID);
		} else {
		 echo '';
		}
		if($column == 'color') {
			echo get_field('color', $post->ID);
		   } else {
			echo '';
		   }
	   };
	   
	 //  add_action("manage_color_atemuebung_custom_column", "atemuebung_columns");
	 //  add_filter("manage_edit-atemuebung_columns", "atemuebung_page_columns");


	   function workout_page_columns($columns) {
		$columns = array(
		 'cb' => '< input type="checkbox" />',
		 'title' => 'Title',
		 'seal_image' => 'seal_image',
		 'workout_siegel_id' => 'Turnus_ID'
		);
		return $columns;
	   };
	   function workout_columns($column) {
		global $post;
		if($column == 'seal_image') {
		 echo '<img style="width:100px;" src="'.get_field('seal_image', $post->ID).'"/>';
	
		} else {
		 echo '';
		}
		if($column == 'workout_siegel_id') {
			echo get_field('seal_id', $post->ID);
	
		   } else {
			echo '';
		   }
	   };
	   
	   add_action("manage_workout_posts_custom_column", "workout_columns");
	   add_filter("manage_edit-workout_columns", "workout_page_columns");


	   add_filter( 'manage_edit-workout_sortable_columns', 'set_custom_workout_sortable_columns' );

function set_custom_workout_sortable_columns( $columns ) {

  $columns['workout_siegel_id'] = 'workout_siegel_id';

  return $columns;
}


add_action( 'pre_get_posts', 'workout_custom_orderby' );

function workout_custom_orderby( $query ) {
  if ( ! is_admin() )
    return;

  $orderby = $query->get( 'orderby');

  if ( 'workout_siegel_id' == $orderby ) {
    $query->set( 'meta_key', 'seal_id' );
    $query->set( 'orderby', 'meta_value_num' );
  }
}