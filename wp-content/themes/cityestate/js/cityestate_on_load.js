jQuery(document).ready(function($){

    'use strict';

    if( typeof CityEstate_on_load !== 'undefined' ){

        var ajaxurl = CityEstate_on_load.admin_url;

        // Retina logo
        var retina_logo         = CityEstate_on_load.retina_logo;
        var retina_logo_width   = CityEstate_on_load.retina_logo_width;
        var retina_logo_height  = CityEstate_on_load.retina_logo_height;

        // Transparent retina logo
        var transparent_menu        = CityEstate_on_load.transparent_menu;
        var transparent_retina_logo = CityEstate_on_load.transparent_retina_logo;        

        // Advance search min and max price
        var min_price = parseInt( CityEstate_on_load.min_price );
        var max_price = parseInt( CityEstate_on_load.max_price );
        
        // Advance search selected min and max price
        var selected_min_price = parseInt( CityEstate_on_load.selected_min_price );
        var selected_max_price = parseInt( CityEstate_on_load.selected_max_price );

        // Property price symbol and decimal
        var price_symbol  = CityEstate_on_load.price_symbol;
        var price_decimal = CityEstate_on_load.price_decimal;

        // Advance search keywork autocomplete
        var is_keyword_auto         = CityEstate_on_load.is_keyword_auto;
        var keyword_autocomplete    = CityEstate_on_load.keyword_autocomplete;        

        // Get current user id
        var user_id = CityEstate_on_load.user_id;

        // Icon
        var icon_spinner  = 'fa fa-spin fa-spinner';
        var icon_check    = 'fa fa-check';        


        // Set retina logo
        if( retina_logo !== '' && retina_logo_width !== '' && retina_logo_height !== '' ){
            if( window.devicePixelRatio == 2 ){
                jQuery( '.main-logo img' ).attr( 'src', retina_logo );
                jQuery( '.main-logo img' ).attr( 'width', retina_logo_width );
                jQuery( '.main-logo img' ).attr( 'height', retina_logo_height );
            }
        }

        // Transparent retina logo
        if( transparent_retina_logo !== '' && retina_logo_width !== '' && retina_logo_height !== '' ){
            if( window.devicePixelRatio == 2 ){
                jQuery( '.header-transparent img' ).attr( 'src', transparent_retina_logo );
                jQuery( '.header-transparent img' ).attr( 'width', retina_logo_width );
                jQuery( '.header-transparent img' ).attr( 'height', retina_logo_height );
            }            
        }

        // Advance search price slider
        jQuery( '.property-price-range' ).slider({
            range: true,
            min: min_price,
            max: max_price,
            values: [ selected_min_price, selected_max_price ],
            slide: function( event, ui ) {
                jQuery( '.amount' ).val( price_symbol + price_decimal_get( ui.values[0] ) + ' - ' + price_symbol + price_decimal_get( ui.values[1] ) );
                jQuery( '.min_price' ).val( price_decimal_get( ui.values[0] ) );
                jQuery( '.max_price' ).val( price_decimal_get( ui.values[1] ) );
            }
        });

        // Set amount
        jQuery( '.amount' ).val( price_symbol + price_decimal_get( jQuery( '.property-price-range' ).slider( 'values', 0 ) ) + ' - ' + price_symbol + price_decimal_get( jQuery( '.property-price-range' ).slider( 'values', 1 ) ) );

        // Advance search price decimal
        function price_decimal_get( price ){
            price           += '';
            var price       = price.split('.');
            var price_1     = price[0];
            var price_2     = price.length > 1 ? '.' + price[1] : '';
            var price_mix   = /(\d+)(\d{3})/;

            // Run number loop
            while( price_mix.test(price_1) ){
                price_1 = price_1.replace( price_mix, '$1' + price_decimal + '$2' );
            }
            return price_1 + price_2;
        }

        // Advance search keywork autocomplete
        if( is_keyword_auto != 0 ){
            // Auto complete
            var keywork_source  = jQuery.parseJSON( keyword_autocomplete );
            var keyword_auto    = jQuery('input[name="keyword"]').autocomplete({ source: keywork_source, delay: 300, minLength: 1,
                change: function(){ var current_form = jQuery(this).parents( 'form' ); }
            });
            // List auto complete
            keyword_auto.autocomplete( 'option', 'change' );
        }

        // Add or remove favorite property
        jQuery( '.add-favorite' ).click(function(){
            // Get icon and property id
            var change_icon  = jQuery(this).children( 'i' );
            var property_id  = jQuery(this).attr( 'data-propertyid' );
            
            // Get current user id and open login model
            if( parseInt( user_id, 10 ) === 0 ){
                jQuery( '#ce-login-model' ).modal( 'show' );
            } else {
                // Call ajax for add favorite property
                jQuery.ajax({
                    type: 'post',
                    url: ajaxurl,
                    dataType: 'json',
                    data: { 'action': 'cityestate_favorite_property', 'property_id': property_id },
                    success: function( data ){
                        // Active and deactive heart icon
                        if( data.add ){
                            change_icon.removeClass( 'fa-heart-o' ).addClass( 'fa-heart' );
                        } else {
                            change_icon.removeClass( 'fa-heart' ).addClass( 'fa-heart-o' );
                        }
                    },
                    error: function( xhr, status, error ){
                        // Show error report
                        var err = eval( '(' + xhr.responseText + ')' );
                        alert(err.Message);
                    }
                });
            }
        });

        // Save property search result
        jQuery( '#result_save_search' ).click(function(e) {
            e.preventDefault();
            // Get property search parameter
            var save_search = jQuery(this);
            var save_search_from = jQuery( '#save_search_form' );
            
            // Get current user id and open login model
            if( parseInt( user_id, 10 ) === 0 ) {
                jQuery( '#ce-login-model' ).modal( 'show' );
            } else {
                // Call ajax for save property result
                jQuery.ajax({
                    url: ajaxurl,
                    data: save_search_from.serialize(),
                    method: save_search_from.attr( 'method' ),
                    dataType: 'JSON',
                    beforeSend: function(){
                        // Show icon before start ajax
                        save_search.children( 'i' ).remove();
                        save_search.prepend( '<i class="fa-left ' + icon_spinner + '"></i>' );
                    },
                    success: function( response ){
                        // Show success message
                        if( response.success ){
                            jQuery( '#result_save_search' ).addClass( 'saved' );
                        } else {
                            alert( 'Failed save search!' );
                        }
                    },
                    error: function( xhr, status, error ){
                        // Show error report
                        var err = eval( '(' + xhr.responseText + ')' );
                        alert(err.Message);
                    },
                    complete: function(){
                        // Remove icon after end ajax
                        save_search.children('i').removeClass(icon_spinner);
                    }
                });
            }
        });

        // Contact agent form on agent detail page
        jQuery( '.agent_detail_contact' ).click(function(e){            
            // Stop form submit
            e.preventDefault();
            
            // Get agent detail
            var agent_this      = jQuery(this);
            var agent_form      = agent_this.parents( 'form' );
            var agent_result    = agent_form.find( '.form_messages' );

            // Call ajax for send message to agent
            jQuery.ajax({
                url: ajaxurl,
                data: agent_form.serialize(),
                method: agent_form.attr('method'),
                dataType: "JSON",
                beforeSend: function(){
                    // Show process loader
                    agent_this.children( 'i' ).remove();
                    agent_this.prepend( '<i class="fa-left '+icon_spinner+'"></i> ' );
                },
                success: function( response ){
                    if( response.success ){
                        // Show success message
                        agent_result.empty().append(response.message);
                        agent_this.children( 'i' ).addClass(icon_check);
                        // Clear input element
                        agent_form.find( 'input' ).val('');
                        agent_form.find( 'textarea' ).val('');
                    } else {
                        // Return failed message
                        agent_result.empty().append(response.message);                        
                    }
                },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                },
                complete: function(){
                    // Remove processicon
                    agent_this.children( 'i' ).removeClass(icon_spinner);
                }
            });
        });
    }
});