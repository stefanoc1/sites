<?php 
// Get theme labels
global $theme_labels, $property_meta; ?>

<!-- Title of property video section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_video_title']); ?></h3>

<!-- Property video placeholder image -->
<input name="property_video_url" type="text" value="<?php if( isset( $property_meta['property_video_url'] ) ) { echo sanitize_text_field( $property_meta['property_video_url'][0] ); } ?>" name="property_video_url" id="property_video_url" class="" placeholder="<?php echo esc_attr($theme_labels['sub_prop_video_pl']); ?>">

<!-- Upload property media image -->
<div class="video_parent file-upload-block">
    <input name="property_video_image" type="text" value="<?php if( isset( $property_meta['property_video_image'] ) ) { echo sanitize_text_field( $property_meta['property_video_image'][0] ); } ?>" id="floor_plan_image_0" class="property_video_image">
    <button id="video_image" class="video_image btn btn-primary"><?php esc_html_e( 'Upload', 'cityestate' ); ?></button>
</div>
<!-- Show error or message of media upload -->
<div id="plupload-container"></div>
<div id="errors-log"></div>