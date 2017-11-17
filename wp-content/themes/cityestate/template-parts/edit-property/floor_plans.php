<?php 
// Get theme labels
global $theme_labels, $property_data;

// Get property floor plan
$floor_plans = get_post_meta( $property_data->ID, 'floor_plans', true ); 

$count = 0; ?>

<h3><?php echo esc_html($theme_labels['sub_prop_main_floor_title']); ?></h3>
    
<table class="floorplan-block">
    <tbody id="cityestate_floor_plans_main"><?php
        if( !empty($floor_plans) ){
            foreach( $floor_plans as $floorplans ): ?>
                <tr>
                    <!-- Sort floor plan -->
                    <td class="action-field">
                        <span class="sort-floorplan-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <td class="sort-middle">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <!-- Floor plan title -->
                                <div class="form-group">
                                    <input name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_title]" value="<?php echo esc_attr( $floorplans['floor_plan_title'] ); ?>" type="text" id="floor_plan_title_<?php echo esc_attr( $count ); ?>" class="">
                                </div>
                            </div>
                            <!-- Floor plan room -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_room]" value="<?php echo esc_attr( $floorplans['floor_plan_room'] ); ?>" type="text" id="floor_plan_room_<?php echo esc_attr( $count ); ?>" class="">
                                </div>
                            </div>
                            <!-- Floor plan bathroom -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_bathroom]" value="<?php echo esc_attr( $floorplans['floor_plan_bathroom'] ); ?>" type="text" id="floor_plan_bathroom_<?php echo esc_attr( $count ); ?>" class="">
                                </div>
                            </div>
                            <!-- Floor plan price -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_price]" value="<?php echo esc_attr( $floorplans['floor_plan_price'] ); ?>" type="text" id="floor_plan_price_<?php echo esc_attr( $count ); ?>" class="">
                                </div>
                            </div>
                            <!-- Floor plan size -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_size]" value="<?php echo esc_attr( $floorplans['floor_plan_size'] ); ?>" type="text" id="floor_plan_size_<?php echo esc_attr( $count ); ?>" class="">
                                </div>
                            </div>
                            <!-- Floor plan image upload -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="file-upload-block">
                                        <input name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_image]" type="text" value="<?php echo esc_attr( $floorplans['floor_plan_image'] ); ?>" id="floor_plan_image_<?php echo esc_attr( $count ); ?>" class="floor_plan_image ">
                                        <button id="<?php echo esc_attr( $count ); ?>" class="floor_plan_img btn btn-primary"><?php esc_html_e( 'Upload', 'cityestate' ); ?></button>
                                    </div>
                                    <!-- Show upload error -->
                                    <div id="plupload-container"></div>
                                    <div id="errors-log"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <!-- Floor plan info -->
                                <textarea name="floor_plans[<?php echo esc_attr( $count ); ?>][floor_plan_info]" rows="4" id="floor_plan_info_<?php echo esc_attr( $count ); ?>" class="full-width-elements"><?php echo esc_attr( $floorplans['floor_plan_info'] ); ?></textarea>
                            </div>
                        </div>                
                    </td>
                    <td class="row-remove">
                        <!-- Floor plan remove -->
                        <span data-remove="<?php echo esc_attr( $count ); ?>" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>
                    </td>
                </tr><?php
                $count++;
            endforeach;
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add floor plan -->
            <td><button data-increment="<?php echo esc_attr( $count-1 ); ?>" class="add-floorplan-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>