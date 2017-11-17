<?php 

// Get theme label
global $theme_labels, $property_meta; ?>

<!-- Show flooring and goods section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_flo_gods_title']); ?></h3>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<!-- Property flooring detail -->
		<label for="property_flooring"><?php echo esc_html($theme_labels['sub_prop_flo_la']); ?></label>
		<textarea name="property_flooring" id="property_flooring" class="full-width-elements margin-bottom-15" placeholder="<?php echo esc_attr($theme_labels['sub_prop_flo_pl']); ?>"><?php if( isset( $property_meta['flooring_detail'] ) ) { echo sanitize_text_field( $property_meta['flooring_detail'][0] ); } ?></textarea>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<!-- Property goods detail -->
		<label for="property_goods"><?php echo esc_html($theme_labels['sub_prop_goods_la']); ?></label>
		<textarea name="property_goods" id="property_goods" class="full-width-elements margin-bottom-15" placeholder="<?php echo esc_attr($theme_labels['sub_prop_goods_pl']); ?>"><?php if( isset( $property_meta['goods_detail'] ) ) { echo sanitize_text_field( $property_meta['goods_detail'][0] ); } ?></textarea>
	</div>
</div>