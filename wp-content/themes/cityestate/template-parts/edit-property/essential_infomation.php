<?php 
// Get theme labels
global $theme_labels, $property_data;

// Get property info
$property_info = get_post_meta( $property_data->ID, 'property_info', true ); 

$count = 0; ?>

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
    <tbody id="cityestate_essential_value"><?php
        if( !empty($property_info) ){
            foreach( $property_info as $info ): ?>
                <tr>
                    <!-- Essential sort icon -->
                    <td class="action-field">
                        <span class="sort-essential-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <!-- Essential title -->
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $info['property_info_label'] ); ?>" name="property_info[<?php echo esc_attr( $count ); ?>][property_info_label]" id="essential_label_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: MLS', 'cityestate' ); ?>">
                    </td>
                    <!-- Essential value -->
                    <td class="field-title">
                        <input class="" type="text" value="<?php echo esc_attr( $info['property_info_value'] ); ?>" name="property_info[<?php echo esc_attr( $count ); ?>][property_info_value]" id="essential_value_<?php echo esc_attr( $count ); ?>" placeholder="<?php esc_html_e( 'Eg: V254680', 'cityestate' ); ?>">
                    </td>
                    <!-- Essential remove icon -->
                    <td class="action-field">
                        <span data-remove="<?php echo esc_attr( $count ); ?>" class="remove-essential-row"><i class="fa fa-remove"></i></span>
                    </td>
                </tr><?php
                $count++;
            endforeach;
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <!-- Essential remove icon -->
            <td><button data-increment="<?php echo esc_attr( $count-1 ); ?>" class="add-essential-row"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add New', 'cityestate' ); ?></button></td>
            <td></td>
        </tr>
    </tfoot>
</table>