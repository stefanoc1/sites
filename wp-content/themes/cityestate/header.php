<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage City_Estate
 * @since City Estate 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
// Declare theme labels
global $theme_labels;

// Get theme labels
$theme_labels = cityestate_get_labels();

// Get header style
$header_style_type = cityestate_option( 'header_style_type' );

// Include login and register modal
get_template_part( 'template-parts/headers/login-register', 'model' );

// Check header style is define
if( empty($header_style_type) ){
	$header_style_type = '1';
}

// Include header type template
get_template_part( 'template-parts/headers/header-'.$header_style_type );

?>