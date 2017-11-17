<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage City_Estate
 * @since City Estate 1.0
 */

?>
<?php 
$footer_background_image_code = "";
$footer_background_image 	= cityestate_option('cityestate_footer_background_image');	
if( !empty($footer_background_image) && $footer_background_image != "" ) {
	$footer_background_image_code = 'style="background-image:url('.esc_url($footer_background_image['url']).');"';
}
?>

<footer <?php echo esc_attr($footer_background_image_code); ?>>
	<?php if( !empty($footer_background_image) && $footer_background_image != "" ) { ?>
		<div class="foooer-outer-container">
	<?php } ?>
		<div class="container"><?php
			// Get top footer status
			$show_top_footer = cityestate_option( 'cityestate_footer_show' );
			if( $show_top_footer == 1 ){
				// Which page show top footer
				$footer_top_pages = cityestate_option( 'footer_top_pages' );
				// Show top footer only on home page
				if( $footer_top_pages == 'only_home'){
		            if( is_front_page() ){
		                get_template_part( 'template-parts/footers/top','footer' );
		            }
		        // Show top footer on all page
		        } else if( $footer_top_pages == 'all_pages' ){
		            get_template_part( 'template-parts/footers/top','footer' );

		        // Show top footer only on inner page
		        } else if( $footer_top_pages == 'only_innerpages' ){
		            if( !is_front_page() ){
		                get_template_part( 'template-parts/footers/top','footer' );
		            }
		        
		        // Show top footer in specific page
		        } else if( $footer_top_pages == 'specific_pages' ){
		        	$footer_top_selected_pages = cityestate_option( 'footer_top_selected_pages' );
		            if( is_page( $footer_top_selected_pages ) ){
		                get_template_part( 'template-parts/footers/top','footer' );
		            }
		        }
		    }

		    // Get bottom footer status
		    $show_bottom_footer = cityestate_option( 'cityestate_footer_bottom_enable' );
			if( $show_bottom_footer == 1 ){
				// Which page show bottom footer
				$footer_bottom_pages = cityestate_option( 'footer_bottom_pages');	 		
				// Show bottom footer only on home page
				if( $footer_bottom_pages == 'only_home'){
		            if( is_front_page() ){
		                get_template_part( 'template-parts/footers/bottom','footer' );
		            }
		        // Show bottom footer on all page
		        } else if( $footer_bottom_pages == 'all_pages' ){
		            get_template_part( 'template-parts/footers/bottom','footer' );

		        // Show bottom footer only on inner page
		        } else if( $footer_bottom_pages == 'only_innerpages' ){
		            if( !is_front_page() ){
		                get_template_part( 'template-parts/footers/bottom','footer' );
		            }
		        
		        // Show bottom footer in specific page
		        } else if( $footer_bottom_pages == 'specific_pages' ){
		        	$footer_bottom_selected_pages = cityestate_option( 'footer_bottom_selected_pages' );
		            if( is_page( $footer_bottom_selected_pages ) ){
		                get_template_part( 'template-parts/footers/bottom','footer' );
		            }
		        }
		    } ?>
		</div>
	<?php if( !empty($footer_background_image) && $footer_background_image != "" ) { ?>
		</div>
	<?php } ?>
</footer>

<!-- Show modal for image gallery -->
<div class="modal fade" id="image_lightbox" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<!-- Show modal close button -->
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<!-- Show modal title -->
				<h4 class="modal-title image_lightbox_label"><?php esc_html_e( 'Title','cityestate' ); ?></h4>
			</div>
			<!-- Show next previous arrow -->
			<div class="modal-body">
				<img src="javascript:void(0)" alt="propertyimg" class="img-responsive img-full">
				<button type="button" class="previous_image_btn"><span class="glyphicon glyphicon-menu-left"></span></button>
				<button type="button" class="next_image_btn"><span class="glyphicon glyphicon-menu-right"></span></button>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
