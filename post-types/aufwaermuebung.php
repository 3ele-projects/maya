<?php

/**
 * Registers the `aufwaermuebung` post type.
 */
function aufwaermuebung_init() {
	register_post_type( 'aufwaermuebung', array(
		'labels'                => array(
			'name'                  => __( 'Aufwaermuebungs', 'maya' ),
			'singular_name'         => __( 'Aufwaermuebung', 'maya' ),
			'all_items'             => __( 'All Aufwaermuebungs', 'maya' ),
			'archives'              => __( 'Aufwaermuebung Archives', 'maya' ),
			'attributes'            => __( 'Aufwaermuebung Attributes', 'maya' ),
			'insert_into_item'      => __( 'Insert into aufwaermuebung', 'maya' ),
			'uploaded_to_this_item' => __( 'Uploaded to this aufwaermuebung', 'maya' ),
			'featured_image'        => _x( 'Featured Image', 'aufwaermuebung', 'maya' ),
			'set_featured_image'    => _x( 'Set featured image', 'aufwaermuebung', 'maya' ),
			'remove_featured_image' => _x( 'Remove featured image', 'aufwaermuebung', 'maya' ),
			'use_featured_image'    => _x( 'Use as featured image', 'aufwaermuebung', 'maya' ),
			'filter_items_list'     => __( 'Filter aufwaermuebungs list', 'maya' ),
			'items_list_navigation' => __( 'Aufwaermuebungs list navigation', 'maya' ),
			'items_list'            => __( 'Aufwaermuebungs list', 'maya' ),
			'new_item'              => __( 'New Aufwaermuebung', 'maya' ),
			'add_new'               => __( 'Add New', 'maya' ),
			'add_new_item'          => __( 'Add New Aufwaermuebung', 'maya' ),
			'edit_item'             => __( 'Edit Aufwaermuebung', 'maya' ),
			'view_item'             => __( 'View Aufwaermuebung', 'maya' ),
			'view_items'            => __( 'View Aufwaermuebungs', 'maya' ),
			'search_items'          => __( 'Search aufwaermuebungs', 'maya' ),
			'not_found'             => __( 'No aufwaermuebungs found', 'maya' ),
			'not_found_in_trash'    => __( 'No aufwaermuebungs found in trash', 'maya' ),
			'parent_item_colon'     => __( 'Parent Aufwaermuebung:', 'maya' ),
			'menu_name'             => __( 'Aufwaermuebungs', 'maya' ),
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
		'rest_base'             => 'aufwaermuebung',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'aufwaermuebung_init' );

/**
 * Sets the post updated messages for the `aufwaermuebung` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `aufwaermuebung` post type.
 */
function aufwaermuebung_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['aufwaermuebung'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Aufwaermuebung updated. <a target="_blank" href="%s">View aufwaermuebung</a>', 'maya' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'maya' ),
		3  => __( 'Custom field deleted.', 'maya' ),
		4  => __( 'Aufwaermuebung updated.', 'maya' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Aufwaermuebung restored to revision from %s', 'maya' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Aufwaermuebung published. <a href="%s">View aufwaermuebung</a>', 'maya' ), esc_url( $permalink ) ),
		7  => __( 'Aufwaermuebung saved.', 'maya' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Aufwaermuebung submitted. <a target="_blank" href="%s">Preview aufwaermuebung</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Aufwaermuebung scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview aufwaermuebung</a>', 'maya' ),
		date_i18n( __( 'M j, Y @ G:i', 'maya' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Aufwaermuebung draft updated. <a target="_blank" href="%s">Preview aufwaermuebung</a>', 'maya' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'aufwaermuebung_updated_messages' );
