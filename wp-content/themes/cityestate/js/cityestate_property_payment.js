jQuery(document).ready(function($){
    'use strict';
    if( typeof CityEstate_property_payment !== 'undefined' ){    	

        var confirm_featured_msg    = CityEstate_property_payment.confirm_featured_msg;
        var bank_connect     		= CityEstate_property_payment.bank_connect;
        var bank_text      			= CityEstate_property_payment.bank_text;
        var bank_thanks       		= CityEstate_property_payment.bank_thanks;
        var featured_label   		= CityEstate_property_payment.featured_label;
        var no_featured_left  		= CityEstate_property_payment.no_featured_left;        
        var paypal_connect   		= CityEstate_property_payment.paypal_connect;
        var price_position 			= CityEstate_property_payment.price_position;
        var paid_currency     		= CityEstate_property_payment.paid_currency;
        var bank_title    			= CityEstate_property_payment.bank_title;
        var bank_button   			= CityEstate_property_payment.bank_button;
        var bank_info  				= CityEstate_property_payment.bank_info;        
        var confirm_rearrang    	= CityEstate_property_payment.confirm_rearrang;
        var confirm_featured        = CityEstate_property_payment.confirm_featured;
        var current_tempalte        = CityEstate_property_payment.current_tempalte;        

	    // Property complete membership
        jQuery( '#cityestate_complete_membership' ).click(function(e){
        	// Stop form submit method
        	e.preventDefault();

        	// Get the hidden field values
            var currnt 						= jQuery(this);
            var paypal_payment              = jQuery("input[name='cityestate_payment_type']:checked").val();
            var cityestate_package_price    = jQuery("input[name='cityestate_package_price']").val();
            var cityestate_package_id       = jQuery("input[name='cityestate_package_id']").val();
            var cityestate_package_name     = jQuery("#cityestate_package_name").text();

            // Check payment gateway is paypal
            if( paypal_payment == 'paypal' ){
                // Show processing modal
                cityestate_processing_modal( paypal_connect );
                
                // Connect to paypal for payment
                jQuery.ajax({
	                type: 'POST',
	                url: ajaxurl,
	                data: { 'action' : 'cityestate_package_paypal_payment', 'package_price' : cityestate_package_price, 'package_name' : cityestate_package_name, 'package_id' : cityestate_package_id },
	                success: function( data ){ window.location.href = data; },
	                error: function( xhr, status, error ){
	                    // Show error report
	                    var err = eval( '(' + xhr.responseText + ')' );
	                    alert(err.Message);
	                }
	            });
            } else if( paypal_payment == 'stripe' ){
                var cityestate_form = currnt.parents('form');
                cityestate_form.find( '.cityestate_stripe_membership button' ).trigger( "click" );
            } else if( paypal_payment == 'direct_pay' ){
                // Show paypal processing modal
                cityestate_processing_modal( bank_connect );
                // Direct bank transfer payment ajax
                jQuery.ajax({
	                type: 'POST',
	                url: ajaxurl,
	                data: { 'action' : 'cityestate_direct_bank_package', 'choosed_package' : cityestate_package_id, },
	                success: function( data ){ window.location.href = data; },
	                error: function( errorThrown ){
	                	alert( 'Please try again!');
	                }
	            });
            } else {
                // Free membership package ajax
                jQuery.ajax({
	                type: 'POST',
	                url: ajaxurl,
	                data: { 'action' : 'cityestate_free_membership_package', 'choosed_package' : cityestate_package_id, },
	                success: function( data ){ window.location.href = data; },
	                error: function ( errorThrown ){
	                	// Show error report
	                	alert( 'Please try again!');
	                }
	            });
            }
            return false;
        });
        
        // Payment processing model
        var cityestate_processing_modal = function( msg ){
            var process_modal = '<div class="modal fade" id="cityestate_modal" tabindex="-1" role="dialog" aria-labelledby="cityestateModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body login_register_msg_modal">' + msg + '</div></div></div></div></div>';
            jQuery('body').append(process_modal);
            jQuery('#cityestate_modal').modal();
        }
        

        // Payment for single property listing
        jQuery( '#cityestate_property_order' ).click(function(e){
            // Stop form submission process
            e.preventDefault();
            
            // Declare variable
            var is_featured = 0;
            var is_upgrade = 0;
            
            // Get detail
            var paypal_payment 	= jQuery("input[name='cityestate_payment_type']:checked").val();
            var property_id    	= jQuery('#property_id').val();
            
            if( paypal_payment == 'paypal' ){
                // Show payment process modal
                cityestate_processing_modal( paypal_connect );
                // Call paypal property payment method
                cityestate_paypal_payment( property_id, is_featured, is_upgrade);
            } else if( paypal_payment == 'stripe' ){
                // Call stripe payment property payment method
                var cityestate_form = jQuery(this).parents('form');
                cityestate_form.find( '.cityestate_stripe_listing button' ).trigger( "click" );
            } else if( paypal_payment == 'direct_pay' ){
                // Show payment process modal
                cityestate_processing_modal( bank_connect );
                
                // Call direct bank payment property payment method
                jQuery.ajax({
	                type: 'POST',
	                url: ajaxurl,
	                data: { 'action' : 'cityestate_direct_bank_per_listing', 'property_id' : property_id }, 
	                success: function( data ){ window.location.href = data; },
	                error: function( errorThrown ){
	                	// Show error report
	                	alert( 'Please try again!');
	                }
	            });
		    }
            return false;
        });

        // Paypal payment for single property listing
        var cityestate_paypal_payment = function( property_id, is_featured, is_upgrade ){
            jQuery.ajax({
               type: 'post',
               url: ajaxurl,
               data: { 'action' : 'cityestate_paypal_payment_method', 'property_id' : property_id, 'is_featured' : is_featured, 'is_upgrade' : is_upgrade, },
                success: function( response ){ window.location.href = response; },
                error: function(xhr, status, error){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
        }
       
        jQuery( '.paypal_single_property_listing' ).click(function(){
            // Get current element object
            var current_element = jQuery(this);
            
            // Declare variable
            var is_featured = 0;
            var is_upgrade 	= 0;

            // Show payment processing modal
            cityestate_processing_modal( paypal_connect );

            // Get property id and check is featured
            var property_id     = current_element.attr( 'data-propertyid' );
            var check_featured  = current_element.parents( '.dropdown-menu' ).find( 'input' );

            // Check is featured property
            if( check_featured.prop('checked') ){
                is_featured = 1;
            } else {
                is_featured = 0;
            }
            // Call paypal payment ajax
            cityestate_paypal_payment( property_id, is_featured, is_upgrade);
        });

        // Paypal single property upgrade
        jQuery( '.paypal_single_property_listing_upgrade' ).click(function(){
            // Get current element object
            var current_element = jQuery(this);

            // Declare variable
            var is_featured = 0;
            var is_upgrade 	= 1;

            // Show payment processing modal
            cityestate_processing_modal( paypal_connect );

            // Get property id
            var property_id = current_element.attr('data-propertyid');

            // Call paypal payment ajax
            cityestate_paypal_payment( property_id, is_featured, is_upgrade);
        });

        jQuery( '.direct_bank_per_property_listing' ).click(function(){
            // Get current element object
            var current_element = jQuery(this);
            
            // Get property id and check is featured
            var property_id   	= current_element.attr('data-propertyid');
            var check_featured 	= current_element.parents('.dropdown-menu').find('input');

            // Total propert price
            var total_price = current_element.parents('.dropdown-menu').find('.submission_total_price').text();

            // Set price currency position
            if( price_position === 'after' ){
                total_price = total_price +' '+ paid_currency;
            } else {
                total_price = paid_currency +' '+ total_price;
            }

            // Total price
            total_price = bank_text + ': <strong>' + total_price + '</strong>';

            // Set property featured
            var featured_label =' data-prop-featured="0" ';

            jQuery( '#send_direct_bank' ).attr( 'data-prop-featured', 0 );
            jQuery( '#send_direct_bank' ).attr( 'data-listing', property_id );

            // Check featured property
            if( check_featured.prop('checked') ){
                featured_label =' data-prop-featured="1" ';
                jQuery( '#send_direct_bank' ).attr( 'data-prop-featured', 1 );
            }

            // Get property is upgrade
            var property_attr = jQuery(this).attr('data-isupgrade');
            if( typeof property_attr !== typeof undefined && property_attr !== false ){
                featured_label = ' data-prop-featured="1" ';
                jQuery( '#send_direct_bank' ).attr( 'data-prop-featured', 1 );
            }

            window.scrollTo(0, 0);

            var direct_transfer_modal = '<div class="modal fade" id="direct_pay_per_listing_modal" tabindex="-1" role="dialog"aria-labelledby="instructions">'+
                '<div class="modal-dialog">'+
                	'<div class="modal-content">'+
                		'<div class="modal-header">'+
                			'<h4 class="modal-title" id="instructions">'+bank_title+'</h4>'+
                			'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>'+
                		'</div>'+
                		'<div class="modal-body modal-payment">'+
                			'<div class="modal-payment-text">'+total_price+'<br>'+
                				bank_info+
                				'<div id="send_direct_bank" '+featured_label+' data-listing="'+property_id+'" class="btn btn-orange">'+bank_button+'</div>'+
                					'<span class="direct_pay_thanks"></span>'+
                				'</div>'+
                			'</div>'+
                		'</div>'+
                '</div>'+
            '</div>';

            // Show modal
            jQuery('body').append(direct_transfer_modal);
            jQuery( '#direct_pay_per_listing_modal' ).modal();            
            
            // Unbinf click event
            jQuery( '#send_direct_bank' ).unbind( 'click' );
            
            // Request for direct bank transfer
            jQuery( '#send_direct_bank' ).click(function(){
            	// Unbinf click event
                jQuery( '#send_direct_bank' ).unbind( 'click' );

                var is_featured  = jQuery(this).attr('data-prop-featured')
                var property_id  = jQuery(this).attr('data-listing');

                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: { 'action' : 'cityestate_direct_bank_per_listing', 'property_id' : property_id, 'is_featured' : is_featured, },
                    success: function( data ){
                    	// Hide option
                        jQuery( '#send_direct_bank' ).hide();
                        // Clear the modal
                        jQuery('#direct_pay_per_listing_modal .direct_pay_thanks').empty().html('<hr/>'+bank_thanks);
                    },
                    error: function( errorThrown ){
						// Show error report
                    	alert( 'Please try again!' );
                    }
                });
            });
			// Remove direct bank transfer modal
            jQuery( '#direct_pay_per_listing_modal' ).on( 'hidden.bs.modal', function(e){
                jQuery( '#direct_pay_per_listing_modal' ).remove();
            });
        });

        // User resend for approval
        jQuery( '.property_resend_for_approval' ).click(function (e) {
            // Stop form submit
            e.preventDefault();
            
            // Get property id
            var property_id = jQuery(this).attr('data-property_id');
            
            // Resend for approval call ajax
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'JSON',
                data: { 'action' : 'cityestate_property_resend_for_approval', 'property_id' : property_id },
                success: function( response ){
                    // Get response
                    if( response.success ){
                        // Show success message
                        currentDiv.parent().empty().append('<span class="label-success label">'+response.msg+'</span>');
                    } else {
                        // Show failed message
                        currentDiv.parent().empty().append('<div class="alert alert-danger">'+response.msg+'</div>');
                    }
                },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
            
            // Unbind the click event
            jQuery(this).unbind( "click" );
        });

        // Resend Property For approval - only for membership         
        jQuery( '.cityestate_resend_for_approval' ).click(function(e){
            // Stop form submit
            e.preventDefault();
            
            // Confirm the user
            if( confirm(confirm_rearrang) ){
                // Get property id
                var property_id = jQuery(this).attr('data-property_id');
                var currentDiv 	= jQuery(this);
                
                // Call ajax for property approval
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'JSON',
                    data: { 'action' : 'cityestate_resend_for_approval', 'property_id' : property_id },
                    success: function( response ) {
                    	if( response.success ) {
                            // Show success message
                            currentDiv.parent().empty().append( '<span class="label-success label">'+response.msg+'</span>' );
                            var total_listings = parseInt( jQuery( '.listings_remainings' ).text(), 10 );
                            jQuery( '.listings_remainings' ).text( total_listings - 1 );
                        } else {
                            // Show error message
                            currentDiv.parent().empty().append( '<div class="alert alert-danger">'+response.msg+'</div>' );
                        }
                    },
                    error: function(xhr, status, error) {
                        // Show error report
                        var err = eval( '(' + xhr.responseText + ')' );
                        alert(err.Message);
                    }
                });

				// Unbind click event
                jQuery(this).unbind("click");
            }
        });        

        // Make Property Featured - only for membership
        jQuery( '.make_featured_property' ).click(function (e) {
            // Stop form submit
            e.preventDefault();

            // Confirm message
            if( confirm(confirm_featured) ){
                // Get property id
                var property_id = jQuery(this).attr('data-property_id');
                var currentDiv  = jQuery(this);
				
				// Call ajax for make property featured                	
                jQuery.ajax({
	                type: 'POST',
	                url: ajaxurl,
	                dataType: 'JSON',
	                data: { 'action' : 'cityestate_make_featured_property', 'property_id' : property_id },
	                success: function( response ){
	                    if( response.success ){
	                        // Show success message
	                        var parent = currentDiv.parents( '.item-wrap' );
	                        parent.find( '.item-thumb' ).append( '<span class="label-featured label">'+featured_label+'</span>' );
	                        // Remove current div
	                        currentDiv.remove();
	                        parent.find( '.tooltip' ).remove();
	                        
	                        // Set featured label
	                        var total_featured_lists = parseInt( jQuery( '.featured_lists_remaining' ).text(), 10 );
	                        jQuery( '.featured_lists_remaining' ).text( total_featured_lists - 1 );
	                    } else {
	                        // Show failed message
	                        currentDiv.parent().empty().append('<div class="alert alert-danger">'+no_featured_left+'</div>');
	                    }
	                },
	                error: function( xhr, status, error ){
	                    // Show error report
	                    var err = eval( '(' + xhr.responseText + ')' );
	                    alert(err.Message);
	                }
	            });				
				// Unbind click event
                jQuery(this).unbind("click");
            }
        });

        // Change listing fee for featured
        jQuery( '.property_featured' ).change( function(){
            // Get parent element
            var parent = jQuery(this).parents( 'table' );
            var buttons_main_parent = jQuery(this).parents( '.per_list_button' );
            // Get property price
            var price_regular  = parseFloat( parent.find( '.submission_price' ).text() );
            // Get featured property price
            var price_featured = parseFloat( parent.find( '.submission_featured_price' ).text() );

            // Calculate total price
            var total_price = price_regular+price_featured;

            // Check radio is checked
            if( jQuery(this).is(' :checked' ) ){
                // Get total property price
                parent.find( '.submission_total_price' ).text(total_price);
                buttons_main_parent.find( '#stripe_form_simple_listing' ).hide();
                buttons_main_parent.find( '#stripe_form_featured_list' ).show();
            } else {
                // Get property simple price
                parent.find( '.submission_total_price').text(price_regular);
                buttons_main_parent.find( '#stripe_form_featured_list' ).hide();
                buttons_main_parent.find( '#stripe_form_simple_listing' ).show();
            }
        });
    
        // Property payment type
        jQuery( '.payment_actions .ce_payment_button' ).on( 'click', function(event){
            if( jQuery(this).parent().hasClass( 'open' ) != true ){
                // Payment method
                jQuery( '.payment_actions .ce_payment_button' ).parent().removeClass( 'open' );
                jQuery(this).parent().addClass( 'open' );
            } else {
                jQuery(this).parent().removeClass( 'open' );
            }
        });

        // Find payment method on click
        jQuery( 'body' ).on( 'click', function(e){
            if( !jQuery( '.payment_actions .ce_payment_button' ).is(e.target) && jQuery( '.payment_actions .ce_payment_button' ).has(e.target).length === 0 && jQuery( '.open' ).has(e.target).length === 0 ){
                jQuery( '.payment_actions .ce_payment_button' ).parent().removeClass( 'open' );
            }
        });
    }    
});