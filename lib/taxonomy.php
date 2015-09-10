<?php


function rb_register_partner_category_taxonomy() {
	$labels = array(
		'name' => 'Partner type',
		'singular_name' => 'Partner types',
		'search_items' =>  'Search Partner types',
		'all_items' => 'All Partner types',
		'parent_item' => 'Parent Partner type',
		'parent_item_colon' => 'Parent Partner type:',
		'edit_item' => 'Edit Partner type',
		'update_item' => 'Update Partner type',
		'add_new_item' => 'Add New Partner type',
		'new_item_name' => 'New Partner type',
		'menu_name' => 'Partner types'
	);

	register_taxonomy( 'partnercategories', array( 'partners' ),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			// 'rewrite' => array( 'slug' => 'relationship' ),
		)
	);
}
add_action( 'init', 'rb_register_partner_category_taxonomy' );
