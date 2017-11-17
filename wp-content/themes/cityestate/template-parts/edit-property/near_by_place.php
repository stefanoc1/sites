<?php 
// Get them labels
global $theme_labels, $property_data;

// Get property near by place
$near_by_place = get_post_meta( $property_data->ID, 'near_by_place', true ); 

$count = 0; ?>

<!-- Title of near by place section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_near_title']); ?></h3>
    
<table class="nearbyplace-block">
    <tbody id="cityestate_near_by_place_main">
        <?php
        if( !empty($near_by_place) ){
            foreach( $near_by_place as $near_place ): ?>
                <tr>
                    <td class="action-field">
                        <!-- Near by place sort icon -->
                        <span class="sort-nearbyplace-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <td class="sort-middle">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <!-- Near by place type -->
                                    <select name="near_by_place[<?php echo esc_attr( $count ); ?>][place_type]" id="place_type_<?php echo esc_attr( $count ); ?>" class="full-width-elements">
                                        <!-- Get near by place type -->
                                        <?php cityestate_edit_near_place_options( $near_place['place_type'] ); ?>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <!-- Upload near by place icon -->
                                    <div class="file-upload-block">
                                        <input name="near_by_place[<?php echo esc_attr( $count ); ?>][place_image]" value="<?php echo esc_attr( $near_place['place_image'] ); ?>" type="text" id="place_image_<?php echo esc_attr( $count ); ?>" class="place_image">
                                        <button id="near_by_place_<?php echo esc_attr( $count ); ?>" class="nearbyplace btn btn-primary"><?php esc_html_e( 'Upload', 'cityestate' ); ?></button>
                                    </div>
                                    <!-- Show error or upload message of media -->
                                    <div id="plupload-container"></div>
                                    <div id="errors-log"></div>
                                </div>
                            </div>                    
                        </div>                
                    </td>
                    <td class="row-remove">
                        <!-- Remove near by place row -->
                        <span data-remove="<?php echo esc_attr( $count ); ?>" class="remove-near-row remove"><i class="fa fa-remove"></i></span>
                    </td>
                </tr><?php
                $count++;
            endforeach;
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add near by place row -->
            <td><button data-increment="<?php echo esc_attr( $count-1 ); ?>" class="add-near-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>