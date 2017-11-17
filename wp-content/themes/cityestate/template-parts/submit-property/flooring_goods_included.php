<?php 
// Get theme label
global $theme_labels; ?>

<!-- Show flooring and goods section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_flo_gods_title']); ?></h3>

<!-- Property flooring detail -->
<label for="property_flooring"><?php echo esc_html($theme_labels['sub_prop_flo_la']); ?></label>
<textarea name="property_flooring" id="property_flooring" class="full-width-elements margin-bottom-15" placeholder="<?php echo esc_attr($theme_labels['sub_prop_flo_pl']); ?>"></textarea>

<!-- Property goods detail -->
<label for="property_goods"><?php echo esc_html($theme_labels['sub_prop_goods_la']); ?></label>
<textarea name="property_goods" id="property_goods" class="full-width-elements margin-bottom-15" placeholder="<?php echo esc_attr($theme_labels['sub_prop_goods_pl']); ?>"></textarea>