jQuery(document).ready(function($){
    "use strict";

    // Admin ajax and payment label
    var ajaxurl     = CityEstate_admin_approved.ajaxurl;
    var paid_stauts = CityEstate_admin_approved.paid_status;

    // Admin active the package list
    jQuery( '#cityestate_admin_approve_package' ).click(function(){
          
        // Get data from element
        var package_number = jQuery(this).attr( 'data-item' );
        var invoice_number = jQuery(this).attr( 'data-id' );

        // Call ajax for active pack active
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: { 'action' : 'cityestate_admin_approve_package', 'item_id' : package_number, 'invoice_id' : invoice_number },
            success: function(data){
                // Change package payment status
                jQuery( '#cityestate_admin_approve_package' ).remove();
                jQuery( '#cityestate_invoice_payment .cityestate_invoice_meta span' ).removeClass('status_not_dont');
                jQuery( '#cityestate_invoice_payment .cityestate_invoice_meta span' ).addClass('status_done');
                jQuery( '#cityestate_invoice_payment .cityestate_invoice_meta span' ).empty().html(paid_stauts);
            },
            error: function(errorThrown){
                alert( 'There was an error. Please try again later.' );
            }
        });
    });

    // Admin active the property list
    jQuery( '#cityestate_admin_approve_list' ).click(function(){
        
        // Get data from element
        var package_number = jQuery(this).attr( 'data-item' );
        var payment_type   = jQuery(this).attr( 'data-type' );
        var invoice_number = jQuery(this).attr( 'data-id' );        

        // Call ajax for active purchase listing
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: { 'action' : 'cityestate_admin_approve_list', 'item_id' : package_number, 'invoice_id' : invoice_number, 'purchase_type' : payment_type },
            success: function(data){
                // Change package payment status
                jQuery( '#cityestate_admin_approve_list' ).remove();
                jQuery( '#cityestate_invoice_payment .cityestate_invoice_meta span' ).removeClass( 'status_not_dont' );
                jQuery( '#cityestate_invoice_payment .cityestate_invoice_meta span' ).addClass( 'status_done' );
                jQuery( '#cityestate_invoice_payment .cityestate_invoice_meta span' ).empty().html( paid_stauts );
            },
            error: function(errorThrown){
                alert( 'There was an error. Please try again later.' );
            }
        });
    });
});