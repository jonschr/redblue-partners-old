<?php

/**
 * Use custom content for the loop
 */
function rb_custom_loop() {

	echo '<main class="content">';

	$taxonomies = array(
		'partnercategories',
		// 'my_tax',
	);

	$args = array(
		'orderby'           => 'name',
		'order'             => 'DESC',
		'hide_empty'        => true,
		'exclude'           => array(),
		'exclude_tree'      => array(),
		'include'           => array(),
		'number'            => '',
		'fields'            => 'all',
		'slug'              => '',
		'parent'            => '',
		'hierarchical'      => true,
		'child_of'          => 0,
		'get'               => '',
		'name__like'        => '',
		'description__like' => '',
		'pad_counts'        => false,
		'offset'            => '',
		'search'            => '',
		'cache_domain'      => 'core'
	);

	$terms = get_terms( $taxonomies, $args );


	foreach ($terms as $term ) {

		// start the post counter at 0 each time we start a new term
		$loopcounter = 0;
	    
	    // setup the cateogory ID
	    $term_id = $term->term_id;
	    
		echo '<header class="entry-header">';

	    // Make a header for the category
	    echo "<h1 class='entry-title'>" . $term->name . "</h1>";

	    $termdescription =  term_description( $term_id, 'partnercategories' );
	    echo '<h4 class="subhead">' . $termdescription . '</h4>';

	    echo '</header>';

	    echo '<div class="partner-container">';

	    // global $current_post; // current paginated page
		
		$args = array(
			'post_type' => 'partners',
			'order' => 'ASC',
			'posts_per_page' 	=> '-1',
			'orderby' => 'name',
			'tax_query' => array(
				array(
					'taxonomy' => 'partnercategories',
					'field' => 'term_id',
					'terms'    => $term_id,
				),
			),
		);

		$custom_query = new WP_Query( $args );

		while ( $custom_query->have_posts() ) {
			$custom_query->the_post();
			
			$classes = array(
				'one-fourth',
			);

			if ( 0 == $loopcounter || 0 == $loopcounter % 4 )
				$classes[] = 'first';
			?>

			<article <?php post_class( $classes ); ?>>
				<?php 

				$img = genesis_get_image( array( 'format' => 'html', 'size' => 'partner-image', 'attr' => array( 'class' => 'partner-image' ) ) );
				$link = get_the_permalink();
				printf( '%s', '<a href="' . $link . '">' . $img . '</a>' );
				
				?>
				
				<p class="aligncenter partner-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php edit_post_link( 'Edit this partner', '<br/><small>', '</small>' ); ?>
				</p>
				

				<?php
				// add 1 to the count
				$loopcounter++; 
				?>

			</article>
		

			<?php 
			
		}
		echo '</div>'; // div.partner-container
		echo '<div class="clear"></div>';
	}	
	
	echo '</main>';

}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rb_custom_loop' );


get_header();



genesis_loop();

get_footer();
