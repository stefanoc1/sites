<?php

// Get footer detail
$footer_bottom 	= cityestate_option('cityestate_footer_bottom_enable');
$bottom_left 	= cityestate_option('cityestate_footer_bottom_left');
$bottom_right 	= cityestate_option('cityestate_footer_bottom_right');
$footer_logo 	= cityestate_option('cityestate_footer_logo');	
if(empty($footer_logo['url'])) {
	$footer_logo['url']= get_template_directory_uri()."/images/logos/logo.png";
}
// Footer logo and copyright text
$footer_logo 		= '<img src="'.esc_url($footer_logo['url']).'" width="65" alt="'.esc_attr(get_bloginfo( "name" )).'">';
$footer_copyright 	= '<p>'.esc_html(cityestate_option('cityestate_footer_copyright')).'</p>';

// Footer menu
$footer_menu = "";
if( has_nav_menu('footer-menu') ){
	$menuParameters = array( 'theme_location' => 'footer-menu', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'depth' => 0 );
	$footer_menu = strip_tags( wp_nav_menu( $menuParameters ), '<a>' );
} ?>

<!-- Footer bottom -->
<div class="footer-second">
	<div class="footer-navi pull-left"><?php 
		switch( $bottom_left ){
			case 1: 
				// Footer logo
				echo $footer_logo;
			break;

			case 2:	
				// Footer menu
				echo $footer_menu;
			break;

			case 3:	
				// Footer copyright text
				echo $footer_copyright;
			break;
		} ?>
	</div>
	<!-- Footer bottom -->
	<div class="footer-navi pull-right"><?php
		switch( $bottom_right ){
			case 1: 
				// Footer logo
				echo $footer_logo;
			break;

			case 2:	
				// Footer menu
				echo $footer_menu;
			break;

			case 3:	
				// Footer copyright text
				echo $footer_copyright;
			break;
		} ?>
	</div>
</div>