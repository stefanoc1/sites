<?php

get_header();
// Declare variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Get archive page detail
$sidebar_pos 	= get_post_meta( $post->ID, 'sidebar_position' , true);
$sidebar_type	= get_post_meta( $post->ID, 'page_sidebar' , true);
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false; ?>

<?php
if($sidebar_pos == "") {
	$sidebar_pos = "right";
	$sidebar_type = "right-sidebar";
	$have_sidebar = true;
} ?>

<?php 
	$vc_enabled = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true); 
	$blog_page_info_style = "";
	if($vc_enabled) {
		$blog_page_info_style = 'style="margin: 0px !important;height: 0px !important"';
	}
?>

<section id="main-content" class="container">
	<div class="blog_page_information" <?php echo $blog_page_info_style; ?>><?php
	
                        
// Left Sidebar
if( ('left' == $sidebar_pos) ) { ?>
	<aside class="col-md-4 col-sm-12 sidebar leftside" id="sidebar">
		<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
			<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
				<!-- Show left sidebar -->
				<?php dynamic_sidebar( $sidebar_type ); ?>
			</div>
		<?php endif; ?>
	</aside>
<?php }

// Check have sidebar
if( $have_sidebar ){ 
	?>
	<section class="col-md-8 cntt-w">
		<article>
		<div class="blog-listing">
			<div class="blogtitlearchive">
				<!-- Show post title -->
				<h2 class="bolg-detail-title"><span class="titlebold"><?php the_title(); ?></span></h2>
				<?php
				// Check post date status
				$post_show_date = cityestate_option( 'post_show_date' );
				if( $post_show_date ){
					// Get post date
					$archive_year  = get_the_time('Y',$post->ID); 
					$archive_month = get_the_time('m',$post->ID); 
					$archive_day   = get_the_time('d',$post->ID); ?>
					<span>
						<a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
							<!-- Show post date -->
							<?php the_time( get_option( 'date_format' ) ); ?>
						</a>
					</span><?php
				} 
				// Check post author status
				$post_show_author = cityestate_option('post_show_author'); 
				if( $post_show_author ){ ?>
					<!-- Show post author -->
					<span><?php the_author_posts_link(); ?></span><?php
				} ?>
				<hr class="underlineafterarchive">
			</div>
		</div>
		<?php 

}
	// Check posts is available
	if( have_posts() ): 
		while( have_posts() ): the_post(); ?>
			<?php the_content();
		endwhile;
	endif;	

// Show page link
wp_link_pages();

	// Show page comment
	if( comments_open() || get_comments_number() ){
		comments_template();
		next_comments_link();
		previous_comments_link();
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	}

// Check have sidebar
if( $have_sidebar ){
	echo "</article></section>";
}

// Right Sidebar
if( ('right' == $sidebar_pos) ){ ?>
	<aside class="col-md-4 col-sm-12 sidebar" id="sidebar">
		<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
			<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
				<!-- Show right sidebar -->
				<?php dynamic_sidebar( $sidebar_type ); ?>
			</div>
		<?php endif; ?>
	</aside>
<?php } ?>
</div>
</section>

<?php get_footer(); ?>