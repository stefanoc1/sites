<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage City_Estate
 * @since City Estate 1.0
 */

get_header();

// Declare variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Get archive page detail
$page_for_posts = get_option( 'page_for_posts' );
$sidebar_pos    = get_post_meta( $page_for_posts, 'sidebar_position', true );
$sidebar_type   = get_post_meta( $page_for_posts, 'page_sidebar', true );
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false; ?>

<?php
if($sidebar_pos == "") {
	$sidebar_pos = "right";
	$sidebar_type = "right-sidebar";
	$have_sidebar = true;
} ?>

<section id="main-content" class="container">
	<div id="blog_page_information" class="blog_page_information"><?php
	// Left Sidebar
	if( ('left' == $sidebar_pos) ) { ?>
		<aside class="col-md-4 col-sm-12 sidebar leftside" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Show left sidebar -->
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

	echo '<div class="row-wrapper-x">			
			<div class="blog-listing">';
				// Check posts is available
				if( have_posts() ): 
					while( have_posts() ): the_post(); ?>			
						<div class="blog1">
							<div class="blogthumbanil"><?php 
								// Get featured image status
								$blog_featured_image = cityestate_option( 'blog_featured_image' );
								
								if( !class_exists( 'ReduxFramework' ) || $blog_featured_image ){
									// Get post format
									$post_format = get_post_format(get_the_ID());
									$meta_video  = get_post_meta( $post->ID, 'featured_video_meta', true );
									
									// video post type
									if( 'video'  == $post_format || 'audio'  == $post_format) {
										// match and find video code
										$pattern = '\\[' .'(\\[?)' ."(video|audio)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
										preg_match('/'.$pattern.'/s', $post->post_content, $matches);
										// Check and find any match
										if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))) {
											// Show video
											$video = $matches[0];
											echo do_shortcode($video);
											$content = preg_replace('/'.$pattern.'/s', '', $video);
										} else if( (!empty( $meta_video )) ) {
											// Show video
											echo do_shortcode($meta_video);
										}
									// Gallery post type
									} else if( 'gallery'  == $post_format) {		
										$pattern = '\\[' .'(\\[?)' ."(gallery)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
										preg_match('/'.$pattern.'/s', $post->post_content, $matches);
										// Check and find any match
										if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
											// Show gallery
											$ids = (shortcode_parse_atts($matches[3]));
											if(is_array($ids) && isset($ids['ids'])) $ids = $ids['ids'];
												echo do_shortcode('[vc_gallery onclick="link_no" img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'"  custom_links_target="_self"]');
											// Show gallery
											$content = preg_replace('/'.$pattern.'/s', '', $content);
										}	
									} else {
										// Check post thumbnail is exit
										if( has_post_thumbnail() ){
											// Show post thumbnail
											the_post_thumbnail( 'full' );
										} else {
											// Show default blog image
											$blog_no_image = cityestate_option( 'blog_no_image' );
											if( !class_exists( 'ReduxFramework' ) || $blog_no_image ){
												// Get blog image src
												$blog_no_image_src = cityestate_option( 'blog_no_image_src', 'url' );
																				
											}
										}
									}
								} ?>
							</div>
							<div class="blogtitlearchive">								
								<!-- Show post title -->
								<h2><span class="titlebold"><?php the_title(); ?></span></h2><?php 								
								// Post date is show
								$blog_show_date = cityestate_option( 'blog_show_date' );
								if( !class_exists( 'ReduxFramework' ) || $blog_show_date ){
									// Get post date format
									$archive_year  = get_the_time('Y',$post->ID); 
									$archive_month = get_the_time('m',$post->ID); 
									$archive_day   = get_the_time('d',$post->ID); ?>
									<span>
										<!-- Show post date with link -->
										<a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
											<?php the_time( get_option( 'date_format' ) ); ?>
										</a>
									</span><?php
								}
								
								// Post author is show
								$blog_show_author = cityestate_option( 'blog_show_author' );
								if( !class_exists( 'ReduxFramework' ) || $blog_show_author){ ?>
									<!-- Get post author -->
									<span><?php the_author_posts_link(); ?></span><?php
								} ?>								
								<hr class="underlineafterarchive">
							</div><?php
							// Show post excerpt
							$blog_show_excerpt = cityestate_option( 'blog_show_excerpt' );
							if( !class_exists( 'ReduxFramework' ) || $blog_show_excerpt ){
								// Show post excerpt
								$blog_excerpt_limit = cityestate_option('blog_excerpt_list'); 
								if(empty($blog_excerpt_limit) || $blog_excerpt_limit == "") {
									$blog_excerpt_limit = 30;
								} ?>

								<p><?php echo wp_trim_words( get_the_excerpt(), $blog_excerpt_limit, '....' ); ?></p><?php
							}
							
							// Get read more text from backend
							$blog_readmore_text = cityestate_option( 'blog_readmore_text' ); ?>							
							<!-- Show read more post link -->
							<div class="readmorebutton"> 
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="readmore">
									<?php 
										if( !empty($blog_readmore_text) && $blog_readmore_text != "" ) {
											printf( esc_html__( '%s', 'cityestate'), $blog_readmore_text); 
										} else {
											echo esc_html__("Read More", 'cityestate');
										}
									?>
								</a>
							</div> 
						</div><?php						
					endwhile;
				endif;
		echo '</div>			
		</div>';

		// Post Pagination
	    cityestate_pagination( $wp_query->max_num_pages, $range = 2 );
	    
	    // Reset wp query
	    wp_reset_postdata();

	// Show page link
	wp_link_pages();

	// Show page comment
	if( comments_open() || get_comments_number() ){
		comments_template();
	}

	// Check have sidebar
	if( $have_sidebar ){
		echo "</article></section>";
	}

	// Right sidebar
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