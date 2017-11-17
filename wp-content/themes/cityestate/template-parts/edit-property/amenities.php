<?php 
// Declare variable
global $theme_labels, $property_data;

// Get property amenities
$property_amenities = get_post_meta( $property_data->ID, 'propertyamenities', true ); 

$count = 0; ?>
<!-- Amenities section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_ame_title']); ?></h3>
<table class="amenities-block">
    <tbody id="cityestate_amenities_value"><?php
        // Get property amenities
        if( !empty($property_amenities) ){
            foreach( $property_amenities as $amenities ): ?>
                <tr>
                    <td class="action-field">
                        <span class="sort-amenities-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $amenities['amenities_value'] ); ?>" name="property_amenities[<?php echo esc_attr( $count ); ?>][amenities_value]" id="amenities_value_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: Air Conditioning', 'cityestate' ); ?>">
                    </td>            
                    <td class="action-field">
                        <span data-remove="<?php echo esc_attr( $count ); ?>" class="remove-amenities-row"><i class="fa fa-remove"></i></span>
                    </td>
                </tr><?php
                $count++;
            endforeach;
        } ?>
    </tbody>
    <tfoot>
        <!-- Add new button -->
        <tr>
            <td></td>
            <td><button data-increment="<?php echo esc_attr( $count-1 ); ?>" class="add-amenities-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>