<?php 
// Declare global variable
global $theme_labels, $property_data; ?>

<!-- Property features section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_features_title']); ?></h3><?php

// Get property features
$feature_terms = get_terms( 'property_feature', array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false ) );

$features_terms_id = array();
$features_terms = get_the_terms( $property_data->ID, 'property_feature' );

// Check property features is empty or not
if( $features_terms && ! is_wp_error( $features_terms ) ){
    foreach( $features_terms as $feature ){
        $features_terms_id[] = intval( $feature->term_id );
    }
}

// Check property features is empty or not
if( !empty($feature_terms) ){
    $count = 1; ?>
    <div class="row">
        <?php foreach( $feature_terms as $term ){ ?>
        <div class="col-xs-12 col-sm-3 col-md-3">
            <?php    // Show property features
                echo '<label>';
                    if( in_array( $term->term_id, $features_terms_id ) ){
                        echo '<input type="checkbox" name="property_features[]" id="feature-' . esc_attr( $count ) . '" value="' . esc_attr( $term->term_id ) . '" checked />';
                        echo esc_attr( $term->name );
                    } else {
                        echo '<input type="checkbox" name="property_features[]" id="feature-' . esc_attr( $count ) . '" value="' . esc_attr( $term->term_id ) . '" />';
                        echo esc_attr( $term->name );
                    }            
                echo '</label>';
                $count++; ?>
        </div>
        <?php  } ?>

    </div>
<?php }