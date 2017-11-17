<?php 

// Declare variable
global $theme_labels, $show_submit_property_field, $required_submit_property_field, $property_data, $property_meta; 
?>


<!-- Property description section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_des_title']); ?></h3>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Property title -->
        <input type="text" id="property_title" value="<?php print sanitize_text_field( $property_data->post_title ); ?>" class="full-width-elements" name="property_title" placeholder="<?php echo esc_attr($theme_labels['sub_prop_title_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_title']); ?>" <?php echo cityestate_required_field( '', true ); ?> />
    </div>
</div>

<!-- Property description label -->
<label><?php echo esc_attr($theme_labels['sub_prop_desc']); ?></label><?php

$content    = $property_data->post_content;
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
    <div class="col-xs-12 col-sm4 col-md-4">
        <?php // Show property type
        if( $show_submit_property_field['property_type'] != 1 ){ ?>
           
            <select name="property_type" id="property_type" class="selectpicker full-width-elements margin-top-15 <?php echo cityestate_required_field( '', true ); ?>" data-live-search="false" data-live-search-style="begins" title="<?php echo esc_attr($theme_labels['vali_msg_type']); ?>" ><?php
                // Get property type
                $property_types_terms = get_terms( array( "property_type" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_edit_hierarchichal_options( $property_data->ID, 'property_type' ); ?>
            </select><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm4 col-md-4">
        <?php // Show property status
        if( $show_submit_property_field['property_status'] != 1 ){ ?>
           
            <select name="property_status" id="property_status" class="selectpicker full-width-elements margin-top-15 <?php echo cityestate_required_field( '', true ); ?>" data-live-search="false" data-live-search-style="begins" title="<?php echo esc_attr($theme_labels['vali_msg_status']); ?>" ><?php
                // Get property status
                $property_status = get_terms( array( "property_status" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_edit_hierarchichal_options( $property_data->ID, 'property_status' ); ?>
            </select><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm4 col-md-4">
    <?php
        // Show property label
        if( $show_submit_property_field['property_label'] != 1 ){ ?>
           
            <select name="property_label" id="property_label" class="selectpicker full-width-elements margin-top-15 <?php echo cityestate_required_field( '', true ); ?>" data-live-search="false" data-live-search-style="begins" title="<?php echo esc_attr($theme_labels['vali_msg_label']); ?>" ><?php
                // Get property label
                $property_label = get_terms( array( "property_label" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                cityestate_edit_hierarchichal_options( $property_data->ID, 'property_label' ); ?>
            </select><?php
        }
    ?>
    </div>
    <div class="col-xs-12 col-sm4 col-md-4">
    <?php
        if( $show_submit_property_field['sale_rent_price'] != 1 ){ ?>
            <!-- Show property price -->
            
            <input type="text" id="property_price" value="<?php if( isset( $property_meta['property_price'] ) ) { echo sanitize_text_field( $property_meta['property_price'][0] ); } ?>" class="full-width-elements margin-top-15" name="property_price" value="" placeholder="<?php echo esc_attr($theme_labels['sub_prop_sa_re_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_price']); ?>" <?php echo cityestate_required_field( '', true ); ?> ><?php 
        }
    ?>
    </div>
    <div class="col-xs-12 col-sm4 col-md-4">
    <?php
        if( $show_submit_property_field['second_price'] != 1 ){ ?>    
            <!-- Property second price -->
            
            <input type="text" id="property_second_price" value="<?php if( isset( $property_meta['property_second_price'] ) ) { echo sanitize_text_field( $property_meta['property_second_price'][0] ); } ?>" class="full-width-elements margin-top-15" name="property_second_price" placeholder="<?php echo esc_attr($theme_labels['sub_prop_se_pr_pl']); ?>"><?php
        } ?>
    </div>
    <div class="col-xs-12 col-sm4 col-md-4">
    <?php
        if( $show_submit_property_field['price_postfix'] != 1 ){ ?>    
            <!-- Property price postfix -->
            
            <input type="text" id="property_price_label" value="<?php if( isset( $property_meta['property_price_postfix'] ) ) { echo sanitize_text_field( $property_meta['property_price_postfix'][0] ); } ?>" class="full-width-elements margin-top-15" name="property_price_label" placeholder="<?php echo esc_attr($theme_labels['sub_prop_pr_pl']); ?>" title="<?php echo esc_attr($theme_labels['vali_msg_price_label']); ?>" <?php echo cityestate_required_field( '', true ); ?> ><?php 
        } ?>
    </div>
</div>