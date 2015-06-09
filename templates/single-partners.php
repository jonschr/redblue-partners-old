<?php

//* Add the subheader
add_action( 'genesis_entry_header', 'rb_add_subhead', 10 );
function rb_add_subhead() {
	echo '<h4 class="subhead">';
	the_subtitle();
	echo '</h4>';
}

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

add_action( 'genesis_entry_header', 'rbp_add_featured_image', 15 );
function rbp_add_featured_image() {
	$img = genesis_get_image( array( 'format' => 'html', 'size' => 'partner-image', 'attr' => array( 'class' => 'partner-image-single' ) ) );
	printf( '%s', $img );
}

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );

genesis();