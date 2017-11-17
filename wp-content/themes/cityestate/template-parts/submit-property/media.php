<?php 
// Declare global variable
global $theme_labels, $show_submit_property_field, $required_submit_property_field; ?>

<!-- Show title of media section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_medi_title']); ?></h3>
<div class="property-media">
    <div class="media-gallery">
        <div class="row">
            <!-- Media uploader -->
            <div id="submit_property_media_outer"></div>
        </div>
    </div>
    <div id="drag-and-drop" class="media-drag-drop">
        <!-- Media drag and drop area -->
        <h4><i class="fa fa-cloud-upload"></i><?php echo esc_html($theme_labels['sub_prop_drag_drop']); ?></h4>
        <h4><?php esc_html_e( 'or', 'cityestate' ); ?></h4>
        <!-- Select media -->
        <a id="upload_media" href="javascript:;" class="btn btn-primary"><?php esc_html_e( 'Select Images', 'cityestate' ); ?></a>
    </div>
    <!-- Show error or info media upload -->
    <div id="plupload-container"></div>
    <div id="errors-log"></div>
</div>