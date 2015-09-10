<?php

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

add_action( 'genesis_entry_content', 'rbp_add_featured_image', 0 );
function rbp_add_featured_image() {
	$img = genesis_get_image( array( 'format' => 'html', 'size' => 'partner-image', 'attr' => array( 'class' => 'alignright' ) ) );
	printf( '%s', $img );
}

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );

genesis();