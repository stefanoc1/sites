

                    

                    

                    

                     
                    
                   

                    

                    

                   

                    <?php

            // Check layout is available
            if( $layout ){
                foreach( $layout as $key => $value ){
                    switch( $key ){
                        // Property description section
                        case 'description':
                            get_template_part('template-parts/edit-property/description');
                        break;
                        // Property media section
                        case 'media':
                            get_template_part('template-parts/edit-property/media');
                        break;
                        // Property detail section
                        case 'details':
                            get_template_part('template-parts/edit-property/details');
                        break;
                        // Property location section
                        case 'location':
                            get_template_part('template-parts/edit-property/location');
                        break;
                        // Property feature section
                        case 'features':
                            get_template_part('template-parts/edit-property/features');
                        break;
                        // Property amenities section
                        case 'amenities':
                            get_template_part('template-parts/edit-property/amenities');
                        break;
                        // Property essential information section
                        case 'essential_infomation':
                            get_template_part('template-parts/edit-property/essential_infomation');
                        break;
                        // Property flooring good section
                        case 'flooring_goods_included':
                            get_template_part('template-parts/edit-property/flooring_goods_included');
                        break;
                        // Property interior and exterior section
                        case 'interior_exterior':
                            get_template_part('template-parts/edit-property/interior_exterior');
                        break;
                        // Property room dimension section
                        case 'room_dimensions':
                            get_template_part('template-parts/edit-property/room_dimensions');
                        break;
                        // Property floo plan section
                        case 'floor_plans':
                            get_template_part('template-parts/edit-property/floor_plans');
                        break;                        
                        // Property video section
                        case 'property_video':
                            get_template_part('template-parts/edit-property/property_video');
                        break;
                        // Property near by place section
                        case 'near_by_place':
                            get_template_part('template-parts/edit-property/near_by_place');
                        break;
                        // Property agent information section
                        case 'agent_information':
                            get_template_part('template-parts/edit-property/agent_information');
                        break;
                    }
                }
            } ?>
            <div class="account-block text-right">
                <!-- Edit property security -->
                <?php wp_nonce_field( 'submit_property_security', 'submit_property_nonce' ); ?>
                <input type="hidden" name="action" value="update_property"/>
                <!-- Property id -->
                <input type="hidden" name="property_id" value="<?php echo intval( $property_data->ID ); ?>"/>
                <!-- Property featured type -->
                <input type="hidden" name="property_featured" value="<?php if( isset( $property_meta['featured'] ) ) { echo sanitize_text_field( $property_meta['featured'][0] ); } ?>">
                <!-- Property payment status -->
                <input type="hidden" name="property_payment" value="<?php if( isset( $property_meta['payment_status'] ) ) { echo sanitize_text_field( $property_meta['payment_status'][0] ); } ?>"/>
                <button type="submit" id="update_property" class="btn btn-primary"><?php esc_html_e( 'Update Property', 'cityestate' ); ?></button>
            </div>