<?php


function rb_register_partner_category_taxonomy() {
	$labels = array(
		'name' => 'Partner relationship',
		'singular_name' => 'Partner relationships',
		'search_items' =>  'Search Partner relationships',
		'all_items' => 'All Partner relationships',
		'parent_item' => 'Parent Partner relationship',
		'parent_item_colon' => 'Parent Partner relationship:',
		'edit_item' => 'Edit Partner relationship',
		'update_item' => 'Update Partner relationship',
		'add_new_item' => 'Add New Partner relationship',
		'new_item_name' => 'New Partner relationship',
		'menu_name' => 'Partner relationships'
	);

	register_taxonomy( 'partnercategories', array( 'partners' ),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'relationship' ),
		)
	);
}
add_action( 'init', 'rb_register_partner_category_taxonomy' );
