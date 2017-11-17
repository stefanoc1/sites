<?php 
// Declare global variable
global $theme_labels, $show_submit_property_field, $required_submit_property_field; ?>

<!-- Property description section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_des_title']); ?></h3>

<!-- Property description -->
<input type="text" id="property_title" class="full-width-elements" name="property_title" placeholder="<?php echo esc_attr($theme_labels['sub_prop_title_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_title']); ?>" <?php echo cityestate_required_field( '', true ); ?> /><?php

$content    = '';
$editor_id  = 'property_desc';
$settings   =   array(
    'wpautop'       => true,
    'media_buttons' => true,
    'textarea_name' => $editor_id,
    'textarea_rows' => get_option('default_post_edit_rows', 5),
    'tabindex'      => '',
    'editor_css'    => '',
    'editor_class'  => '',
    'teeny'         => false,
    'dfw'           => false,
    'tinymce'       => true,
    'quicktags'     => true
);
wp_editor( $content, $editor_id, $settings = array() ); ?>

<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Show property type -->
        <?php if( $show_submit_property_field['property_type'] != 1 ){ ?>
            <select name="property_type" id="property_type" class="selectpicker full-width-elements margin-top-15 <?php echo cityestate_required_field( '', true ); ?>" data-live-search="false" data-live-search-style="begins" title="<?php echo esc_attr($theme_labels['vali_msg_type']); ?>" >
                <option selected="selected" value=""><?php esc_html_e( 'Type', 'cityestate' ); ?></option><?php
                // Get property type
                $property_types_terms = get_terms( array( "property_type" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_submit_hirarchical_options( 'property_type', $property_types_terms, -1 ); ?>
            </select><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Show property status -->
        <?php if( $show_submit_property_field['property_status'] != 1 ){ ?>
            <select name="property_status" id="property_status" class="selectpicker full-width-elements margin-top-15 <?php echo cityestate_required_field( '', true ); ?>" data-live-search="false" data-live-search-style="begins" title="<?php echo esc_attr($theme_labels['vali_msg_status']); ?>" >
                <option selected="selected" value=""><?php esc_html_e( 'Status', 'cityestate' ); ?></option><?php
                // Get property status
                $property_status = get_terms( array( "property_status" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_submit_hirarchical_options( 'property_status', $property_status, -1); ?>
            </select><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Show property label -->
        <?php if( $show_submit_property_field['property_label'] != 1 ){ ?>
            <select name="property_label" id="property_label" class="selectpicker full-width-elements margin-top-15 <?php echo cityestate_required_field( '', true ); ?>" data-live-search="false" data-live-search-style="begins" title="<?php echo esc_attr($theme_labels['vali_msg_label']); ?>" >
                <option selected="selected" value=""><?php esc_html_e( 'Label', 'cityestate' ); ?></option><?php
                // Get property label
                $property_label = get_terms( array( "property_label" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_submit_hirarchical_options( 'property_label', $property_label, -1); ?>
            </select><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
        <!-- Show property price -->
        <?php if( $show_submit_property_field['sale_rent_price'] != 1 ){ ?>
            <input type="text" id="property_price" class="full-width-elements margin-top-15" name="property_price" value="" placeholder="<?php echo esc_attr($theme_labels['sub_prop_sa_re_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_price']); ?>" <?php echo cityestate_required_field( '', true ); ?> ><?php 
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
    <!-- Property second price -->
    <?php if( $show_submit_property_field['second_price'] != 1 ){ ?>    
            <input type="text" id="property_second_price" class="full-width-elements margin-top-15" name="property_second_price" placeholder="<?php echo esc_attr($theme_labels['sub_prop_se_pr_pl']); ?>"><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
    <!-- Property price postfix -->
    <?php if( $show_submit_property_field['price_postfix'] != 1 ){ ?>    
            <input type="text" id="property_price_label" class="full-width-elements margin-top-15" name="property_price_label" placeholder="<?php echo esc_attr($theme_labels['sub_prop_pr_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_price_label']); ?>" <?php echo cityestate_required_field( '', true ); ?> ><?php 
        } ?>
    </div>
</div>