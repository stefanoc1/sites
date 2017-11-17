<?php

// Favicon Icon For Normal And Apple Device
if( ! function_exists( 'cityestate_favicon_icon' ) ){

    function cityestate_favicon_icon(){

        $output_array = array( 'link' => array( 'rel' 	=> array(), 'sizes' => array(), 'href' 	=> array() ) );

        $output = '';        
        
        // Get favicon
        $favicon 			   = cityestate_option( 'cityestate_favicon', 'url' );
        $iphone_favicon 	   = cityestate_option( 'cityestate_iphone_favicon', 'url' );
        $favicon_retina 	   = cityestate_option( 'cityestate_iphone_favicon_retina', 'url' );
        $ipad_favicon 		   = cityestate_option( 'cityestate_ipad_favicon', 'url' );
        $ipad_favicon_retina   = cityestate_option( 'cityestate_ipad_favicon_retina', 'url' );

        // Simple favicon
        if ( $favicon ) {
            $output .= '<!-- Favicon -->';
            $output .= '<link rel="shortcut icon" href="'. esc_url( $favicon ) .'">';
        }

        // Apple iPhone icon
        if ( $iphone_favicon ) {
            $output .= '<!-- Apple iPhone Icon -->';
            $output .= '<link rel="apple-touch-icon" href="'. esc_url( $iphone_favicon ) .'">';
        }

        // Apple iPhone retina icon
        if ( $favicon_retina ) {
            $output .= '<!-- Apple iPhone Retina Icon -->';
            $output .= '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url( $favicon_retina ) .'">';
        }

        // Apple iPad icon
        if ( $ipad_favicon ) {
            $output .= '<!-- Apple iPhone Icon -->';
            $output .= '<link rel="apple-touch-icon" sizes="72x72" href="'. esc_url( $ipad_favicon ) .'">';
        }

        // Apple iPad retina icon
        if ( $ipad_favicon_retina && ! $favicon_retina ) {
            $output .= '<!-- Apple iPhone Icon -->';
            $output .= '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url( $ipad_icon_retina ) .'">';
        }

        echo wp_kses( $output, $output_array);

    }

}

add_action( 'wp_head', 'cityestate_favicon_icon' );

?>