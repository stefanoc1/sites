<?php
// Get top bar status
$bar_mobile = cityestate_option( 'header_top_bar_mobile' );
$bar_left 	= cityestate_option( 'header_top_bar_left' );
$bar_right 	= cityestate_option( 'header_top_bar_right' );

// Top bar detail
$call_text 		= cityestate_option( 'header_top_bar_call_text' );
$phone_number 	= cityestate_option( 'header_top_bar_phone_number' );
$bar_email		= cityestate_option( 'header_top_bar_email' );

// Social media
$social_text 		= cityestate_option( 'header_top_bar_social_text' );
$tob_par_facebook 	= cityestate_option( 'tob_par_facebook' );
$tob_par_twitter 	= cityestate_option( 'tob_par_twitter' );
$tob_par_google 	= cityestate_option( 'tob_par_google' );
$tob_par_pinterest 	= cityestate_option( 'tob_par_pinterest' );
$tob_par_youtube 	= cityestate_option( 'tob_par_youtube' );
$tob_par_dribbble 	= cityestate_option( 'tob_par_dribbble' );
$tob_par_vimeo 		= cityestate_option( 'tob_par_vimeo' );
$tob_par_linkedin 	= cityestate_option( 'tob_par_linkedin' );
$tob_par_rss 		= cityestate_option( 'tob_par_rss' );
$tob_par_instagram 	= cityestate_option( 'tob_par_instagram' );
$tob_par_flickr 	= cityestate_option( 'tob_par_flickr' );
$tob_par_reddit 	= cityestate_option( 'tob_par_reddit' );
$tob_par_delicious 	= cityestate_option( 'tob_par_delicious' );
$tob_par_lastfm 	= cityestate_option( 'tob_par_lastfm' );
$tob_par_tumblr 	= cityestate_option( 'tob_par_tumblr' );
$tob_par_skype 		= cityestate_option( 'tob_par_skype' );
$current_user = wp_get_current_user();

$my_profile_page 		= cityestate_option( 'my_profile_page' );
$my_properties_page 	= cityestate_option( 'my_properties_page' );
$submit_property_page 	= cityestate_option( 'submit_property_page' );
$favorite_property_page = cityestate_option( 'favorite_property_page' );
$saved_search_page 		= cityestate_option( 'saved_search_page' );
$invoice_page 			= cityestate_option( 'invoice_page' );


$my_profile_label 		= cityestate_option( 'my_profile_label' );
$my_properties_label 	= cityestate_option( 'my_properties_label' );
$submit_property_label 	= cityestate_option( 'submit_property_label' );
$favorite_property_label = cityestate_option( 'favorite_property_label' );
$saved_search_label 		= cityestate_option( 'saved_search_label' );
$invoice_label 			= cityestate_option( 'invoice_label' );


// Login or register is active
$login_register	= cityestate_option( 'header_top_bar_login_register' );
$logout     	= cityestate_option( 'header_top_bar_logout' );

// Top bar slogan
$bar_slogan = cityestate_option( 'header_top_bar_slogan' );

// Top bar show in mobile
$class = "";
if( $bar_mobile == 1 ){
	$class = "hide_in_mobile";
}

