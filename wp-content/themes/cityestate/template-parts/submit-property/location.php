<?php

// Get them label
global $theme_labels;

// Get property location status
$property_location = cityestate_option( 'show_property_location' ); ?>

<!-- Show property location section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_location_title']); ?></h3>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property geocomplete -->
        <input class="full-width-elements" name="property_map_address" id="geocomplete" placeholder="<?php echo esc_attr($theme_labels['property_map_address_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4"><?php
        // Property selected area
        if( $property_location == 'yes' ){ ?>
            <select name="property_area" id="property_area" class="selectpicker full-width-elements margin-bottom-15" data-live-search="true" data-live-search-style="begins">
                <option selected="selected" value=""><?php esc_html_e( 'Select Area', 'cityestate' ); ?></option><?php
                // Get property area
                $property_area_terms = get_terms( array( "property_area" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_submit_hirarchical_options( 'property_area', $property_area_terms, -1 ); ?>
            </select><?php 
        } else { ?>
            <input class="full-width-elements" name="property_area" id="property_area" placeholder="<?php echo esc_attr($theme_labels['property_area_pl']); ?>"><?php 
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4"><?php
        // Property location
        if( $property_location == 'yes' ){ ?>
            <select name="property_city" id="property_city" class="selectpicker full-width-elements margin-bottom-15" data-live-search="true" data-live-search-style="begins">
                <option selected="selected" value=""><?php esc_html_e( 'Select City', 'cityestate' ); ?></option><?php
                // Get property location
                $property_cities_terms = get_terms( array( "property_city" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_submit_hirarchical_options( 'property_city', $property_cities_terms, -1 ); ?>
            </select><?php 
        } else { ?>
            <input class="full-width-elements" name="property_city" id="property_city" placeholder="<?php echo esc_attr($theme_labels['property_city_pl']); ?>"><?php 
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4"><?php
        // Property state or country
        if( $property_location == 'yes' ){ ?>
            <select name="property_location" id="property_location" class="selectpicker margin-bottom-15 full-width-elements" data-live-search="true" data-live-search-style="begins">
                <option selected="selected" value=""><?php esc_html_e( 'Select State/Country', 'cityestate' ); ?></option><?php
                // Get property state or country
                $property_cities_terms = get_terms( array( "property_location" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_submit_hirarchical_options( 'property_location', $property_cities_terms, -1 ); ?>
            </select><?php 
        } else { ?>
            <input class="full-width-elements" name="property_location" id="property_location" placeholder="<?php echo esc_attr($theme_labels['property_location_pl']); ?>"><?php 
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">  
        <!-- Property post code -->
        <input class="full-width-elements" name="postal_code" id="zip" placeholder="<?php echo esc_attr($theme_labels['postal_code_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Show property google map -->
        <div class="map_canvas" id="map"></div>
        <button id="find" class="btn btn-primary btn-block margin-bottom-15 margin-top-15"><?php echo esc_html($theme_labels['reset_label']); ?></button>
        <a id="reset" href="#" style="display:none;"><?php echo esc_html($theme_labels['reset_btn']); ?></a>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Property latitude -->
        <input class="full-width-elements" name="latitude" id="latitude" placeholder="<?php echo esc_attr($theme_labels['latitude_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">                       
        <!-- Property longitude -->
        <input class="full-width-elements" name="longitude" id="longitude" placeholder="<?php echo esc_attr($theme_labels['longitude_pl']); ?>">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Check property street view -->
        <label for="property_google_street_view"><?php echo esc_html($theme_labels['property_google_street_view']); ?></label>
        <select name="property_google_street_view" id="property_google_street_view" class="selectpicker" data-live-search="false" data-live-search-style="begins">
            <option value="hide"><?php esc_html_e( 'Hide', 'cityestate' ); ?></option>
            <option value="show"><?php esc_html_e( 'Show', 'cityestate' ); ?></option>
        </select>
    </div>
</div>