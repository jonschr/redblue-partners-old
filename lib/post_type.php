<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @author       Jon Schroeder <jon@redblue.us>
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Services post type
 *
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function rbc_register_post_types() {

	$labels = array(
		'name' => 'Partners',
		'singular_name' => 'Partner',
		'add_new' => 'Add new',
		'add_new_item' => 'Add new partner',
		'edit_item' => 'Edit partner',
		'new_item' => 'New partner',
		'view_item' => 'View partner',
		'search_items' => 'Search Partners',
		'not_found' =>  'No partners found',
		'not_found_in_trash' => 'No Partners found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Partners'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'partners' ),
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-format-image',
		'supports' => array( 'title', 'thumbnail', 'editor', 'wps_subtitle' )
	);

	register_post_type( 'partners', $args );
}
add_action( 'init', 'rbc_register_post_types' );
