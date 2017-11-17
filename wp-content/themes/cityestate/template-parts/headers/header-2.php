<?php

// Get theme label
global $theme_labels;

// Get header option
$transparent_logo 	= cityestate_option( 'header_transparent_logo', 'url' );
$layout_width		= cityestate_option( 'header_layout_width' );
$menu_alignment		= cityestate_option( 'header_menu_alignment' );
$is_sticky			= cityestate_option( 'header_menu_is_sticky' );
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

$logout     	= cityestate_option( 'header_top_bar_logout' );

// Check menu is sticky
$sticky_menu = "";
if( $is_sticky ){
	$sticky_menu = "sticky";
}

// Check transparent logo
if( empty( $transparent_logo ) ){
	$transparent_logo = get_template_directory_uri() . '/images/logo.png';
} ?>
<header>
	<div class="header">		
		<div class="agent-home-page-header second-header home-variation-two">
			<div class="<?php echo esc_attr($sticky_menu); ?>">
				<div class="menu">
					<nav class="navbar navbar-default">
					  	<div class="<?php echo esc_attr($layout_width); ?>">
					    	<!-- Brand and toggle get grouped for better mobile display -->
					   		<div class="navbar-heade1r">
					      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							        <span class="sr-only">Toggle navigation</span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							     </button>
					      		<!-- Theme logo -->
					      		<div class="header-transparent">
					      			<a class="navbar-brand logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<?php					
										if( !empty( $transparent_logo ) ) { ?>
											<img src="<?php echo esc_url( $transparent_logo ); ?>" alt="logo">
										<?php } ?>
									</a>
								</div>
					    	</div>
					
						    <!-- Collect the nav links, forms, and other content for toggling -->
						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						      	<?php
				                // Pages Menu				                
				                if ( has_nav_menu( 'main-menu' ) ) :
				                	wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s" class="nav navbar-nav nav_link '.$menu_alignment.'">%3$s',  'walker' => new cityestate_menu_walker() ) );
				                endif;
				                // Get header button
				                $header_button = cityestate_option( 'header_menu_with_button' );
				                if( $header_button == 'submit_property' ){
				                	$header_menu_url = cityestate_option( 'header_menu_url' );
				                	if(empty($header_menu_url)) {
				                		$header_menu_url[0] = "";
				                	}			     

				                	// Check user is login
									if( !is_user_logged_in() ){
									
				                	// Submit property button
				                		echo '<li class="submit-property"><a href="#" data-toggle="modal" data-target="#ce-login-model">'.$theme_labels['menu_submit_property'].'</a></li>';
				                	} else {
				                		echo '<li class="submit-property"><a href="'.get_permalink($header_menu_url[0]).'">'.$theme_labels['menu_submit_property'].'</a></li>';
				                	}
				                } else if( $header_button == 'login_register' ){
				                	if(!is_user_logged_in()) {
					                	// login or register button
					                	echo '<li class="usermenu left"><a href="#" data-toggle="modal" data-target="#ce-login-model">'.$theme_labels['menu_login'].'</a></li>';
							        	echo '<li class="usermenu right"><a href="#" data-toggle="modal" data-target="#ce-login-model">'.$theme_labels['menu_signup'].'</a></li>';
							        } else { ?>
							        	<li>
											<a href="javascript:void(0);"><?php echo esc_html($current_user->user_firstname). ' ' .esc_html($current_user->user_lastname); ?> </a>
											<ul class="sub-menu">		
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

							     <?php   }

				                } else if( $header_button == 'book_now' ){
				                	$header_menu_url = cityestate_option( 'header_menu_custom_url' );
				                	// Book now button
				                	echo '<li class="submit-property"><a href="'.esc_url($header_menu_url).'">'.$theme_labels['menu_book_now'].'</a></li>';						        	
				                } else if( $header_button == 'contact_me' ){
				                	$header_menu_url = cityestate_option( 'header_menu_custom_url' );
				                	// Book now button
				                	echo '<li class="submit-property"><a href="'.esc_url($header_menu_url).'">'.$theme_labels['menu_contact_me'].'</a></li>';						        	
				                } ?>
				                </ul>
						    </div>
				 	 	</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div>
		<!-- Get header slider -->
		<?php get_template_part( 'template-parts/headers/slider-banner/slider_banner' ); ?>
	</div>
</header>