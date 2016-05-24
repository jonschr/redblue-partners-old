<?php

/**
 * Return Section (for template selection)
 * @link http://www.billerickson.net/code/helper-function-for-template-include-and-body-class/
 * @param null
 * @return string
 */
function redblue_partners_return_section() {
    
    if ( is_post_type_archive( 'partners' ) )
        return 'archive-partners'; // we are returning the name of the template file with the .php stripped

    if ( is_singular( 'partners' ) )
        return 'single-partners';
    
    return false;
}
/**
 * Template Chooser
 * @link http://www.billerickson.net/code/use-same-template-for-taxonomy-and-cpt-archive/
 *
 * @param string, default template path
 * @return string, modified template path
 *
 */
function redblue_partners_template_chooser( $template ) {
    
    if ( redblue_partners_return_section() ) {

        //* Get the filename of the location in the theme where the override template would live
        $template_in_theme = get_query_template( redblue_partners_return_section() ); 
        
        //* Echo this for testing purposes
        // echo 'Theme template method 1: ' . $template_in_theme . '</br>';

        //* Get the filename of the location in the plugin where our default template lives
        $template_in_plugin = REDBLUE_PARTNERS_DIR . '/templates/' . redblue_partners_return_section() . '.php';
        
		//* Echo this for testing purposes
        // echo 'Plugin template: ' . $template_in_plugin . '</br>';
        
        //* If this specific template is in the theme, we'll use that as our first choice
        if ( file_exists( $template_in_theme ) )
            return $template_in_theme;        
        
        //* If this specific template is in the plugin, we'll use that next
        if ( file_exists( $template_in_plugin ) )
            return $template_in_plugin;
    } 

    //* If we don't have either of those, we'll just return whatever the original $template value was
    return $template;

}
add_filter( 'template_include', 'redblue_partners_template_chooser' );

/**
 * Section Body Classes
 * @author Bill Erickson
 * 
 * @param array $classes
 * @return array
 */
function redblue_partners_section_body_classes( $classes ) {
    if ( redblue_partners_return_section() )
        $classes[] = 'section-' . redblue_partners_return_section();
    return $classes;
}
add_filter( 'body_class', 'redblue_partners_section_body_classes' );