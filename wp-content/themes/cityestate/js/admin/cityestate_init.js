jQuery(document).ready(function($){
    "use strict";

    // On change call few functions
    jQuery( '#page_template' ).change(cityestate_template);
    jQuery( '#header_type' ).change(cityestate_header_type);
    jQuery( '#list_tab' ).change(cityestate_show_hide);

    // Wrap the div in page header setting
    jQuery( '#cityestate_page_setting .inside .rwmb-meta-box > div:gt(0):lt(2)' ).wrapAll( '<div id="page_header_same">' );
    jQuery( '#cityestate_page_setting .inside .rwmb-meta-box > div:gt(1):lt(1)' ).wrapAll( '<div id="page_header_slider">' );
    jQuery( '#cityestate_page_setting .inside .rwmb-meta-box > div:gt(2):lt(4)' ).wrapAll( '<div id="page_banner_image">' );
    jQuery( '#cityestate_page_setting .inside .rwmb-meta-box > div:gt(3):lt(1)' ).wrapAll( '<div id="page_header_map">' );

    jQuery( '#listing_template .inside .rwmb-meta-box > div:gt(1):lt(1)' ).wrapAll( '<div id="property_tabs">' );    

    // Check page template in admin page
    function cityestate_template(){
        // Get template value attribute
        var template = jQuery('#page_template').attr('value');
        // Add splash setting
        jQuery('#cityestate_splash_setting').hide();
        // Check is splash template page
        if( template == 'templates/template_splash.php' ){            
            jQuery('#cityestate_page_setting').hide();
            jQuery('#cityestate_splash_setting').stop(true,true).fadeIn(500);
        } else {
            jQuery('#cityestate_page_setting').stop(true,true).fadeIn(500);
            jQuery('#cityestate_splash_setting').hide();
        }
        // Check is list template page
        if( template == 'templates/property_listing.php' ){            
            jQuery('#listing_template').stop(true,true).fadeIn(500);
        } else {
            jQuery('#listing_template').hide();
        }
    }

    // Tab show or hide
    function cityestate_show_hide(){
        // Property list type
        var tabs = jQuery('#list_tab').attr('value');        
        if( tabs == 'enable' ){
            jQuery('#property_tabs').stop(true,true).fadeIn(500);            
        } else {
            jQuery('#property_tabs').hide();
        }
    }

    // Check header type from admin page
    function cityestate_header_type(){        
        // Get header value
        var header_type = jQuery( '#header_type' ).attr( 'value' );
        jQuery( '#page_header_slider, #page_banner_image, #page_header_same, #page_header_map' ).hide();

        // Check header type
        if( header_type == 'revolution_slider' ){            
            jQuery( '#page_header_slider' ).stop(true,true).fadeIn(500);
        } else if( header_type == 'static_image' ){            
            jQuery( '#page_banner_image, #page_header_same').stop(true,true).fadeIn(500);
        } else if ( header_type == 'property_slider' ){            
            jQuery( '#page_header_same, #page_header_map' ).hide();
        } else if ( header_type == 'property_map' ){            
            jQuery( '#page_header_map' ).stop(true,true).fadeIn(500);
        }
    }

    // Window on load call the functions
    jQuery(window).load(function(){
        // Check the page template
        cityestate_template();
        // Check the header type
        cityestate_header_type();
        // Check the show hide element
        cityestate_show_hide();
    });    
	
});