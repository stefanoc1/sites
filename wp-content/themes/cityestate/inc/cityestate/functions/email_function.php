<?php

// Cityestate send email
if( !function_exists('cityestate_send_mail') ){
    
    function cityestate_send_mail( $email_id, $email_subject, $email_message, $args ){
        // Collect the mail subject and message
        $message = cityestate_option( $email_message );
        $subject = cityestate_option( $email_subject );
        // Add the extra arguments
        $args['website_name']   = get_option('blogname');
        $args['user_email']     = $email_id;
        $args['username']       = $user->user_login;
        $user                   = get_user_by( 'email',$email_id );
        // Set dynamic value in mail from backend
        foreach( $args as $key => $val ){
            $subject = str_replace( '%'.$key, $val, $subject );
            $message = str_replace( '%'.$key, $val, $message );
        }
        // Send mail
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        @wp_mail( $email_id, $subject, $message, $headers );
    }
}

?>