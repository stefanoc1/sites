<?php
// Define global variable
global $theme_labels, $show_submit_property_field, $required_submit_property_field;

// Get property details
$year_built         = cityestate_option( 'property_year_built' );
$generate_property_id   = cityestate_option( 'generate_property_id' );
$area_prefix        = cityestate_option( 'set_area_prefix' );
$area_prefix        = cityestate_option( 'set_area_prefix' ); ?>

<!-- Property detail section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_details_title']); ?></h3>
<div class="row">
<!-- Property id is auto -->
<?php if( $generate_property_id != 1 ){
    if( $show_submit_property_field['property_id'] != 1 ){ ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <!-- Property id -->
            <input type="text" id="property_id" class="full-width-elements" name="property_id" placeholder="<?php echo esc_attr($theme_labels['sub_prop_prop_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_id']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
        </div><?php
    }
}

// Property area size
if( $show_submit_property_field['area_size'] != 1 ){ ?>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <input type="text" id="property_size" class="full-width-elements" name="property_size" placeholder="<?php echo esc_attr($theme_labels['sub_prop_size_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_size']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <input type="text" id="property_size_prefix" class="full-width-elements" name="property_size_prefix" <?php if( $area_prefix != 1 ){ echo 'disabled'; } ?> value="<?php echo esc_html($area_prefix); ?>">
    </div>
    <?php 
}

// Property bedroom
if( $show_submit_property_field['bedrooms'] != 1 ){ ?>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <input type="text" id="property_beds" class="full-width-elements" name="property_beds" placeholder="<?php echo esc_attr($theme_labels['sub_prop_bedroom_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_beds']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
    </div><?php 
}

// Property bathroom
if( $show_submit_property_field['bathrooms'] != 1 ){ ?>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <input type="text" id="property_baths" class="full-width-elements" name="property_baths" placeholder="<?php echo esc_attr($theme_labels['sub_prop_bathroom_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_baths']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
    </div><?php 
} 

// Property garages
if( $show_submit_property_field['garages'] != 1 ){ ?>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <input type="text" id="property_garage" class="full-width-elements" name="property_garage" placeholder="<?php echo esc_attr($theme_labels['sub_prop_garage_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_garage']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
    </div><?php
}

// Property year built
if( $show_submit_property_field['year_built'] != 1 ){ ?>
    <div class="col-xs-12 col-sm-4 col-md-4"><?php 
        // Check property year build
        if( $year_built != 'no' ){ ?>
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" id="property_year_built" class="input_date full-width-elements " name="property_year_built" placeholder="<?php echo esc_attr($theme_labels['sub_prop_year_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_year_built']); ?>" <?php echo cityestate_required_field( '', true ); ?> ><?php 
        } else { ?>
            <input type="text" id="property_year_built" class="full-width-elements" name="property_year_built" placeholder="<?php echo esc_attr($theme_labels['sub_prop_year_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_year_built']); ?>" <?php echo cityestate_required_field( '', true ); ?> ><?php
        } ?>
    </div>
<?PHP }

// Property address
if( $show_submit_property_field['address'] != 1 ){ ?>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <input type="text" id="property_short_address" class="full-width-elements" name="property_short_address" placeholder="<?php echo esc_attr($theme_labels['sub_prop_shot_addre_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_address']); ?>" <?php echo cityestate_required_field( '', true ); ?> >
    </div>
    <?php
} ?>
</div>