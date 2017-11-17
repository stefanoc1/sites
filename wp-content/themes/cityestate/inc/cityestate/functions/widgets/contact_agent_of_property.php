<?php


// Advance search filter widget
class Contact_agent_of_property extends WP_Widget {

    public function __construct(){
        // Define construct
        parent::__construct(
            'contact_agent_of_property',
            esc_html__( 'Cityestate: Cotnact Agent', 'cityestate' ),
            array( 'description' => esc_html__( 'Contact Agent Form', 'cityestate' ), )
        );

    }

    public function widget( $args, $instance ){
        // Define global variable
        global $before_title, $after_title, $post;
        extract( $args );
        // Get widget title
        $title = apply_filters('widget_title', $instance['title'] );

        // Get search property template link
        $search_template    = cityestate_find_template_url( 'templates/template_search.php' );
        
        // Get sohw hide field status
        $show_hide_field    = cityestate_option( 'adv_sea_show_hide_fileds' );
        $keyword_search     = cityestate_option( 'adv_sea_keyword_search' );

        // Property search by title
        if( $keyword_search == 'property_title' ){                
            $search_placeholder = esc_html__( 'Enter keyword...', 'cityestate' );
        // Property search by city or state
        } else if( $keyword_search == 'property_city_state' ){            
            $search_placeholder = esc_html__( 'Search City, State or Area', 'cityestate' );
        // Property search by address or zip
        } else {            
            $search_placeholder = esc_html__( 'Enter an address, town, street, or zip', 'cityestate' );
        }

        // Declare variable
        $location = $type = $status = '';

        // Get property type
        if( isset( $_GET['type'] ) ){
            $type = $_GET['type'];
        }

        // Get property status
        if( isset( $_GET['status'] ) ){
            $status = $_GET['status'];
        }
        
        // Get property location
        if( isset( $_GET['location'] ) ){
            $location = $_GET['location'];
        } ?>
        <div class="fliter-widget">
            <div class="">
                <?php
                // Get theme label
                global $theme_labels;
                // Get agenct detail
                $agent_display  = get_post_meta( get_the_ID(), 'property_agent_display', true );
                $agent_id       = get_post_meta( get_the_ID(), 'agents', true );

                // Get contact form setting from theme option
                $enable_contact_form_7  = cityestate_option( 'contact_form_7_in_property_page' );
                $contact_form_7         = cityestate_option( 'contact_form_7_for_property_page' );

                // Check agnet id and agent display info
                if( $agent_id != '-1' && $agent_display == 'agent_info' ){
                    // Get agent info
                    $agent_mobile       = get_post_meta( $agent_id, 'agent_mobile', true );
                    $agent_email        = get_post_meta( $agent_id, 'agent_email', true );
                    $property_agent     = get_the_title( $agent_id );
                    $thumb_id           = get_post_thumbnail_id( $agent_id );
                    $thumb_url_array    = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
                    $agent_photo_url    = $thumb_url_array[0];
                    $agent_permalink    = get_post_permalink( $agent_id );
                    $who_provide        = esc_html__( 'Agent Of Property', 'cityestate' );

                } elseif ( $agent_display == 'author_info' ){
                    // Get agent info
                    $property_agent     = get_the_author();
                    $agent_permalink    = get_author_posts_url( get_the_author_meta( 'ID' ) );
                    $agent_mobile       = get_the_author_meta( 'user_mobile' );
                    $agent_photo_url    = get_the_author_meta( 'author_photo' );
                    $agent_email        = get_the_author_meta( 'author_email' );
                    $who_provide        = esc_html__( 'Author Of Author', 'cityestate' );

                }

                // Check agent photo is set
                if( empty( $agent_photo_url ) ){
                    $agent_photo_url = get_template_directory_uri().'/images/profile-avatar.png';
                } ?>
                <div class="agent-contact-sidebar">
                    <div class="agent-profile-sidebar">
                        <div class="col-sm-4">
                            <!-- Show agent photo -->
                            <img src="<?php echo esc_url( $agent_photo_url ); ?>" alt="<?php echo esc_attr( $property_agent ); ?>">
                        </div>
                        <div class="col-sm-8">
                            <!-- Agent name -->
                            <h4><?php printf( esc_html__( '%s', 'cityestate' ), $property_agent ) ; ?></h4>
                            <!-- Show property agent info -->
                            <p><?php printf( esc_html__( '%s', 'cityestate' ), $who_provide ); ?></p>
                            <!-- Set link for agent property -->
                            <a href="<?php echo esc_url($agent_permalink); ?>" class="view"><?php esc_html_e( 'View My Listing', 'cityestate' ); ?></a>
                        </div>
                    </div>
                    <div class="agent-contact-detail-sidebar">
                        <!-- Agent mobile phone -->
                        <p><i class="fa fa-phone"></i><?php printf( esc_html__( '%s', 'cityestate' ), $agent_mobile ); ?></p>
                        <!-- Agent email id -->
                        <p><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo esc_attr($agent_email); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $agent_email ); ?></a></p>
                    </div>
                    <div class="agent-contact-form-sidebar">
                        <!-- Request to agent -->
                        <h5><?php esc_html_e( 'Request Inquiry','cityestate' ); ?></h5>
                        <div id="propety-agent-contact-area" class="inner-page-shortcodes" style="margin:0;">
                            <div class="message_area_bottom"></div>
                        </div><?php
                        // Check contact form 7 status
                        if( $enable_contact_form_7 != 0 ){
                            if( !empty($contact_form_7) ){
                                echo do_shortcode($contact_form_7);
                            }
                        } else {
                            // Send message to aent
                            if( $agent_email ){ ?>
                                <form id="single-propety-agnet-send-message" name="contact_form" method="post">
                                    <!-- Visiter name -->
                                    <input id="fname" class="full_name" name="full_name" placeholder="<?php esc_html_e('Your Name', 'cityestate'); ?>" type="text">
                                    <!-- Visiter email address -->
                                    <input id="emailid" class="email_address" name="email_address" placeholder="<?php esc_html_e('Email Address', 'cityestate'); ?>" type="email">
                                    <!-- Visiter phone number -->
                                    <input id="pnumber" class="p_number" name="p_number" placeholder="<?php esc_html_e('Phone Number', 'cityestate'); ?>" type="text">
                                    <!-- Visiter message -->
                                    <textarea class="message" placeholder="<?php esc_html_e('Message', 'cityestate'); ?>" name="message" ><?php esc_html_e( "Hello, I'm interested in ", "cityestate" ); ?>[<?php echo get_the_title(); ?>]</textarea>
                                    <!-- Send message button -->
                                    <button class="property_agent_send_message" name="sendmessage"><?php echo esc_html($theme_labels['submit_now']); ?></button>
                                    <!-- Store property title -->
                                    <input type="hidden" name="property_title" value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
                                    <!-- Store property link -->
                                    <input type="hidden" name="property_permalink" value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
                                    <!-- Contact agent security -->
                                    <input type="hidden" name="agent_contact_form_ajax" value="<?php echo wp_create_nonce('agent-contact-form-nonce'); ?>"/>
                                    <input type="hidden" name="agent_author_email" value="<?php echo antispambot($agent_email); ?>">
                                    <input type="hidden" name="action" value="agent_send_message">                  
                                    <div class="form_messages"></div>
                                </form><?php
                            }
                        } ?>
                    </div>
                </div>

            </div>
        </div><?php
    }

    public function update( $new_instance, $old_instance ){

        $instance = array();
        // Update widget title
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;

    }

    public function form( $instance ){
    }

}

if( ! function_exists( 'Contact_agent_of_property_loader' ) ){
    // Call property search widget
    function Contact_agent_of_property_loader(){
        register_widget( 'Contact_agent_of_property' );
    }
    add_action( 'widgets_init', 'Contact_agent_of_property_loader' );

}