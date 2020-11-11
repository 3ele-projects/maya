<?php

/**
 * Registers the `workout` post type.
 */
function workout_init() {
	register_post_type( 'workout', array(
		'labels'                => array(
			'name'                  => __( 'Workouts', 'maya' ),
			'singular_name'         => __( 'Workout', 'maya' ),
			'all_items'             => __( 'All Workouts', 'maya' ),
			'archives'              => __( 'Workout Archives', 'maya' ),
			'attributes'            => __( 'Workout Attributes', 'maya' ),
			'insert_into_item'      => __( 'Insert into workout', 'maya' ),
			'uploaded_to_this_item' => __( 'Uploaded to this workout', 'maya' ),
			'featured_image'        => _x( 'Featured Image', 'workout', 'maya' ),
			'set_featured_image'    => _x( 'Set featured image', 'workout', 'maya' ),
			'remove_featured_image' => _x( 'Remove featured image', 'workout', 'maya' ),
			'use_featured_image'    => _x( 'Use as featured image', 'workout', 'maya' ),
			'filter_items_list'     => __( 'Filter workouts list', 'maya' ),
			'items_list_navigation' => __( 'Workouts list navigation', 'maya' ),
			'items_list'            => __( 'Workouts list', 'maya' ),
			'new_item'              => __( 'New Workout', 'maya' ),
			'add_new'               => __( 'Add New', 'maya' ),
			'add_new_item'          => __( 'Add New Workout', 'maya' ),
			'edit_item'             => __( 'Edit Workout', 'maya' ),
			'view_item'             => __( 'View Workout', 'maya' ),
			'view_items'            => __( 'View Workouts', 'maya' ),
			'search_items'          => __( 'Search workouts', 'maya' ),
			'not_found'             => __( 'No workouts found', 'maya' ),
			'not_found_in_trash'    => __( 'No workouts found in trash', 'maya' ),
			'parent_item_colon'     => __( 'Parent Workout:', 'maya' ),
			'menu_name'             => __( 'Workouts', 'maya' ),
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
		'rest_base'             => 'workout',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'workout_init' );

/**
 * Sets the post updated messages for the `workout` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `workout` post type.
 */
function workout_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['workout'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Workout updated. <a target="_blank" href="%s">View workout</a>', 'maya' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'maya' ),
		3  => __( 'Custom field deleted.', 'maya' ),
		4  => __( 'Workout updated.', 'maya' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Workout restored to revision from %s', 'maya' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Workout published. <a href="%s">View workout</a>', 'maya' ), esc_url( $permalink ) ),
		7  => __( 'Workout saved.', 'maya' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Workout submitted. <a target="_blank" href="%s">Preview workout</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Workout scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview workout</a>', 'maya' ),
		date_i18n( __( 'M j, Y @ G:i', 'maya' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Workout draft updated. <a target="_blank" href="%s">Preview workout</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'workout_updated_messages' );
