<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage City_Estate
 * @since City Estate 1.0
 */
// Set default right sidebar
if( is_active_sidebar( 'right-sidebar' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<!-- Call right sidebar -->
		<?php dynamic_sidebar( 'right-sidebar' ); ?>
	</aside>
<?php endif; ?>
