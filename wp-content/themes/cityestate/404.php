<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage City_Estate
 * @since City Estate 1.0
 */

get_header();

// Get 404 page title and description
$title 			= cityestate_option( '404_title' );
$description 	= cityestate_option( '404_description' );
if(!class_exists( 'ReduxFramework' )) {
	$title 			= "Oh oh! Page not found.";
	$description 	= "We're sorry, the page you are looking for doesn't exist.
						<br>
						You can search your topic using the box below or return to the homepage.";
} ?>
<section class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="vertical-space-60"></div>
			<section class="error-404 not-found">
				<header class="page-header">
					<!-- 404 page title -->
					<h1 class="page-title"><strong><?php printf( esc_html__( '%s', 'cityestate' ), $title ); ?></strong></h1>
				</header>
				<!-- 404 page content -->
				<div class="page-content">
					<p><?php printf( esc_html__( '%s', 'cityestate' ), $description ); ?></p>
					<div class="vertical-space-10"></div>
					<!-- Show search form -->
					<?php get_search_form(); ?>
				</div>
			</section>
			<div class="vertical-space-100"></div>
		</main>
	</div>
</section>
<?php get_footer(); ?>
