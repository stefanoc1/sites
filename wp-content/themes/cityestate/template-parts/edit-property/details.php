<?php
// Define global variable
global $theme_labels, $show_submit_property_field, $required_submit_property_field, $property_meta;

// Get property details
$year_built     = cityestate_option( 'property_year_built' );
$property_id    = cityestate_option( 'generate_property_id' );
$area_prefix    = cityestate_option( 'set_area_prefix' );
$area_prefix    = cityestate_option( 'user_set_area_prefix' ); ?>

<!-- Property detail section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_details_title']); ?></h3>
<div class="row">
<?php
    if( $property_id != 1 ){
        if( $show_submit_property_field['property_id'] != 1 ){ ?>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <!-- Property id is auto -->
                <input type="text" id="property_id" value="<?php if( isset( $property_meta['property_id'] ) ) { echo sanitize_text_field( $property_meta['property_id'][0] ); } ?>" class="full-width-elements" name="property_id" placeholder="<?php echo esc_attr($theme_labels['sub_prop_prop_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_id']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
            </div>
            <?php
        }
    }

    // Property area size
    if( $show_submit_property_field['area_size'] != 1 ){ ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <input type="text" id="property_size" value="<?php if( isset( $property_meta['property_size'] ) ) { echo sanitize_text_field( $property_meta['property_size'][0] ); } ?>" class="full-width-elements" name="property_size" placeholder="<?php echo esc_attr($theme_labels['sub_prop_size_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_size']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <input type="text" id="property_size_prefix" value="<?php if( isset( $property_meta['property_size_prefix'] ) ) { echo sanitize_text_field( $property_meta['property_size_prefix'][0] ); } ?>" class="full-width-elements" name="property_size_prefix" <?php if( $area_prefix != 1 ){ echo 'disabled'; } ?> value="<?php echo esc_html($area_prefix); ?>">
        </div>
        <?php 
    }

    // Property bedroom
    if( $show_submit_property_field['bedrooms'] != 1 ){ ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <input type="text" id="property_beds" value="<?php if( isset( $property_meta['property_bedrooms'] ) ) { echo sanitize_text_field( $property_meta['property_bedrooms'][0] ); } ?>" class="full-width-elements" name="property_beds" placeholder="<?php echo esc_attr($theme_labels['sub_prop_bedroom_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_beds']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
        </div>
        <?php 
    }

    // Property bathroom
    if( $show_submit_property_field['bathrooms'] != 1 ){ ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <input type="text" id="property_baths" value="<?php if( isset( $property_meta['property_bathrooms'] ) ) { echo sanitize_text_field( $property_meta['property_bathrooms'][0] ); } ?>" class="full-width-elements" name="property_baths" placeholder="<?php echo esc_attr($theme_labels['sub_prop_bathroom_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_baths']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
        </div>
        <?php 
    }

    // Property garages
    if( $show_submit_property_field['garages'] != 1 ){ ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <input type="text" id="property_garage" value="<?php if( isset( $property_meta['property_garages'] ) ) { echo sanitize_text_field( $property_meta['property_garages'][0] ); } ?>" class="full-width-elements" name="property_garage" placeholder="<?php echo esc_attr($theme_labels['sub_prop_garage_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_garage']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
        </div>
        <?php 
    }

    // Property year built
    if( $show_submit_property_field['year_built'] != 1 ){ ?>
        <?php 
        // Check property year build
        if( $year_built != 'no' ){ ?>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" id="property_year_built" value="<?php if( isset( $property_meta['property_year'] ) ) { echo sanitize_text_field( $property_meta['property_year'][0] ); } ?>" class="input_date full-width-elements" name="property_year_built" placeholder="<?php echo esc_attr($theme_labels['sub_prop_year_pl']); ?>" title="<?php echo esc_html($theme_labels['vali_msg_year_built']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
            </div>
            <?php 
        } else { ?>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <input type="text" id="property_year_built" value="<?php if( isset( $property_meta['property_year'] ) ) { echo sanitize_text_field( $property_meta['property_year'][0] ); } ?>" class="full-width-elements" name="property_year_built" placeholder="<?php echo esc_attr($theme_labels['sub_prop_year_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_year_built']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
            </div>
            <?php
        }
    }

    // Property address
    if( $show_submit_property_field['address'] != 1 ){ ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <input type="text" id="property_short_address" value="<?php if( isset( $property_meta['property_address'] ) ) { echo sanitize_text_field( $property_meta['property_address'][0] ); } ?>" class="full-width-elements" name="property_short_address" placeholder="<?php echo esc_attr($theme_labels['sub_prop_shot_addre_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_address']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
        </div>
            <?php
    } ?>
</div>.