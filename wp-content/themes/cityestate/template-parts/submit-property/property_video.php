<?php 
// Get theme labels
global $theme_labels; ?>

<!-- Title of property video section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_video_title']); ?></h3>
<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4">
		<!-- Property video placeholder image -->
		<input name="property_video_url" type="text" name="property_video_url" id="property_video_url" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_video_pl']); ?>">
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4">
		<!-- Upload property media image -->
		<div class="video_parent file-upload-block">
		    <input name="property_video_image" type="text" id="floor_plan_image_0" class="property_video_image">
		    <button id="video_image" class="video_image btn btn-primary"><?php esc_html_e( 'Upload', 'cityestate' ); ?></button>
		</div>
	</div>
</div>
<!-- Show error or message of media upload -->
<div id="plupload-container"></div>
<div id="errors-log"></div>