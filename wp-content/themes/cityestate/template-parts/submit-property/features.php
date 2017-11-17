<?php 
// Declare global variable
global $theme_labels, $show_submit_property_field, $required_submit_property_field; ?>

<!-- Property features section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_features_title']); ?></h3>

<div class="row">
<?php 
// Get property features
$feature_terms = get_terms( 'property_feature', array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false ) );
// Check property features is empty or not
if( !empty($feature_terms) ){
    $count = 1;
    foreach( $feature_terms as $term ){
        // Show property features
        echo '<div class="col-xs-12 col-sm-3 col-md-3"><label>';
            echo '<input type="checkbox" name="property_features[]" id="feature-' . esc_attr( $count ). '" value="' . esc_attr( $term->term_id ). '" />';
            echo esc_attr( $term->name );
        echo '</label></div>';
        $count++;
    }
} ?>
</div>