<?php
// Get them label
global $theme_labels, $property_data, $property_meta;

// Get property location status
$property_location  = $floor_plans = get_post_meta( $property_data->ID, 'property_location', true );
$property_location  = explode( ",", $property_location );
$show_property_location = cityestate_option( 'show_property_location' ); ?>

<!-- Show property location section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_location_title']); ?></h3>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property geocomplete -->
        <input class="full-width-elements margin-top-15" name="property_map_address" value="<?php if( isset( $property_meta['property_map_address'] ) ) { echo sanitize_text_field( $property_meta['property_map_address'][0] ); } ?>" id="geocomplete" placeholder="<?php echo esc_attr($theme_labels['property_map_address_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property selected area --><?php 
        if( $show_property_location == 'yes' ) { ?>
            <select name="property_area" id="property_area" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                <!-- Get property area -->
                <?php cityestate_edit_hierarchichal_options( $property_data->ID, 'property_area' ); ?>
            </select><?php
        } else { ?>
            <input class="full-width-elements margin-top-15" name="property_area" value="<?php echo cityestate_category_by_property_id( $property_data->ID, 'property_area' ); ?>" id="property_area" placeholder="<?php echo esc_attr($theme_labels['property_area_pl']); ?>"><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
    <?php 
        // Property location
        if( $show_property_location == 'yes' ){ ?>
            <select name="property_city" id="property_city" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                <!-- Get property location -->
                <?php cityestate_edit_hierarchichal_options( $property_data->ID, 'property_city' ); ?>
            </select><?php 
        } else { ?>
            <input class="full-width-elements margin-top-15" name="property_city" value="<?php echo cityestate_category_by_property_id( $property_data->ID, 'property_city' ); ?>" id="property_city" placeholder="<?php echo esc_attr($theme_labels['property_city_pl']); ?>"><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">          
        <?php 
        // Property state or country
        if( $show_property_location == 'yes' ){ ?>
            <select name="property_location" id="property_location" class="selectpicker full-width-elements margin-top-15" data-live-search="true" data-live-search-style="begins">
                <!-- Get property state or country -->
                <?php cityestate_edit_hierarchichal_options( $property_data->ID, 'property_location' ); ?>
            </select><?php 
        } else { ?>
            <input class="full-width-elements margin-top-15" name="property_location" value="<?php echo cityestate_category_by_property_id( $property_data->ID, 'property_location' ); ?>" id="property_location" placeholder="<?php echo esc_attr($theme_labels['property_location_pl']); ?>"><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property post code -->
        <input class="full-width-elements margin-top-15" name="postal_code" value="<?php if( isset( $property_meta['property_zip'] ) ) { echo sanitize_text_field( $property_meta['property_zip'][0] ); } ?>" id="zip" placeholder="<?php echo esc_attr($theme_labels['postal_code_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Show property google map -->
        <div class="map_canvas" id="map"></div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button id="find" class="btn btn-primary btn-block margin-top-15"><?php echo esc_html($theme_labels['reset_label']); ?></button>
        <a id="reset" href="#" style="display:none;"><?php echo esc_html($theme_labels['reset_btn']); ?></a>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property latitude -->
        <input class="full-width-elements margin-top-15" name="latitude" value="<?php echo sanitize_text_field( $property_location[0] ); ?> "id="latitude" placeholder="<?php echo esc_attr($theme_labels['latitude_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property longitude -->
        <input class="full-width-elements margin-top-15" name="longitude" value="<?php echo sanitize_text_field( $property_location[1] ); ?>" id="longitude" placeholder="<?php echo esc_attr($theme_labels['longitude_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <select name="property_google_street_view" id="property_google_street_view" class="selectpicker full-width-elements margin-top-15" data-live-search="false" data-live-search-style="begins">
            <!-- Check property street view -->
            <option <?php selected( $property_meta['property_street_view'][0], 'hide' ); ?> value="hide"><?php esc_html_e( 'Hide', 'cityestate' ); ?></option>
            <option <?php selected( $property_meta['property_street_view'][0], 'show' ); ?> value="show"><?php esc_html_e( 'Show', 'cityestate' ); ?></option>    
        </select>
    </div>
</div>