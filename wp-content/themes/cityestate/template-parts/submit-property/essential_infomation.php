<?php 
// Get theme labels
global $theme_labels; ?>

<!-- Essential section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_essential_title']); ?></h3>
<table class="essential-block">
    <tr>
        <td></td>
        <!-- Essential title -->
        <td><label><?php esc_html_e( 'Title', 'cityestate' ); ?></label></td>
        <!-- Essential Value -->
        <td><label><?php esc_html_e( 'Value', 'cityestate' ); ?></label></td>
        <td></td>
    </tr>
    <tbody id="cityestate_essential_value">
        <tr>
            <!-- Essential sort icon -->
            <td class="action-field">
                <span class="sort-essential-row"><i class="fa fa-navicon"></i></span>
            </td>
            <!-- Essential title -->
            <td class="field-title">
                <input class="" type="text" name="property_info[0][property_info_label]" id="essential_label_0" placeholder="<?php esc_html_e( 'Eg: MLS', 'cityestate' ); ?>">
            </td>
            <!-- Essential value -->
            <td class="field-title">
                <input class="" type="text" name="property_info[0][property_info_value]" id="essential_value_0" placeholder="<?php esc_html_e( 'Eg: V254680', 'cityestate' ); ?>">
            </td>
            <!-- Essential remove icon -->
            <td class="action-field">
                <span data-remove="0" class="remove-essential-row"><i class="fa fa-remove"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Essential submit button -->
            <td><button data-increment="0" class="add-essential-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>