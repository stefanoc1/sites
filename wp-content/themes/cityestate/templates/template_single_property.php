<?php

/*
	Template Name: Single Property Homepage
*/

get_header();

// Define sidebar variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Set sidebar info
$sidebar_pos 	= get_post_meta( $post->ID, 'sidebar_position' , true);
$sidebar_type	= get_post_meta( $post->ID, 'page_sidebar' , true);
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false; ?>

<section id="main-content" class="container"><?php
	// Left sidebar
	if( ('left' == $sidebar_pos) ) { ?>
		<aside class="col-md-4 col-sm-12 sidebar leftside" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic left sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php }

	// Check have sidebar
	if( $have_sidebar ){ ?>
		<section class="col-md-8 cntt-w">
			<article><?php 
	}

	echo '<div class="row-wrapper-x">';
		if( have_posts() ): 
			while( have_posts() ): the_post();
				// Page content
				the_content();
			endwhile;
		endif;	
	echo '</div>';

	// Check have sidebar
	if( $have_sidebar ){
		echo "</article></section>";
	}

	// Right sidebar
	if( ('right' == $sidebar_pos) ){ ?>
		<aside class="col-md-4 col-sm-12 sidebar" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic right sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php } ?>
</section>

<?php get_footer(); ?>