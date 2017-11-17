jQuery(document).ready(function($){

    'use strict';

    if( typeof CityEstate_login_register !== 'undefined' ){

        var admin_url       = CityEstate_login_register.admin_url;
        var login_redirect  = CityEstate_login_register.login_redirect;
        var login_process   = CityEstate_login_register.login_process;
        
        // Login user
        jQuery( '.user_login_link' ).click(function(e){
            
            e.preventDefault();
            
            // Collect value from login form
            var login_form  = jQuery(this);            
            var form_parent = login_form.parents( 'form' );
            var login_msg   = login_form.parents( '.user_login_area' ).find( '.login_register_msg' );

            // Call ajax for login user
            jQuery.ajax({
                type: 'post',
                url: admin_url,
                dataType: 'json',
                data: form_parent.serialize(),
                beforeSend: function(){ login_msg.empty().append('<p class="success text-success"> ' + login_process + '</p>' ); },
                success: function( response ){
                    // User login response
                    if( response.success ){
                        // Login success message
                        login_msg.empty().append( '<p class="success text-success"><i class="fa fa-check"></i> ' + response.message + '</p>' );
                        if( login_redirect == 'same_page' ){
                            location.reload();
                        } else {
                            location.href = login_redirect;
                        }
                    } else {
                        // Login failed message
                        login_msg.empty().append( '<p class="error text-danger"><i class="fa fa-close"></i> ' + response.message + '</p>' );
                    }
                },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
        });

        // Register user
        jQuery( '.user_register_link' ).click(function(e){
            
            e.preventDefault();

            // Collect value from register form
            var register_form   = jQuery(this);
            var form_parent     = register_form.parents( 'form' );
            var register_msg    = register_form.parents( '.user_login_area' ).find( '.login_register_msg_register' );

            // Call ajax for register user
            jQuery.ajax({
                type: 'post',
                url: admin_url,
                dataType: 'json',
                data: form_parent.serialize(),
                beforeSend: function(){ register_msg.empty().append( '<p class="success text-success"> ' + login_process + '</p>' ); },
                success: function( response ){
                    // Return register user status
                    if( response.success ){
                        register_msg.empty().append( '<p class="success text-success"><i class="fa fa-check"></i> ' + response.message + '</p>' );
                    } else {
                        register_msg.empty().append( '<p class="error text-danger"><i class="fa fa-close"></i> ' + response.message + '</p>' );
                    }
                },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });            

        });       

        // Reset password user
        jQuery( '.user_reset_password_link' ).click(function(e){
            e.preventDefault();

            // Collect value from reset password form
            var register_form   = jQuery(this);
            var form_parent     = register_form.parents( 'form' );

            // Call ajax for reset password
            jQuery.ajax({
                type: 'post',
                url: admin_url,
                dataType: 'json',
                data: form_parent.serialize(),
                success: function( response ) {
                    // Return reset password status
                    if( response.success ){
                        jQuery( '#reset_message' ).empty().append( '<p class="success text-success"><i class="fa fa-check"></i> ' + response.message + '</p>' );
                    } else {
                        jQuery( '#reset_message' ).empty().append( '<p class="error text-danger"><i class="fa fa-close"></i> ' + response.message + '</p>' );
                    }
                },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
        });

        // User login with facebook
        jQuery( '.login_with_facebook' ).click(function(){
            // Collect data from facebook element
            var fb_current  = jQuery(this);
            var form        = fb_current.parents( 'form' );
            var fb_msg      = fb_current.parents( '.user_login_area' ).find( '.login_register_msg' );

            // Call ajax for login user with facebook
            jQuery.ajax({
                type: 'POST',
                url: admin_url,
                data: { 'action' : 'cityestate_user_login_with_facebook' },
                beforeSend: function(){ fb_msg.empty().append( '<p class="success text-success"> ' + login_process + ' </p>' ); },
                success: function(response){ window.location.href = response; },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
        });

        // User login with google
        jQuery( '.login_with_google' ).click(function () {
            // Collect data from google element
            var gog_current = jQuery(this);
            var form        = gog_current.parents( 'form' );
            var gog_msg     = gog_current.parents( '.user_login_area' ).find( '.login_register_msg' );

            // Call ajax for login user with google
            jQuery.ajax({
                type: 'POST',
                url: admin_url,
                data: { 'action' : 'cityestate_user_login_with_google' },
                beforeSend: function(){ gog_msg.empty().append( '<p class="success text-success"> ' + login_process + '</p>' ); },
                success: function( response ){ window.location.href = response; },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
        });

        // User login with yahoo
        jQuery('.login_with_yahoo').click(function () {
            
            var current = jQuery(this);
            var form = current.parents( 'form' );
            var messages = current.parents( '.user_login_area' ).find( '.login_register_msg' );

            // Call ajax for login user with yahoo
            jQuery.ajax({
                type: 'POST',
                url: admin_url,
                data: { 'action' : 'cityestate_user_login_with_yahoo' },
                beforeSend: function(){ messages.empty().append( '<p class="success text-success"> ' + login_process + '</p>' ); },
                success: function( response ){ window.location.href = response; },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                }
            });
        });
    }
});