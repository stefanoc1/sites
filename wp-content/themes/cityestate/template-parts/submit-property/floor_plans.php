<?php 
// Get theme labels
global $theme_labels; ?>

<!-- Show floor plan section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_floor_title']); ?></h3>
    
<table class="floorplan-block">
    <tbody id="cityestate_floor_plans_main">
        <tr>
            <td class="action-field">
                <!-- Sort floor plan -->
                <span class="sort-floorplan-row"><i class="fa fa-navicon"></i></span>
            </td>
            <td class="sort-middle">
                <div class="row">
                    <div class="col-sm-4 col-lg-4 col-xs-12">
                        <div class="form-group">
                            <!-- Floor plan title -->
                            <input name="floor_plans[0][floor_plan_title]" type="text" id="floor_plan_title_0" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_floor_plan_title']); ?>">
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-xs-12">
                        <div class="form-group">
                            <!-- Floor plan room -->
                            <input name="floor_plans[0][floor_plan_room]" type="text" id="floor_plan_room_0" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_plan_bedrooms']); ?>">
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-xs-12">
                        <div class="form-group">
                            <!-- Floor plan bathroom -->
                            <input name="floor_plans[0][floor_plan_bathroom]" type="text" id="floor_plan_bathroom_0" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_floor_plan_bathroom']); ?>">
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-xs-12">
                        <div class="form-group">
                            <!-- Floor plan price -->
                            <input name="floor_plans[0][floor_plan_price]" type="text" id="floor_plan_price_0" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_floor_plan_price']); ?>">
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-xs-12">
                        <div class="form-group">
                            <!-- Floor plan size -->
                            <input name="floor_plans[0][floor_plan_size]" type="text" id="floor_plan_size_0" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_floor_plan_size']); ?>">
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-xs-12">
                        <div class="form-group">
                            <!-- Floor plan image upload -->
                            <div class="file-upload-block">
                                <input name="floor_plans[0][floor_plan_image]" type="text" id="floor_plan_image_0" class="floor_plan_image" placeholder="<?php echo esc_attr($theme_labels['sub_prop_floor_plan_image']); ?>">
                                <button id="0" class="floor_plan_img btn btn-primary"><?php esc_html_e( 'Upload', 'cityestate' ); ?></button>
                            </div>
                            <!-- Show upload error -->
                            <div id="plupload-container"></div>
                            <div id="errors-log"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <!-- Floor plan info -->
                        <textarea name="floor_plans[0][floor_plan_info]" rows="4" id="floor_plan_info_0" class="full-width-elements" placeholder="<?php echo esc_attr($theme_labels['sub_prop_plan_desc']); ?>"></textarea>
                    </div>
                </div>                
            </td>
            <td class="row-remove">
                <!-- Floor plan remove -->
                <span data-remove="0" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add floor plan -->
            <td><button data-increment="0" class="add-floorplan-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>