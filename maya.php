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

include( plugin_dir_path( __FILE__ ) . 'post-types/atemuebung.php');
include( plugin_dir_path( __FILE__ ) . 'post-types/workout.php');
include( plugin_dir_path( __FILE__ ) . 'post-types/color.php');
include( plugin_dir_path( __FILE__ ) . 'shortcodes/calendar.php');

add_action('template_redirect', 'load_custom_workouts');

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



function load_custom_workouts(){
    $currentDate = date('Y-m-d');
    $startPoint = date_create("2020-07-02");
    $seal_post_id = sealoftheday($currentDate , $startPoint);
}

function sealoftheday($currentDate , $startPoint){
    
    $now = date_create($currentDate);
    $diff = date_diff($startPoint, $now);
    $d = (int)($diff->days/20);
    /*

	*/
	//var_dump($currentDate );

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
	wp_register_script ( 'modaljs' , get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '1', true );
	wp_register_style ( 'modalcss' , get_stylesheet_directory_uri() . '/css/bootstrap.css', '' , '', 'all' );
	
	wp_enqueue_script( 'modaljs' );
	wp_enqueue_style( 'modalcss' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_bootstrap_modals');


if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5f9f13ea21bad',
		'title' => 'color',
		'fields' => array(
			array(
				'key' => 'field_5f9f13ed30e01',
				'label' => 'color',
				'name' => 'color',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5f9f145f4ffbb',
				'label' => 'date',
				'name' => 'date',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'Y-m-d',
				'return_format' => 'Y-m-d',
				'first_day' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'color',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_5f1e9f6c76e30',
		'title' => 'events',
		'fields' => array(
			array(
				'key' => 'field_5f1e9f7fe7d74',
				'label' => 'atemuebung',
				'name' => 'atemuebung',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'atemuebung',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
			array(
				'key' => 'field_5f1eab4c09dfb',
				'label' => 'workout',
				'name' => 'workout',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'workout',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
			array(
				'key' => 'field_5f1eaf1b9c8de',
				'label' => 'color',
				'name' => 'color',
				'type' => 'select',
				'instructions' => 'green:green
	blue:blue
	yellow:yellow
	red:red',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
				),
				'default_value' => false,
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
				'ajax' => 0,
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tribe_events',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_5f1eafe29a834',
		'title' => 'workout',
		'fields' => array(
			array(
				'key' => 'field_5faa9e9c2453e',
				'label' => 'seal',
				'name' => 'seal_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
		
		),
		/*	array(
				'key' => 'field_5f1eb059739b6',
				'label' => 'siegel',
				'name' => 'siegel',
				'type' => 'text',
				'instructions' => 'Bild url',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			*/
			array(
				'key' => 'field_5f1fe5fff6ce7',
				'label' => 'workout_siegel_id',
				'name' => 'seal_id',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'workout',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	endif;



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