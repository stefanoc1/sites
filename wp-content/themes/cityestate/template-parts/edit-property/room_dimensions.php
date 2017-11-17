<?php 
// Get theme label
global $theme_labels, $property_data;

// Get property room dimensions
$room_dimensions = get_post_meta( $property_data->ID, 'room_dimensions', true ); 

$count = 0; ?>

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
    <tbody id="cityestate_room_value"><?php
        if( !empty($room_dimensions) ){
            foreach( $room_dimensions as $room ): ?>
                <tr>
                    <!-- Room dimension icon -->
                    <td class="action-field">
                        <span class="sort-room-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <!-- Room dimension label -->
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $room['rom_dime_label'] ); ?>" name="room_dimensions[<?php echo esc_attr( $count ); ?>][rom_dime_label]" id="room_label_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: Dining Room', 'cityestate' ); ?>">
                    </td>
                    <!-- Room dimension value -->
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $room['rom_dime_value'] ); ?>" name="room_dimensions[<?php echo esc_attr( $count ); ?>][rom_dime_value]" id="room_value_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: 11X11', 'cityestate' ); ?>">
                    </td>
                    <!-- Remove room dimension row -->
                    <td class="action-field">
                        <span data-remove="<?php echo esc_attr( $count ); ?>" class="remove-room-row"><i class="fa fa-remove"></i></span>
                    </td>
                </tr><?php
                $count++;
            endforeach;
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Add room dimension row -->
            <td><button data-increment="<?php echo esc_attr( $count-1 ); ?>" class="add-room-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>