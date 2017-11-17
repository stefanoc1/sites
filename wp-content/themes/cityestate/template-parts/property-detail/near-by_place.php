<?php global $tab_class; ?>
<!-- Property near by place -->
<div id="near_by_place" class="property_nearbyplace property-detail-section <?php echo esc_attr($tab_class); ?>">
	<!-- Near by place section title -->
	<h3 class="title"><?php esc_html_e( 'Near by Place','cityestate' ); ?></h3>
	<div class="placemap">
		<div id="property_single_map" style="width:100%;height:400px;"></div>
		<!-- Near by place security -->
		<?php wp_nonce_field( 'cityestate_map_ajax_nonce', 'property_detail_google_map', true ); ?>
        <input type="hidden" name="property_id" class="property_id" value="<?php echo esc_attr($post->ID); ?>" />
		<div id="property_single_near_place"></div>
	</div>
</div>

	