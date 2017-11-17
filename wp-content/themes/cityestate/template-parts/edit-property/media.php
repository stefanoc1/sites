<?php 
// Declare global variable
global $theme_labels, $property_data; ?>

<!-- Show title of media section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_medi_title']); ?></h3>
<div class="property-media">
    <div class="media-gallery">
        <div class="row">
            <div id="submit_property_media_outer"><?php
                // Get property image
                $property_images    = get_post_meta( $property_data->ID, 'property_images', false );
                $featured_image_id  = get_post_thumbnail_id( $property_data->ID );
                $property_images[]  = $featured_image_id;
                $property_images    = array_unique( $property_images );

                foreach( $property_images as $property_image_id ){
                    // Check is featured image
                    $is_featured_image  = ( $featured_image_id == $property_image_id );
                    $featured_icon      = ( $is_featured_image ) ? 'fa-star' : 'fa-star-o';

                    // Media uploader
                    echo '<div class="col-sm-2">';
                        echo '<figure class="gallery-thumb">';
                            echo wp_get_attachment_image( $property_image_id, 'thumbnail' );;
                            echo '<a class="icon remove-image" data-property-id="'.intval($property_data->ID).'" data-attachment-id="'.intval($property_image_id).'" href="javascript:;">';
                                echo '<i class="fa fa-trash-o"></i>';
                            echo '</a>';
                            echo '<a class="icon icon-fav mark-featured" data-property-id="'.intval($property_data->ID).'" data-attachment-id="'.intval($property_image_id).'" href="javascript:;">';
                                echo '<i class="fa '.esc_attr($featured_icon).'"></i>';
                            echo '</a>';
                            echo '<input type="hidden" class="propperty-image-id" name="propperty_image_ids[]" value="'.intval($property_image_id).'">';
                            echo '<span style="display: none;" class="icon remove-loader">';
                                echo '<i class="fa fa-spinner fa-spin"></i>';
                            echo '</span>';
                            if ( $is_featured_image ) {
                                echo '<input type="hidden" class="featured_image_id" name="featured_image_id" value="' . intval($property_image_id ). '">';
                            }
                        echo '</figure>';
                    echo '</div>';
                } ?>
            </div>
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