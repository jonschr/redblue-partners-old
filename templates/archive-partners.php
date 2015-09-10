<?php

/**
 * Use custom content for the loop
 */
function rb_custom_loop() {

	echo '<main class="content">';

	$taxonomies = array(
		'partnercategories',
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

	$numberofterms = count( $terms );

	//* If there's more than one term, then we'll display them by category
	if ( $numberofterms > 1 ) {
		rbp_category_output( $terms );

	/**
	 * If there's just one term or none, then we'll just display a grid with everything
	 * No need to pass the term into here; we'll retrieve the archive description instead
	 */
	} else {
		rbp_archive_output();
	}

	echo '</main>';

}
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rb_custom_loop' );

/**
 * This is the output if we just have zero or one partner categories
 */
function rbp_archive_output() {

	//* Output the Genesis archive description
	genesis_do_cpt_archive_title_description();
	
	//* Start the post counter at 0 each time we start a new term
	$loopcounter = 0;    

	echo '<div class="partner-container">';

	while ( have_posts() ) {
		the_post();
		
		$classes = array(
			'one-fourth',
		);

		if ( 0 == $loopcounter || 0 == $loopcounter % 4 )
			$classes[] = 'first';
		
		?>

		<article <?php post_class( $classes ); ?>>
			
			<?php

			//* Get the content (this is the same on category and archive views)
			rbp_article_content();
			
			$loopcounter++; 
			?>

		</article>

		<?php 
		
	}

	echo '</div>';
}

/**
 * This is the output if we have two or more categories
 * @param  array $terms
 */
function rbp_category_output( $terms ) {
	foreach ($terms as $term ) {

		// start the post counter at 0 each time we start a new term
		$loopcounter = 0;
	    
	    // setup the cateogory ID
	    $term_id = $term->term_id;
	    
		echo '<div class="archive-description cpt-archive-description">';

			//* If there's a genesis headline set, we'll use that. Otherwise, use the name of the term
			if ( $term->meta[ 'headline' ] ) {
				$term_headline = $term->meta[ 'headline' ];
				printf( '<h1 class="archive-title">%s</h1>', $term_headline );
			} else {
			    echo '<h1 class="archive-title">' . $term->name . '</h1>';
			}

			if ( $term->meta[ 'intro_text' ] ) {
				$term_intro_text = $term->meta[ 'intro_text' ];
				printf( '<p>%s</p>', $term_intro_text );
			}

	    echo '</div>';


	    echo '<div class="partner-container">';
		
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

				//* Get the content (this is the same on category and archive views)
				rbp_article_content();

				$loopcounter++; 
				?>

			</article>

			<?php 
			
		}
		echo '</div>'; // div.partner-container
		echo '<div class="clear"></div>';
	}	
}

function rbp_article_content() {
	global $post;

	$img = genesis_get_image( array( 'format' => 'html', 'size' => 'partner-image', 'attr' => array( 'class' => 'partner-image' ) ) );
	$link = get_the_permalink();
	printf( '%s', '<a href="' . $link . '">' . $img . '</a>' );
	
	?>
	
	<p class="partner-name">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php edit_post_link( 'Edit this partner', '<br/><small>', '</small>' ); ?>
	</p>
	<?php
}

get_header();
do_action( 'genesis_loop' );
get_footer();