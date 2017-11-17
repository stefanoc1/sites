<?php 
// Get theme labels
global $theme_labels; ?>
<!-- Get property section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_ame_title']); ?></h3>
<table class="amenities-block">
    <tbody id="cityestate_amenities_value">
        <tr>
            <!-- Amenities sort icon -->
            <td class="action-field">
                <span class="sort-amenities-row"><i class="fa fa-navicon"></i></span>
            </td>
            <!-- Amenities values -->
            <td class="field-title">
                <input class="" type="text" name="property_amenities[0][amenities_value]" id="amenities_value_0" placeholder="<?php esc_html_e( 'Eg: Air Conditioning', 'cityestate' ); ?>">
            </td>            
            <!-- Amenities remove icon -->
            <td class="action-field">
                <span data-remove="0" class="remove-amenities-row"><i class="fa fa-remove"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add new amenities button -->
            <td><button data-increment="0" class="add-amenities-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>