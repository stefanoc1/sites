<?php 
// Get theme label
global $theme_labels; ?>

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
    <tbody id="cityestate_intext_value">
        <tr>
            <td class="action-field">
                <!-- Interior and exterior sort icon -->
                <span class="sort-intext-row"><i class="fa fa-navicon"></i></span>
            </td>
            <td class="field-title">
                <!-- Interior and exterior title -->
                <input class="" type="text" name="interior_exterior[0][interior_label]" id="intext_label_0" placeholder="<?php esc_html_e( 'Eg: Heating', 'cityestate' ); ?>">
            </td>
            <td class="field-title">
                <!-- Interior and exterior value -->
                <input class="" type="text" name="interior_exterior[0][interior_value]" id="intext_value_0" placeholder="<?php esc_html_e( 'Eg: Forced Air-1', 'cityestate' ); ?>">
            </td>
            <td class="action-field">
                <!-- Interior and exterior remove -->
                <span data-remove="0" class="remove-intext-row"><i class="fa fa-remove"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add interior and exterior -->
            <td><button data-increment="0" class="add-intext-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>