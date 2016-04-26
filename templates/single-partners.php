<?php

# Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_entry_content', 'rbp_add_featured_image', 0 );
function rbp_add_featured_image() {
	$img = genesis_get_image( array( 'format' => 'html', 'size' => 'partner-image', 'attr' => array( 'class' => 'alignnone partner-image' ) ) );
	printf( '%s', $img );
}

// Remove post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );

genesis();