// Check top bar left side
if( $bar_left != 'none' && $bar_right != 'none' ){ ?>
	<div class="first-header <?php echo esc_attr($class); ?>">
		<?php if( $bar_left != 'none' ){ ?>
			<div class="<?php if( $bar_left == 'social_icons' ){ echo "social"; } ?> pull-left"><?php
				// Top bar contact info
				if( $bar_left == 'contact_info' ){ ?>
					<div class="contact-info">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $call_text ); ?></span>
						<h2><a href="tel:<?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?></a></h2>
					</div><?php
				} elseif ( $bar_left == 'social_icons' ){ ?>
					<!-- Top bar social media -->
					<span class="social-tag"><?php printf( esc_html__( '%s', 'cityestate' ), $social_text ); ?></span>
					<ul class="socials">
						<?php if( isset($tob_par_facebook) && !empty($tob_par_facebook) && $tob_par_facebook != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_facebook ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_twitter) && !empty($tob_par_twitter) && $tob_par_twitter != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_twitter ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_google) && !empty($tob_par_google) && $tob_par_google != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_google ); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_pinterest) && !empty($tob_par_pinterest) && $tob_par_pinterest != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_pinterest ); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_youtube) && !empty($tob_par_youtube) && $tob_par_youtube != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_youtube ); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_dribbble) && !empty($tob_par_dribbble) && $tob_par_dribbble != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_dribbble ); ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_vimeo) && !empty($tob_par_vimeo) && $tob_par_vimeo != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_vimeo ); ?>"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_linkedin) && !empty($tob_par_linkedin) && $tob_par_linkedin != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_linkedin ); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_rss) && !empty($tob_par_rss) && $tob_par_rss != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_rss ); ?>"><i class="fa fa-rss" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_instagram) && !empty($tob_par_instagram) && $tob_par_instagram != "#" ){ ?><li><a href="<?php echo esc_url(  $tob_par_instagram ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_flickr) && !empty($tob_par_flickr) && $tob_par_flickr != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_flickr ); ?>"><i class="fa fa-flickr" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_reddit) && !empty($tob_par_reddit) && $tob_par_reddit != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_reddit ); ?>"><i class="fa fa-reddit" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_delicious) && !empty($tob_par_delicious) && $tob_par_delicious != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_delicious ); ?>"><i class="fa fa-delicious" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_lastfm) && !empty($tob_par_lastfm) && $tob_par_lastfm != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_lastfm ); ?>"><i class="fa fa-lastfm" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_tumblr) && !empty($tob_par_tumblr) && $tob_par_tumblr != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_tumblr ); ?>"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_skype) && !empty($tob_par_skype) && $tob_par_skype != "#" ){ ?><li><a href="skype:<?php echo esc_url( $tob_par_skype ); ?>"><i class="fa fa-skype" aria-hidden="true"></i></a></li><?php } ?>
					</ul><?php
	            } elseif ( $bar_left == 'login_register' ){ ?>
	            	<!-- Login or register -->
	            	<?php if( !is_user_logged_in() ){ ?>
		            	<div class="usersection center">
							<ul>
								<li><a href="#" data-toggle="modal" data-target="#ce-login-model"><?php printf( esc_html__( '%s', 'cityestate' ), $login_register ); ?></a></li>
							</ul>
						</div>
					<?php } else { ?>
						<div class="usersection center">
							<ul>
								<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $logout ); ?></a></li>
							</ul>
						</div>
					<?php } 
	            } elseif ( $bar_left == 'contact_login_register' ){ ?>
	            	<!-- Login or register -->
	            	<?php if( !is_user_logged_in() ){ ?>
		            	<div class="usersection center">
							<ul>
								<li><a href="#" data-toggle="modal" data-target="#ce-login-model"><?php printf( esc_html__( '%s', 'cityestate' ), $login_register ); ?></a></li>
							</ul>
						</div>
					<?php } else { ?>
						<div class="usersection center">
							<ul>
								<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $logout ); ?></a></li>
							</ul>
						</div>
					<?php } ?>
					<!-- Contact info -->
					<div class="contact-info">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $call_text ); ?></span>
						<h2><a href="tel:<?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?></a></h2>
					</div><?php
				} elseif ( $bar_left == 'email_contact' ){ ?>
	            	<!-- Email contact -->
	            	<div class="contact-info email-info">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/message-white.png">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $bar_email ); ?></span>						
					</div>
					<!-- Contact detail -->
					<div class="contact-info">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $call_text ); ?></span>
						<h2><a href="tel:<?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?></a></h2>
					</div><?php
	            } elseif ( $bar_left == 'slogan' ){ ?>
	            	<!-- Slogan -->
	            	<p><?php printf( esc_html__( '%s', 'cityestate' ), $bar_slogan ); ?></p><?php
	            } elseif ( $bar_left == 'menu_bar' ){
	            	// Top bar menu
	            	if( has_nav_menu('top-menu') ){
						$menuParameters = array( 'theme_location' => 'top-menu', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'depth' => 0 );
						echo strip_tags( wp_nav_menu( $menuParameters ), '<a>' );
					}
	            } ?>
			</div>
		<?php }
		// Check top bar in right side
		if( $bar_right != 'none' ){ ?>
			<!-- Social media -->
			<div class="<?php if( $bar_right == 'social_icons' ){ echo "social"; } ?> pull-right"><?php
				// Contact info
				if( $bar_right == 'contact_info' ){ ?>
					<div class="contact-info">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $call_text ); ?></span>
						<h2><a href="tel:<?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?></a></h2>
					</div><?php
				} elseif ( $bar_right == 'social_icons' ){ ?>
					<!-- Social media -->
					<span class="social-tag"><?php printf( esc_html__( '%s', 'cityestate' ), $social_text ); ?></span>
					<ul class="socials">
						<?php if( isset($tob_par_facebook) && !empty($tob_par_facebook) && $tob_par_facebook != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_facebook ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_twitter) && !empty($tob_par_twitter) && $tob_par_twitter != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_twitter ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_google) && !empty($tob_par_google) && $tob_par_google != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_google ); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_pinterest) && !empty($tob_par_pinterest) && $tob_par_pinterest != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_pinterest ); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_youtube) && !empty($tob_par_youtube) && $tob_par_youtube != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_youtube ); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_dribbble) && !empty($tob_par_dribbble) && $tob_par_dribbble != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_dribbble ); ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_vimeo) && !empty($tob_par_vimeo) && $tob_par_vimeo != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_vimeo ); ?>"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_linkedin) && !empty($tob_par_linkedin) && $tob_par_linkedin != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_linkedin ); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_rss) && !empty($tob_par_rss) && $tob_par_rss != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_rss ); ?>"><i class="fa fa-rss" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_instagram) && !empty($tob_par_instagram) && $tob_par_instagram != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_instagram ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_flickr) && !empty($tob_par_flickr) && $tob_par_flickr != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_flickr ); ?>"><i class="fa fa-flickr" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_reddit) && !empty($tob_par_reddit) && $tob_par_reddit != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_reddit ); ?>"><i class="fa fa-reddit" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_delicious) && !empty($tob_par_delicious) && $tob_par_delicious != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_delicious ); ?>"><i class="fa fa-delicious" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_lastfm) && !empty($tob_par_lastfm) && $tob_par_lastfm != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_lastfm ); ?>"><i class="fa fa-lastfm" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_tumblr) && !empty($tob_par_tumblr) && $tob_par_tumblr != "#" ){ ?><li><a href="<?php echo esc_url( $tob_par_tumblr ); ?>"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li><?php } ?>
						<?php if( isset($tob_par_skype) && !empty($tob_par_skype) && $tob_par_skype != "#" ){ ?><li><a href="skype:<?php echo esc_url( $tob_par_skype ); ?>"><i class="fa fa-skype" aria-hidden="true"></i></a></li><?php } ?>
					</ul><?php
	            } elseif ( $bar_right == 'login_register' && !is_user_logged_in() ){ ?>
	            	<!-- Login or register -->
	            	<?php if( !is_user_logged_in() ){ ?>
		            	<div class="usersection center">
							<ul>
								<li><a href="#" data-toggle="modal" data-target="#ce-login-model"><?php printf( esc_html__( '%s', 'cityestate' ), $login_register ); ?></a></li>
							</ul>
						</div>
					<?php } else { ?>
						<div class="usersection center">
							<ul>
								<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $logout ); ?></a></li>
							</ul>
						</div>
					<?php } 
	            } elseif ( $bar_right == 'contact_login_register' ){ ?>
	            	<?php if( !is_user_logged_in() ){ ?>
		            	<!-- Login or register -->
		            	<div class="usersection center">
							<ul>
								<li><a href="#" data-toggle="modal" data-target="#ce-login-model"><?php printf( esc_html__( '%s', 'cityestate' ), $login_register ); ?></a></li>
							</ul>
						</div>
					<?php } else { ?>
						<div class="usersection center">
							<ul>
								<li>
									<?php echo esc_html($current_user->user_firstname). ' ' .esc_html($current_user->user_lastname); ?>
									<ul class="profile-list-page">		
										<li>
											<a href="<?php echo esc_url( get_permalink( $my_profile_page ) ); ?>">
												<?php echo esc_html($my_profile_label); ?>
											</a>
										</li>
										<li>
											<a href="<?php echo esc_url( get_permalink( $my_properties_page ) ); ?>">
												<?php echo esc_html($my_properties_label); ?>
											</a>
										</li>
										<li>
											<a href="<?php echo esc_url( get_permalink( $submit_property_page 	 ) ); ?>">
												<?php echo esc_html($submit_property_label); ?>
											</a>
										</li>
										<li>
											<a href="<?php echo esc_url( get_permalink( $favorite_property_page ) ); ?>">
												<?php echo esc_html($favorite_property_label); ?>
											</a>
										</li>
										<li>
											<a href="<?php echo esc_url( get_permalink( $saved_search_page  ) ); ?>">
												<?php echo esc_html($saved_search_label); ?>
											</a>
										</li>
										<li>
											<a href="<?php echo esc_url( get_permalink( $invoice_page ) ); ?>">
												<?php echo esc_html($invoice_label); ?>
											</a>
										</li>
										<li>
											<a href="<?php echo wp_logout_url( home_url() ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $logout ); ?></a>
										</li>		
									</ul>
								</li>
								
							</ul>
						</div>
					<?php } ?>
					<!-- Contact detail -->
					<div class="contact-info">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $call_text ); ?></span>
						<h2><a href="tel:<?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?></a></h2>
					</div><?php
				} elseif ( $bar_right == 'email_contact' ){ ?>
	            	<!-- Email address -->
	            	<div class="contact-info email-info">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/message-white.png">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $bar_email ); ?></span>						
					</div>
					<!-- Contact number -->
					<div class="contact-info">
						<span><?php printf( esc_html__( '%s', 'cityestate' ), $call_text ); ?></span>
						<h2><a href="tel:<?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $phone_number ); ?></a></h2>
					</div><?php
	            } elseif ( $bar_right == 'slogan' ){ ?>
	            	<!-- Slogan -->
	            	<p><?php printf( esc_html__( '%s', 'cityestate' ), $bar_slogan ); ?></p><?php
	            } elseif ( $bar_right == 'menu_bar' ){
	            	// Top menu bar
	            	if( has_nav_menu('top-menu') ){
						$menuParameters = array( 'theme_location' => 'top-menu', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'depth' => 0 );
						echo strip_tags( wp_nav_menu( $menuParameters ), '<a>' );
					}
	            } ?>
			</div>		
		<?php } ?>
	</div><?php
} ?>