<?php

/**
 * Registers the `color` post type.
 */
function color_init() {
	register_post_type( 'color', array(
		'labels'                => array(
			'name'                  => __( 'Colors', 'maya' ),
			'singular_name'         => __( 'Color', 'maya' ),
			'all_items'             => __( 'All Colors', 'maya' ),
			'archives'              => __( 'Color Archives', 'maya' ),
			'attributes'            => __( 'Color Attributes', 'maya' ),
			'insert_into_item'      => __( 'Insert into color', 'maya' ),
			'uploaded_to_this_item' => __( 'Uploaded to this color', 'maya' ),
			'featured_image'        => _x( 'Featured Image', 'color', 'maya' ),
			'set_featured_image'    => _x( 'Set featured image', 'color', 'maya' ),
			'remove_featured_image' => _x( 'Remove featured image', 'color', 'maya' ),
			'use_featured_image'    => _x( 'Use as featured image', 'color', 'maya' ),
			'filter_items_list'     => __( 'Filter colors list', 'maya' ),
			'items_list_navigation' => __( 'Colors list navigation', 'maya' ),
			'items_list'            => __( 'Colors list', 'maya' ),
			'new_item'              => __( 'New Color', 'maya' ),
			'add_new'               => __( 'Add New', 'maya' ),
			'add_new_item'          => __( 'Add New Color', 'maya' ),
			'edit_item'             => __( 'Edit Color', 'maya' ),
			'view_item'             => __( 'View Color', 'maya' ),
			'view_items'            => __( 'View Colors', 'maya' ),
			'search_items'          => __( 'Search colors', 'maya' ),
			'not_found'             => __( 'No colors found', 'maya' ),
			'not_found_in_trash'    => __( 'No colors found in trash', 'maya' ),
			'parent_item_colon'     => __( 'Parent Color:', 'maya' ),
			'menu_name'             => __( 'Colors', 'maya' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'color',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'color_init' );

/**
 * Sets the post updated messages for the `color` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `color` post type.
 */
function color_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['color'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Color updated. <a target="_blank" href="%s">View color</a>', 'maya' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'maya' ),
		3  => __( 'Custom field deleted.', 'maya' ),
		4  => __( 'Color updated.', 'maya' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Color restored to revision from %s', 'maya' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Color published. <a href="%s">View color</a>', 'maya' ), esc_url( $permalink ) ),
		7  => __( 'Color saved.', 'maya' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Color submitted. <a target="_blank" href="%s">Preview color</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Color scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview color</a>', 'maya' ),
		date_i18n( __( 'M j, Y @ G:i', 'maya' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Color draft updated. <a target="_blank" href="%s">Preview color</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'color_updated_messages' );


function getcolorfromdate($date){
	$date_array =($date);
    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'color',
        'meta_key'		=> 'date',
		'meta_value'	=> $date,
		'meta_compare'=>'<=',
		'fields' => 'ID'
	));

	if($posts):
	
	return $posts;
	else: 
	return $date_array;
	endif;	
	
}
