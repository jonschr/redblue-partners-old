<?php
/*
	Plugin Name: Red Blue Partners
	Plugin URI: http://redblue.us
	Description: Just another partners plugin
	Version: 1.1
    Author: Jon Schroeder
    Author URI: http://redblue.us

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/

// Plugin directory 
define( 'RBP_DIR', dirname( __FILE__ ) );

//* Register the post type
include_once( 'lib/post_type.php' );

//* Customize the admin panel
include_once( 'lib/admin.php' );

//* Add a custom taxonomy
include_once( 'lib/taxonomy.php' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'partners_add_scripts' );
function partners_add_scripts() {
    
    wp_register_style( 'partners-style', plugins_url( '/css/partners-style.css', __FILE__) );
    wp_enqueue_style( 'partners-style' );

}

//* Partners archive template
function partners_archive_template( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'partners' ) ) {
          $archive_template = dirname( __FILE__ ) . '/templates/archive-partners.php';
     }
     return $archive_template;
}
add_filter( 'archive_template', 'partners_archive_template' ) ;

//* Partners archive template
function partners_single_template( $single_template ) {
     global $post;

     if ( is_singular ( 'partners' ) ) {
          $single_template = dirname( __FILE__ ) . '/templates/single-partners.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'partners_single_template' ) ;

add_image_size( 'partner-image', 300, 200, true );

/**
 * Add a redirect from the single template to the archive
 */
function rbp_redirect_partners_single_to_archive()
{
    if ( ! is_singular( 'partners' ) )
        return;

    wp_redirect( get_post_type_archive_link( 'partners' ), 301 );
    exit;
}
add_action( 'template_redirect', 'rbp_redirect_partners_single_to_archive' );