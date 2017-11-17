<?php

// Property agent send message
if( !function_exists( 'agent_send_message' ) ){
    
    function agent_send_message(){

        // Verify nonce
        if( wp_verify_nonce( $_POST['agent_contact_form_ajax'], 'agent-contact-form-nonce') ){            

            // Get agnet email
            $agent_email = sanitize_email($_POST['agent_author_email']);
            $agent_email = is_email($agent_email);

            // Check agent email id
            if( !$agent_email ){ 
                // Return failed message
                echo json_encode( array( 'success' => false, 'message' => sprintf( esc_html__( '%s Target Email address is not properly configured!', 'cityestate' ), $agent_email ) ) );
                wp_die();
            }

            // Get and check visiter name
            $visiter_name = sanitize_text_field( $_POST['full_name'] );
            if( empty($visiter_name) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Name field is empty!', 'cityestate' ) ) );
                wp_die();
            }
            
            // Get and check visiter email address
            $visiter_email = sanitize_email( $_POST['email_address'] );
            $visiter_email = is_email( $visiter_email );
            if( !$visiter_email ){ 
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Provided Email address is invalid!', 'cityestate' ) ) );
                wp_die();
            }

            // Get and check visiter phone number
            $visiter_phone = sanitize_text_field( $_POST['p_number'] );
            if( empty($visiter_phone) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Your phone is empty!' , 'cityestate' ) ) );
                wp_die();
            }

            // Get and check visiter message
            $visiter_message = wp_kses_post( $_POST['message'] );
            if( empty($visiter_message) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Your message is empty!' , 'cityestate' ) ) );
                wp_die();
            }

            // Get propert info
            $property_title = sanitize_text_field( $_POST['property_title'] );
            $property_link  = esc_url( $_POST['property_permalink'] );

            // Email body
            $body = esc_html__( 'You have received a message from: ', 'cityestate' ) . $visiter_name . " <br/>";
            
            // Set property title
            if( !empty($property_title) ){
                $body .= "<br/>" . esc_html__( 'Property Title : ', 'cityestate' ) . $property_title . " <br/>";
            }

            // Set property link
            if( !empty($property_link) ){
                $body .= esc_html__( 'Property URL : ', 'cityestate' ) . '<a href="'. $property_link. '">' . $property_link . "</a> <br/>";
            }

            // Set phone number
            if( !empty($visiter_phone) ){
                $body .= esc_html__( 'Phone Number : ', 'cityestate' ) . $visiter_phone . " <br/>";
            }

            $body .= "<br/>" . esc_html__( 'Additional message is as follows.', 'cityestate' ) . " <br/>";
            
            $body .= wpautop( $visiter_message ) . " <br/>";
            
            $body .= sprintf( esc_html__( 'You can contact %s via email %s', 'cityestate' ), $visiter_name, $visiter_email );

            // Set email subject
            $subject = sprintf( esc_html__( 'New message sent by %s using agent contact form at %s', 'cityestate' ), $visiter_name, get_bloginfo('name') );

            // Set header info
            $header  = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header  = apply_filters( 'agent_mail_header', $header );
            $header .= 'From: ' . $visiter_name . " <" . $visiter_email . "> \r\n";

            // Send email to agent
            if( wp_mail( $agent_email, $subject, $body, $header ) ){
                // Return success message
                echo json_encode( array( 'success' => true, 'message' => esc_html__( 'Message Sent Successfully!', 'cityestate' ) ) );
                wp_die();
            } else {                
                // Return failed message
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Server Error: WordPress mail function failed!', 'cityestate' ) ) );
                wp_die();
            }
        } else {
            // Return failed message
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Unverified Nonce!', 'cityestate' ) ) );
            wp_die();            
        }
    }
}
add_action( 'wp_ajax_nopriv_agent_send_message', 'agent_send_message' );
add_action( 'wp_ajax_agent_send_message', 'agent_send_message' );


// Agent detail page contact form
if( !function_exists('agent_contact_send_message') ){
    
    function agent_contact_send_message(){

        // Verify nonce
        if( wp_verify_nonce( $_POST['agent_contact_form_ajax'], 'agent_contact_form_nonce') ){

            // Get agent email id
            $agent_email = sanitize_email($_POST['agent_author_email']);
            $agent_email = is_email($agent_email);

            // Check agent email is okay
            if( !$agent_email ){
                echo json_encode( array( 'success' => false, 'message' => sprintf( esc_html__( '%s Target Email address is not properly configured!', 'cityestate' ), $agent_email ) ));
                wp_die();
            }

            // Get and check first name of visiter
            $first_name = sanitize_text_field($_POST['first_name']);
            if( empty($first_name) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'First Name field is empty!', 'cityestate' ) ) );
                wp_die();
            }

            // Get and check last name of visiter
            $last_name = sanitize_text_field($_POST['last_name']);
            if( empty($last_name) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Last Name field is empty!', 'cityestate' ) ) );
                wp_die();
            }

            $visiter_name = $first_name . ' ' .$last_name;

            // Get visiter phone number
            $visiter_phone = sanitize_text_field( $_POST['pnumber'] );

            // Get visiter email id
            $visiter_email = sanitize_email($_POST['email_address']);
            $visiter_email = is_email($visiter_email);
            if( !$visiter_email ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Provided Email address is invalid!', 'cityestate' ) ) );
                wp_die();
            }

            // Get and check visiter message
            $visiter_msg = wp_kses_post( $_POST['message'] );
            if( empty($visiter_msg) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Your message empty!', 'cityestate' ) ) );
                wp_die();
            }

            // Agent email subject
            $email_subject = sprintf( esc_html__( 'New message sent by %s using contact form at %s', 'cityestate' ), $visiter_name, get_bloginfo('name') );

            // Agent email body
            $email_body  = esc_html__( 'You have received a message from: ', 'cityestate' ) . $visiter_name .  ' <br/>';
            $email_body .= esc_html__( 'Phone Number : ', 'cityestate') . $visiter_phone . ' <br/>';
            $email_body .= esc_html__( 'Additional message is as follows.', 'cityestate' ) . ' <br/>';
            $email_body .= wpautop( $sender_msg ) . ' <br/>';
            $email_body .= sprintf( esc_html__( 'You can contact %s via email %s', 'cityestate' ), $visiter_name, $visiter_email );

            // Agent email header
            $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header = apply_filters("cityestate_agent_contact_mail_header", $header);
            $header .= 'From: ' . $visiter_name . " <" . $visiter_email . "> \r\n";

            // Send email to agent
            if( wp_mail( $agent_email, $email_subject, $email_body, $header) ){
                // Return success message
                echo json_encode( array( 'success' => true, 'message' => esc_html__( 'Message Sent Successfully!', 'cityestate' ) ) );
                wp_die();
            } else {
                // Return failed message
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Server Error: WordPress mail function failed!', 'cityestate' ) ) );
                wp_die();
            }
        } else {
            // Return nonce verify failed message
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Unverified Nonce!', 'cityestate' ) ) );
            wp_die();
        }
    }
}
add_action( 'wp_ajax_nopriv_agent_contact_send_message', 'agent_contact_send_message' );
add_action( 'wp_ajax_agent_contact_send_message', 'agent_contact_send_message' );

?>