<?php global $tab_class; ?>
<!-- Property direction map -->
<div id="get_directions" class="get_direction property-detail-section <?php echo esc_attr($tab_class); ?>">
	<!-- Get direction title -->
	<h3 class="title"><?php esc_html_e( 'Get Directions','cityestate' ); ?></h3>
	<div class="placemap">
		<div id="property_get_direction" style="width:100%;height:405px;"></div>
		<!-- Google map security -->
		<?php wp_nonce_field( 'cityestate_map_ajax_nonce', 'property_detail_google_map1', true ); ?>
		<input type="hidden" name="property_id" class="property_id" value="<?php echo esc_attr($post->ID); ?>" />
		<div class="get-direction">
			<form class="search-header">
				<!-- Find auto complete address -->
				<input class="keyword search-field" name="keyword" id="GetDirectionsAddress" placeholder="<?php esc_html_e( 'Type Address', 'cityestate' ); ?>" type="text">
				<input class="search-field submit-search" name="search" value="<?php esc_html_e( 'Get Directions', 'cityestate' ); ?>" id="GetDirections" type="submit">
			</form>
		</div>
	</div>
</div>