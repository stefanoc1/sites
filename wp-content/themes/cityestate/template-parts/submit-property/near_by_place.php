<?php 
// Get them labels
global $theme_labels; ?>

<!-- Title of near by place section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_near_title']); ?></h3>
    
<table class="nearbyplace-block">
    <tbody id="cityestate_near_by_place_main">
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
                            <select name="near_by_place[0][place_type]" id="place_type_0" class="full-width-elements">
                                <option selected="selected" value=""><?php esc_html_e( 'Select Place', 'cityestate' ); ?></option><?php
                                // Get near by place type
                                $cityestate_google_places = cityestate_near_by_places();
                                foreach( $cityestate_google_places as $key => $value ){ ?>
                                    <option value="<?php echo esc_attr($key); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $value ); ?></option><?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="form-group">
                            <!-- Upload near by place icon -->
                            <div class="file-upload-block">
                                <input name="near_by_place[0][place_image]" type="text" id="place_image_0" class="place_image">
                                <button id="near_by_place_0" class="nearbyplace btn btn-primary"><?php esc_html_e( 'Upload', 'cityestate' ); ?></button>
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
                <span data-remove="0" class="remove-near-row remove"><i class="fa fa-remove"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add near by place row -->
            <td><button data-increment="0" class="add-near-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>