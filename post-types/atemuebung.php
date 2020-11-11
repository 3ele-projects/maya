<?php

/**
 * Registers the `atemuebung` post type.
 */
function atemuebung_init() {
	register_post_type( 'atemuebung', array(
		'labels'                => array(
			'name'                  => __( 'Atemuebungs', 'maya' ),
			'singular_name'         => __( 'Atemuebung', 'maya' ),
			'all_items'             => __( 'All Atemuebungs', 'maya' ),
			'archives'              => __( 'Atemuebung Archives', 'maya' ),
			'attributes'            => __( 'Atemuebung Attributes', 'maya' ),
			'insert_into_item'      => __( 'Insert into atemuebung', 'maya' ),
			'uploaded_to_this_item' => __( 'Uploaded to this atemuebung', 'maya' ),
			'featured_image'        => _x( 'Featured Image', 'atemuebung', 'maya' ),
			'set_featured_image'    => _x( 'Set featured image', 'atemuebung', 'maya' ),
			'remove_featured_image' => _x( 'Remove featured image', 'atemuebung', 'maya' ),
			'use_featured_image'    => _x( 'Use as featured image', 'atemuebung', 'maya' ),
			'filter_items_list'     => __( 'Filter atemuebungs list', 'maya' ),
			'items_list_navigation' => __( 'Atemuebungs list navigation', 'maya' ),
			'items_list'            => __( 'Atemuebungs list', 'maya' ),
			'new_item'              => __( 'New Atemuebung', 'maya' ),
			'add_new'               => __( 'Add New', 'maya' ),
			'add_new_item'          => __( 'Add New Atemuebung', 'maya' ),
			'edit_item'             => __( 'Edit Atemuebung', 'maya' ),
			'view_item'             => __( 'View Atemuebung', 'maya' ),
			'view_items'            => __( 'View Atemuebungs', 'maya' ),
			'search_items'          => __( 'Search atemuebungs', 'maya' ),
			'not_found'             => __( 'No atemuebungs found', 'maya' ),
			'not_found_in_trash'    => __( 'No atemuebungs found in trash', 'maya' ),
			'parent_item_colon'     => __( 'Parent Atemuebung:', 'maya' ),
			'menu_name'             => __( 'Atemuebungs', 'maya' ),
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
		'rest_base'             => 'atemuebung',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'atemuebung_init' );

/**
 * Sets the post updated messages for the `atemuebung` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `atemuebung` post type.
 */
function atemuebung_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['atemuebung'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Atemuebung updated. <a target="_blank" href="%s">View atemuebung</a>', 'maya' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'maya' ),
		3  => __( 'Custom field deleted.', 'maya' ),
		4  => __( 'Atemuebung updated.', 'maya' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Atemuebung restored to revision from %s', 'maya' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Atemuebung published. <a href="%s">View atemuebung</a>', 'maya' ), esc_url( $permalink ) ),
		7  => __( 'Atemuebung saved.', 'maya' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Atemuebung submitted. <a target="_blank" href="%s">Preview atemuebung</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Atemuebung scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview atemuebung</a>', 'maya' ),
		date_i18n( __( 'M j, Y @ G:i', 'maya' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Atemuebung draft updated. <a target="_blank" href="%s">Preview atemuebung</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'atemuebung_updated_messages' );
