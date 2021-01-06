<?php

/**
 * Registers the `meditation` post type.
 */
function meditation_init() {
	register_post_type( 'meditation', array(
		'labels'                => array(
			'name'                  => __( 'Meditations', 'maya' ),
			'singular_name'         => __( 'Meditation', 'maya' ),
			'all_items'             => __( 'All Meditations', 'maya' ),
			'archives'              => __( 'Meditation Archives', 'maya' ),
			'attributes'            => __( 'Meditation Attributes', 'maya' ),
			'insert_into_item'      => __( 'Insert into meditation', 'maya' ),
			'uploaded_to_this_item' => __( 'Uploaded to this meditation', 'maya' ),
			'featured_image'        => _x( 'Featured Image', 'meditation', 'maya' ),
			'set_featured_image'    => _x( 'Set featured image', 'meditation', 'maya' ),
			'remove_featured_image' => _x( 'Remove featured image', 'meditation', 'maya' ),
			'use_featured_image'    => _x( 'Use as featured image', 'meditation', 'maya' ),
			'filter_items_list'     => __( 'Filter meditations list', 'maya' ),
			'items_list_navigation' => __( 'Meditations list navigation', 'maya' ),
			'items_list'            => __( 'Meditations list', 'maya' ),
			'new_item'              => __( 'New Meditation', 'maya' ),
			'add_new'               => __( 'Add New', 'maya' ),
			'add_new_item'          => __( 'Add New Meditation', 'maya' ),
			'edit_item'             => __( 'Edit Meditation', 'maya' ),
			'view_item'             => __( 'View Meditation', 'maya' ),
			'view_items'            => __( 'View Meditations', 'maya' ),
			'search_items'          => __( 'Search meditations', 'maya' ),
			'not_found'             => __( 'No meditations found', 'maya' ),
			'not_found_in_trash'    => __( 'No meditations found in trash', 'maya' ),
			'parent_item_colon'     => __( 'Parent Meditation:', 'maya' ),
			'menu_name'             => __( 'Meditations', 'maya' ),
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
		'rest_base'             => 'meditation',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'meditation_init' );

/**
 * Sets the post updated messages for the `meditation` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `meditation` post type.
 */
function meditation_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['meditation'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Meditation updated. <a target="_blank" href="%s">View meditation</a>', 'maya' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'maya' ),
		3  => __( 'Custom field deleted.', 'maya' ),
		4  => __( 'Meditation updated.', 'maya' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Meditation restored to revision from %s', 'maya' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Meditation published. <a href="%s">View meditation</a>', 'maya' ), esc_url( $permalink ) ),
		7  => __( 'Meditation saved.', 'maya' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Meditation submitted. <a target="_blank" href="%s">Preview meditation</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Meditation scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview meditation</a>', 'maya' ),
		date_i18n( __( 'M j, Y @ G:i', 'maya' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Meditation draft updated. <a target="_blank" href="%s">Preview meditation</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'meditation_updated_messages' );
