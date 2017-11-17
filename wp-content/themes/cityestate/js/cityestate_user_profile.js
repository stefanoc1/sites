jQuery(document).ready(function(jQuery){

    'use strict';

    if( typeof CityEstate_user_profile !== 'undefined' ){

        var ajaxurl       = CityEstate_user_profile.ajaxurl;
        var upload_nonce  = CityEstate_user_profile.upload_nonce;
        var file_format   = CityEstate_user_profile.file_format;

        // Update user profile
        jQuery( '#update_user_profile' ).on( 'submit', function(e){

            e.preventDefault();
            // Collect the user data
            var user_data   = jQuery(this).serialize();
            var action      = 'cityestate_ajax_update_profile';

            jQuery.ajax({
                type        : 'POST',
                url         : ajaxurl + '?action=' + action,
                dataType    : 'json',
                data        : user_data,
                success: function(data){
                    // Clear profile status
                    jQuery( 'p.status' ).html('');
                    if( data.success ){
                        // Show success status
                        jQuery( 'p.status' ).html( data.message).fadeIn();
                    } else {
                        // Show error status
                        for( var i=0; i < data.errors.length; i++ ){
                            jQuery( 'p.status' ).append( '<p>' + data.errors[i] + '</p>' );
                        }
                        jQuery( 'p.status' ).fadeIn();
                    }
                }
            });
        });

        // Initialize uploader
        var uploader = new plupload.Uploader({
            browse_button: 'user-profile-image',
            file_data_name: 'profile_image_file',
            container: 'plupload-container',
            multi_selection : false,
            url: ajaxurl + '?action=cityestate_profile_image_upload&nonce=' + upload_nonce,
            filters: { mime_types : [ { title : file_format, extensions : 'jpg,jpeg,gif,png' } ], max_file_size: '2000kb', prevent_duplicates: true }
        });
        uploader.init();

        // Run after adding image file
        uploader.bind( 'FilesAdded', function(up, files){
            var profile_image = "";
            plupload.each(files, function(file){
                profile_image += '<div id="holder-' + file.id + '" class="user-profile-image">' + '' + '</div>';
            });
            document.getElementById( 'user-profile-img' ).innerHTML = profile_image;
            up.refresh();
            uploader.start();
        });

        // Run during upload image
        uploader.bind( 'UploadProgress', function( up, file ){
            document.getElementById( 'holder-' + file.id ).innerHTML = '<span>' + file.percent + '%</span>';
        });

        // Error report
        uploader.bind( 'Error', function( up, error ){
            document.getElementById( 'errors-report' ).innerHTML += '<br/>' + 'Error #' + error.code + ': ' + error.message;
        });

        // Files uploaded successfully
        uploader.bind( 'FileUploaded', function( up, file, ajax_response ){
            var response = jQuery.parseJSON( ajax_response.response );
            
            if( response.success ){
                var profile_img_element = 
                '<img src="' + response.url + '" alt="" />' +
                '<input type="hidden" class="user_profile_image" id="user_profile_image" name="user_profile_image" value="' + response.attachment_id + '"/>';

                document.getElementById( "holder-" + file.id ).innerHTML = profile_img_element;
            } else {
                // Error report
                alert( "User Profile :- " + response );
            }
        });

        // Change user password
        jQuery( '#change_password' ).on( 'submit', function(e){

            e.preventDefault();
            // Get form data
            var user_data   = jQuery(this).serialize();
            var action      = 'cityestate_ajax_password_change';

            jQuery.ajax({
                type        : 'POST',
                url         : ajaxurl + "?action=" + action,
                dataType    : 'json',
                data        : user_data,
                success: function(data){
                    // Clear message
                    jQuery( 'p.change_password' ).html('');
                    if( data.success ){
                        // Show success message
                        jQuery( 'p.change_password' ).html( data.message).fadeIn();                    
                        location.reload();
                    } else {
                        // Show error message
                        for( var i=0; i < data.errors.length; i++ ){
                            jQuery( 'p.change_password' ).append( '<p>' + data.errors[i] + '</p>' );
                        }
                        jQuery( 'p.change_password' ).fadeIn();                    
                    }
                    // Clear all password fields
                    jQuery( '#oldpassword, #newpassword, #confirmpassword' ).val('');
                }
            });
        });
    }
});