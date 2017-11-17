<?php 
// Get theme label
global $theme_labels; ?>

<!-- Title of room dimension section -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_room_title']); ?></h3>
<table class="room-block">
    <tr>
        <td></td>
        <!-- Room dimension title -->
        <td><label><?php esc_html_e( 'Title', 'cityestate' ); ?></label></td>
        <!-- Room dimension value -->
        <td><label><?php esc_html_e( 'Dimension', 'cityestate' ); ?></label></td>
        <td></td>
    </tr>
    <tbody id="cityestate_room_value">
        <tr>
            <td class="action-field">
                <!-- Room dimension icon -->
                <span class="sort-room-row"><i class="fa fa-navicon"></i></span>
            </td>
            <td class="field-title">
                <!-- Room dimension label -->
                <input class="" type="text" name="room_dimensions[0][rom_dime_label]" id="room_label_0" placeholder="<?php esc_html_e( 'Eg: Dining Room', 'cityestate' ); ?>">
            </td>
            <td class="field-title">
                <!-- Room dimension value -->
                <input class="" type="text" name="room_dimensions[0][rom_dime_value]" id="room_value_0" placeholder="<?php esc_html_e( 'Eg: 11X11', 'cityestate' ); ?>">
            </td>
            <td class="action-field">
                <!-- Remove room dimension row -->
                <span data-remove="0" class="remove-room-row"><i class="fa fa-remove"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add room dimension row -->
            <td><button data-increment="0" class="add-room-row"><i class="fa fa-plus"></i><?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>