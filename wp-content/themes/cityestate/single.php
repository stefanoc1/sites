<?php

get_header();

// Define theme labels
global $theme_labels;

// Declare variables
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Get sidebar info
$sidebar_pos 	= get_post_meta( $post->ID, 'sidebar_position', true);
$sidebar_type	= get_post_meta( $post->ID, 'page_sidebar', true);
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false; ?>

<?php
if($sidebar_pos == "") {
	$sidebar_pos = "right";
	$sidebar_type = "right-sidebar";
	$have_sidebar = true;
} ?>
<section id="main-content" class="container">
	<div id="blog_page_information" class="blog_page_information"><?php
		// Left sidebar
		if( ('left' == $sidebar_pos) ) { ?>
			<aside class="col-md-4 col-sm-12 sidebar leftside" id="sidebar">
				<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
					<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
						<!-- Get dynamic left sidebar -->
						<?php dynamic_sidebar( $sidebar_type ); ?>
					</div>
				<?php endif; ?>
			</aside>
		<?php }

		// Check sidebar is active
		if( $have_sidebar ){ ?>
			<section class="col-md-8 cntt-w">
				<article><?php 
		}

		echo '<div class="row-wrapper-x">';
			if( have_posts() ): 
				while( have_posts() ): the_post();
					// Get post content
					$content = get_the_content();
					// Get post format					
					$post_format = get_post_format(get_the_ID());

					// Get post image status
					$post_featured_image = cityestate_option( 'post_featured_image' );

					// Post featured image is active
					if( !class_exists( 'ReduxFramework' ) || $post_featured_image && $post_format != "quote" ){						
						// post video
						$meta_video = get_post_meta( $post->ID, 'featured_video_meta', true);						
						
						// video post type
						if( 'video'  == $post_format || 'audio'  == $post_format){
							// Match video 	
							$pattern = '\\[' . '(\\[?)' . "(video|audio)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
							preg_match('/'.$pattern.'/s', $post->post_content, $matches);
							
							if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))){
								// Show post video
								$video = $matches[0];
								echo do_shortcode($video);	
								$content = preg_replace('/'.$pattern.'/s', '', $content);

							} else if( (!empty( $meta_video )) ){
								// Show post video
								echo do_shortcode($meta_video);
							}
						} else if( (!empty( $meta_video )) ){
							// Show video
							echo do_shortcode($meta_video);
						} else {
							// Show post thumbnail
							if( has_post_thumbnail() ){
								the_post_thumbnail( 'full' );
							}
						}						
					} ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>></div>
					<div class="blog-listing">
						<div class="blogtitlearchive">
							<!-- Show post title -->
							<h2 class="bolg-detail-title"><span class="titlebold"><?php the_title(); ?></span></h2>
							<?php
							// Check post date status
							$post_show_date = cityestate_option( 'post_show_date' );
							if( !class_exists( 'ReduxFramework' ) || $post_show_date ){
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
							if( !class_exists( 'ReduxFramework' ) || $post_show_author ){ ?>
								<!-- Show post author -->
								<span><?php the_author_posts_link(); ?></span><?php
							} ?>
							<hr class="underlineafterarchive">
						</div>
					</div><?php

					// Check post is quote type
					if( 'quote' == $post_format  ) echo '<blockquote>';

					// Show post content
					echo apply_filters( 'the_content', $content );

					if( 'quote' == $post_format  ) echo '</blockquote>';

					// Check show post author detail
					$post_show_author_detail = cityestate_option( 'post_show_author_detail' );

					if( $post_show_author_detail ){
						// Get post author id and image
						$author_id			= get_post_field( 'post_author', $post->ID );
	            		$author_image 		= get_the_author_meta( 'user_custom_image' );
						
						// Check author image
						if( empty($author_image) ){
							preg_match("/src='(.*?)'/i", get_avatar( get_the_author_meta( 'user_email' ), 250 ), $matches );
							$author_image = $matches[1];
						}

						// Get author details
						$author_dis_name		= get_the_author_meta( 'display_name' );
						$author_first_name		= get_the_author_meta( 'first_name' );
						$author_last_name		= get_the_author_meta( 'last_name' );
						$author_description		= get_the_author_meta( 'description' );
	            		$user_facebook_link		= get_the_author_meta( 'user_facebook_link' );            		
	            		$user_twitter_link		= get_the_author_meta( 'user_twitter_link' );
	            		$user_linkedin_link		= get_the_author_meta( 'user_linkedin_link' );
	            		$user_googleplus_link	= get_the_author_meta( 'user_googleplus_link' );
	            		$user_youtube_link		= get_the_author_meta( 'user_youtube_link' );
	            		$user_instagram_link	= get_the_author_meta( 'user_instagram_link' );
	            		$user_pinterest_link	= get_the_author_meta( 'user_pinterest_link' );
	            		$user_vimeo_link		= get_the_author_meta( 'user_vimeo_link' );
	            		$user_skype_id			= get_the_author_meta( 'user_skype_id' );

	            		// Set author first and last name
	            		if( empty($author_first_name) && empty($author_last_name) ){
	            			$author_name = $author_dis_name;
	            		} else {
	            			$author_name = $author_first_name . ' ' . $author_last_name;
	            		} 
	            		
							the_tags( '<span class="tag-links">', '', '</span>' );
	            		?>
	            		<?php if ($author_description != "") { ?>
		            		<div class="display_blog_author">
		            			<!-- Author section title -->
								<h3><?php echo esc_html($theme_labels['about_author']); ?></h3>						
								<div class="author_style">
									<div class="row">
										<div class="col-sm-3 col-xs-12">
											<img class="author-img" src="<?php echo esc_url($author_image); ?>" alt="<?php echo esc_attr($author_name); ?>">
											<div class="author_name">
												<!-- Author name -->
												<h4><?php printf( esc_html__( '%s', 'cityestate' ), $author_name ); ?></h4>
											</div>
										</div>
										<div class="col-sm-9 col-xs-12">
											<p class="author_message">
												<!-- Author description -->
												<?php printf( esc_html__( '%s', 'cityestate' ), $author_description ); ?>
											</p>
											<!-- Author name and link -->
											<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="author-post"><?php echo esc_html($theme_labels['view_all_post']); ?></a>
											<!-- Author social media -->
											<ul class="socials_author">
												<?php if( !empty($user_facebook_link) ){ ?><li><a href="<?php echo esc_url($user_facebook_link); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_twitter_link) ){ ?><li><a href="<?php echo esc_url($user_twitter_link); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_linkedin_link) ){ ?><li><a href="<?php echo esc_url($user_linkedin_link); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_googleplus_link) ){ ?><li><a href="<?php echo esc_url($user_googleplus_link); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_youtube_link) ){ ?><li><a href="<?php echo esc_url($user_youtube_link); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_instagram_link) ){ ?><li><a href="<?php echo esc_url($user_instagram_link); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_pinterest_link) ){ ?><li><a href="<?php echo esc_url($user_pinterest_link); ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_vimeo_link) ){ ?><li><a href="<?php echo esc_url($user_vimeo_link); ?>" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li><?php } ?>
												<?php if( !empty($user_skype_id) ){ ?><li><a href="skype:<?php echo esc_url($user_skype_id); ?>" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a></li><?php } ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
				endwhile;
			endif;
		echo '</div>';

		// Post link
		wp_link_pages();

		// Show post comments
		if( comments_open() || get_comments_number() ){
			comments_template();
		}
		
		
		// Check sidebar is active
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
	</div>
	<div class="vertical-space-100"></div>
</section>

<?php get_footer(); ?>