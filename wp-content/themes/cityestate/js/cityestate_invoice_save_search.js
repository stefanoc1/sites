jQuery(document).ready(function($){

    'use strict';

    var confirm_message = CityEstate_invoice_save_search.confirm_message;
    var loader_spinner  = CityEstate_invoice_save_search.loader_spinner;
    var success_icon    = CityEstate_invoice_save_search.success_icon;
    var ajaxurl     = CityEstate_invoice_save_search.admin_url;

    if( typeof CityEstate_invoice_save_search !== 'undefined' ){
    	
    	// Remove save search
        jQuery('.remove_save_search').click(function(e){            
            
            e.preventDefault();            
            // Get remove search value and property id
            var remove_search   = jQuery(this);
            var property_id     = remove_search.data( 'propertyid' );
            var delete_area     = remove_search.parents( '.save_search_area' );

            // Confirm remove save search
            if( confirm(confirm_message) ){
                // Call ajax for remove save search
                jQuery.ajax({
                    url: ajaxurl,
                    dataType: 'JSON',
                    method: 'POST',
                    data: { 'action' : 'cityestate_delete_save_search', 'property_id' : property_id },
                    beforeSend: function(){
                        // Show icon before call remove search ajax
                        remove_search.children('i').remove();
                        remove_search.prepend('<i class="fa-left ' + loader_spinner + '"></i>');
                    },
                    success: function( response ){
                        // Show success message
                        if( response.success ){
                            delete_area.remove();                            
                        } else {
                        	alert( 'Problem in remove save search!' );
                        }
                    },
                    error: function( xhr, status, error ){
                        // Show error report
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }
        });

		// Filter user invoice
        jQuery( '.invoice_filter' ).click(function(){
            // Get the values from invoice filter 
            var invoice_type    = jQuery( '#invoice_type' ).val();
            var invoice_status  = jQuery( '#invoice_status' ).val();
            var startdate       = jQuery( '#startdate' ).val();
            var enddate         = jQuery( '#enddate' ).val();
            var update_invoice 	= jQuery(this);

            // Call ajax for filter invoice
            jQuery.ajax({
                url: ajaxurl,
                dataType: 'json',
                type: 'POST',
                data: { 'action' : 'cityestate_filter_invoice', 'invoice_status' : invoice_status, 'invoice_type' : invoice_type, 'startdate' : startdate, 'enddate' : enddate },
                beforeSend: function(){
                    // Show process icon before call ajax
                    update_invoice.children('i').remove();
                    update_invoice.prepend('<i class="fa-left '+loader_spinner+'"></i> ');
                },
                success: function( response ){
                    // Show filter invoice entry
                    if( response.success ){
                        jQuery('#invoices_content').empty().append( response.result );
                        jQuery('#invoices_total_price').empty().append( response.total_price );
                    } else {
                    	alert( 'Problem in invoice filter!' );
                    }
                },
                error: function( xhr, status, error ){
                    // Shw error report
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                },
                complete: function(){
                	// Hide icon after complete the ajax
                    update_invoice.children('i').removeClass(loader_spinner);
                    update_invoice.children('i').addClass(success_icon);
                }
            });
        });
    }
});