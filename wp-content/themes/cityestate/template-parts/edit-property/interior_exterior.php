<?php 
// Get theme label
global $theme_labels, $property_data;

// Get property interior and exterior
$interior_exterior = get_post_meta( $property_data->ID, 'interior_exterior', true ); 

$count = 0; ?>

<!-- Show interior and exterior section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_intext_title']); ?></h3>
<table class="intext-block">
    <tr>
        <td></td>
        <!-- Interior and exterior title -->
        <td><label><?php esc_html_e( 'Title', 'cityestate' ); ?></label></td>
        <!-- Interior and exterior value -->
        <td><label><?php esc_html_e( 'Value', 'cityestate' ); ?></label></td>
        <td></td>
    </tr>
    <tbody id="cityestate_intext_value"><?php
        if( !empty($interior_exterior) ){
            foreach( $interior_exterior as $int_ext ): ?>
                <tr>
                    <!-- Interior and exterior sort icon -->
                    <td class="action-field">
                        <span class="sort-intext-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <!-- Interior and exterior title -->
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $int_ext['interior_label'] ); ?>" name="interior_exterior[<?php echo esc_attr( $count ); ?>][interior_label]" id="intext_label_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: Heating', 'cityestate' ); ?>">
                    </td>
                    <!-- Interior and exterior value -->
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $int_ext['interior_value'] ); ?>" name="interior_exterior[<?php echo esc_attr( $count ); ?>][interior_value]" id="intext_value_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: Forced Air-1', 'cityestate' ); ?>">
                    </td>
                    <!-- Interior and exterior remove -->
                    <td class="action-field">
                        <span data-remove="<?php echo esc_attr( $count ); ?>" class="remove-intext-row"><i class="fa fa-remove"></i></span>
                    </td>
                </tr><?php
                $count++;
            endforeach;
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add interior and exterior -->
            <td><button data-increment="<?php echo esc_attr( $count-1 ); ?>" class="add-intext-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>