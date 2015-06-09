<?php

/**
 * Remove the WordPress SEO metabox
 */
function rbp_remove_wp_seo_meta_box() {
    remove_meta_box( 'wpseo_meta', 'partners', 'normal' ); // change custom-post-type into the name of your custom post type
}
add_action( 'add_meta_boxes', 'rbp_remove_wp_seo_meta_box', 100000 );