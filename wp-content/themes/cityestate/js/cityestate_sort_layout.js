jQuery(document).ready(function($){

    'use strict';

    if( typeof CityEstate_sort_layout !== 'undefined' ){

    	var property_view = CityEstate_sort_layout.property_view;
        // Property sort on change
        jQuery( '#property_sort' ).on( 'change', function(e){
            var j       = '';
            var key     = encodeURI( 'sortby' );
            var value   = encodeURI( jQuery(this).val() );
            
            // Find current property order
            var property_sort = document.location.search.substr(1).split('&');
            
            // Fine the order length
            var i = property_sort.length;
            while( i-- ){
                // Filter the order
                j = property_sort[i].split('=');
                if( j[0] == key ){
                    j[1] = value;
                    property_sort[i] = j.join('=');
                    break;
                }
            }
            if( i < 0 ){
                property_sort[property_sort.length] = [key, value].join('=');
            }            
            document.location.search = property_sort.join('&');            
        });

        // Set property layout
        if( jQuery.cookie( 'property_view' ) == null || jQuery.cookie( 'property_view' ) == '' || jQuery.cookie( 'property_view' ) == 'undefined' ){
            jQuery.cookie( 'property_view', property_view );
        }

        // Property page layout cookies
        jQuery( '.property_view_link' ).click(function(){
            // Remove current cookie
            jQuery.removeCookie( 'property_view' );
            // Change cookie value
            if( jQuery(this).hasClass( 'property_list_view' ) ){
                jQuery.cookie( 'property_view', 'list_list_view' );
            } else if(jQuery(this).hasClass( 'property_grid_view' ) ){
                jQuery.cookie( 'property_view', 'list_grid_view' );
            }
        });
        
        // Change property list layout
        if( jQuery.cookie( 'property_view' ) != null || jQuery.cookie( 'property_view' ) != '' || jQuery.cookie( 'property_view' ) != 'undefined' ){
            if( jQuery.cookie( 'property_view') == 'list_list_view' ){
                jQuery( '.property_list_grid' ).hide();
                jQuery( '.property_list_list' ).show();
            } else if( jQuery.cookie('property_view') == 'list_grid_view'){      
                jQuery( '.property_list_list' ).hide();
                jQuery( '.property_list_grid' ).show();
            }
        }    
    }
});