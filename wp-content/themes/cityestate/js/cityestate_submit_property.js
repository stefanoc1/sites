jQuery(document).ready( function($) {
    'use strict';

    // Check property submit js is define
    if( typeof CityEstate_property_ajax_call !== 'undefined' ){
        
        // Property js ajax and nonce for security
        var ajax_url        = CityEstate_property_ajax_call.ajaxURL;
        var property_nonce  = CityEstate_property_ajax_call.property_nonce;
        
        // Property upload media
        var upload_file_type    = CityEstate_property_ajax_call.upload_file_type;
        var image_limit         = CityEstate_property_ajax_call.image_limit;
        var image_size          = CityEstate_property_ajax_call.image_size;
        
        // Floor plan labels
        var floor_plan_title    = CityEstate_property_ajax_call.floor_plan_title;
        var floor_plan_size     = CityEstate_property_ajax_call.floor_plan_size;
        var floor_plan_bedroom  = CityEstate_property_ajax_call.floor_plan_bedroom;
        var floor_plan_bathroom = CityEstate_property_ajax_call.floor_plan_bathroom;
        var floor_plan_price    = CityEstate_property_ajax_call.floor_plan_price;        
        var floor_plan_image    = CityEstate_property_ajax_call.floor_plan_image;
        var floor_plan_info     = CityEstate_property_ajax_call.floor_plan_info;        
        var floor_plan_upload   = CityEstate_property_ajax_call.floor_plan_upload;
        
        // Near by place label
        var near_by_places      = CityEstate_property_ajax_call.near_by_places;
        var near_place_type     = CityEstate_property_ajax_call.near_place_type;
        var near_place_icon     = CityEstate_property_ajax_call.near_place_icon;

        // Cityestate property submit validation
        if( jQuery( '#form_submit_property' ).length ){
            jQuery( '#form_submit_property' ).validate();
        }        

        // Property gallery images
        var submit_property_gallery = function(){
            // Property media sort
            jQuery( '#submit_property_media_outer' ).sortable({ placeholder: 'sortable-placeholder' });

            // Property media initialize uploader
            var uploader = new plupload.Uploader({
                browse_button: 'upload_media',
                file_data_name: 'property_upload_file',
                container: 'plupload-container',
                drop_element: 'drag-and-drop',
                url: ajax_url + "?action=cityestate_upload_property_image&upload_nonce=" + property_nonce,
                filters: { mime_types : [ { title : upload_file_type, extensions : "jpg,jpeg,gif,png" } ], max_file_size: image_size, prevent_duplicates: true }
            });
            uploader.init();

            // Run after adding file
            uploader.bind( 'FilesAdded', function( up, files ){
                var galleryThumb = '';
                // Upload file limit
                var upload_max_file = image_limit;
                // Show error message
                if( up.files.length > upload_max_file ){
                    up.splice(upload_max_file);
                    alert( 'no more than ' + upload_max_file + ' file(s)' );
                    return;
                }
                // Set image outer element
                plupload.each(files, function(file) {
                    galleryThumb += '<div id="holder-' + file.id + '" class="gallery-thumb">' + '' + '</div>';
                });
                document.getElementById( 'submit_property_media_outer' ).innerHTML += galleryThumb;
                // Refresh uploader
                up.refresh();
                uploader.start();
            });

            // Run during upload
            uploader.bind( 'UploadProgress', function( up, file ){
                document.getElementById( 'holder-' + file.id ).innerHTML = '<span>' + file.percent + '%</span>';
            });

            // In case of error
            uploader.bind( 'Error', function( up, error ){
                document.getElementById( 'errors-log' ).innerHTML += '<br/>' + 'Error #' + error.code + ': ' + error.message;
            });

            // If files are uploaded successfully
            uploader.bind('FileUploaded', function( up, file, ajax_response ){
                var response = jQuery.parseJSON( ajax_response.response );
                // Add image
                if( response.success ){
                    var ProppertyThumbHtml =
                    '<div class="col-sm-2">' +
                        '<figure class="gallery-thumb">' +
                            '<img src="' + response.image_url + '" alt="" />' +
                            '<a class="icon remove-image" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="javascript:;" ><i class="fa fa-trash-o"></i></a>' +
                            '<a class="icon icon-fav mark-featured" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="javascript:;" ><i class="fa fa-star-o"></i></a>' +
                            '<input type="hidden" class="propperty-image-id" name="propperty_image_ids[]" value="' + response.attachment_id + '"/>' +
                            '<span style="display: none;" class="icon remove-loader"><i class="fa fa-spinner fa-spin"></i></span>' +
                        '</figure>' +
                    '</div>';

                    document.getElementById( 'holder-' + file.id ).innerHTML = ProppertyThumbHtml;
                    // bind click event with newly added gallery thumb
                    bindThumbnailEvents();
                } else {
                    // log response object
                    alert( response );                    
                }
            });
        }
        // Property submit upload media
        submit_property_gallery();

        // Bind thumbnails events with newly added gallery thumbs
        var bindThumbnailEvents = function() {

            // Remove gallery images
            jQuery( '.remove-image' ).click(function(event){
                // Show loader when image remove
                var delete_this     = jQuery(this);
                var loader = delete_this.siblings('.remove-loader');
                loader.show();

                var property_id     = delete_this.data('property-id');
                var thumbnail_id    = delete_this.data('attachment-id');

                // Remove image from folder
                var removal_request = jQuery.ajax({
                    type: 'post',
                    url: ajax_url,
                    dataType: 'json',
                    data: { 'action' : 'remove_gallery_image', 'thumbnail_id' : thumbnail_id, 'property_id' : property_id, 'remove_nonce' : property_nonce }
                });
                // Remove image element
                var gallery_thum = delete_this.closest('.gallery-thumb');
                removal_request.done(function( response ){
                    if( response.attachment_remove ){
                        gallery_thum.remove();
                    } else {
                        alert( 'Error : ' + response.reason );
                    }
                });
                // Remove image request failed
                removal_request.fail(function( jqXHR, textStatus ){
                    alert( 'Request failed: ' + textStatus );
                });
            });

            // Mark as featured image of property
            jQuery( '.mark-featured' ).click(function(){
                // Change featured image
                jQuery( '.gallery-thumb .featured_image_id' ).remove();
                jQuery( '.gallery-thumb .mark-featured i' ).removeClass( 'fa-star' ).addClass( 'fa-star-o' );

                // Get element attributes
                var featured_this   = jQuery(this);
                var thumbnail_id    = featured_this.data('attachment-id');
                var star_icon       = featured_this.find( 'i');

                // Set new image for featured
                featured_this.closest( '.gallery-thumb' ).append( '<input type="hidden" class="featured_image_id" name="featured_image_id" value="'+thumbnail_id+'">' );
                star_icon.removeClass( 'fa-star-o' ).addClass( 'fa-star' );
            });
        }
        bindThumbnailEvents();

        // Sort amenities row
        jQuery( '#cityestate_amenities_value' ).sortable({ revert: 100, placeholder: 'detail-placeholder', handle: '.sort-amenities-row', cursor: 'move' });

        // Add amenities row
        jQuery( '.add-amenities-row' ).click(function(e){
            e.preventDefault();
            // Get couter and set increment
            var number_val = jQuery(this).data( 'increment' ) + 1;            
            jQuery(this).data( 'increment', number_val );
            jQuery(this).attr({ 'data-increment' : number_val });
            // Add amenities row
            var amenities_row = 
            '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-amenities-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+
                '<td class="field-title">'+
                    '<input class="" type="text" name="property_amenities['+number_val+'][amenities_value]" id="amenities_value'+number_val+'" value="">'+
                '</td>'+
                '<td class="action-field">'+
                    '<span data-remove="'+number_val+'" class="remove-amenities-row"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';
            jQuery( '#cityestate_amenities_value' ).append( amenities_row );
            remove_row();
        });
        
        // Remove row
        var remove_row = function(){
            jQuery( '.remove-amenities-row, .remove-essential-row, .remove-intext-row, .remove-room-row, .remove-floorplan-row, .remove-near-row' ).click(function(event){
                event.preventDefault();
                var remove_this = jQuery(this);
                remove_this.closest( 'tr' ).remove();
            });
        }
        remove_row();

        // Sort essential row
        jQuery( '#cityestate_essential_value' ).sortable({ revert: 100, placeholder: 'detail-placeholder', handle: '.sort-essential-row', cursor: 'move' });

        // Add essential row
        jQuery( '.add-essential-row' ).click(function(e){
            e.preventDefault();
            // Get couter and set increment
            var number_val = jQuery(this).data( 'increment' ) + 1;            
            jQuery(this).data( 'increment', number_val );
            jQuery(this).attr({ 'data-increment' : number_val });
            // Add essential row
            var add_essential_row = 
            '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-essential-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+                
                '<td class="field-title">'+
                    '<input class="" type="text" name="property_info['+number_val+'][property_info_label]" id="essential_label_'+number_val+'" value="">'+
                '</td>'+
                '<td class="field-title">'+
                    '<input class="" type="text" name="property_info['+number_val+'][property_info_value]" id="essential_value_'+number_val+'" value="">'+
                '</td>'+
                '<td class="action-field">'+
                    '<span data-remove="'+number_val+'" class="remove-essential-row"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';
            jQuery( '#cityestate_essential_value' ).append( add_essential_row );
            remove_row();
        });

        // Sort interior and exterior row
        jQuery( '#cityestate_intext_value' ).sortable({ revert: 100, placeholder: 'detail-placeholder', handle: '.sort-intext-row', cursor: 'move' });

        // Add interior and experior row
        jQuery( '.add-intext-row' ).click(function(e){
            e.preventDefault();
            // Get counter and set increment
            var number_val = jQuery(this).data("increment") + 1;            
            jQuery(this).data('increment', number_val);
            jQuery(this).attr({ "data-increment" : number_val });
            // Add interior exterior row
            var add_interior_exterior_row = 
            '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-intext-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+                
                '<td class="field-title">'+
                    '<input class=" type="text" name="interior_exterior['+number_val+'][interior_label]" id="intext_label_'+number_val+'" value="">'+
                '</td>'+
                '<td class="field-title">'+
                    '<input class=" type="text" name="interior_exterior['+number_val+'][interior_value]" id="intext_value_'+number_val+'" value="">'+
                '</td>'+
                '<td class="action-field">'+
                    '<span data-remove="'+number_val+'" class="remove-intext-row"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';
            jQuery( '#cityestate_intext_value' ).append( add_interior_exterior_row );
            remove_row();
        });

        // Sort room dimension row
        jQuery( '#cityestate_room_value' ).sortable({ revert: 100, placeholder: 'detail-placeholder', handle: '.sort-room-row', cursor: 'move' });

        // Add room dimension row
        jQuery( ".add-room-row" ).click(function(e){
            e.preventDefault();
            var number_val = jQuery(this).data("increment") + 1;
            
            jQuery(this).data('increment', number_val);
            jQuery(this).attr({ "data-increment" : number_val });
            // Add room dimension row
            var add_room_row = 
            '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-room-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+                
                '<td class="field-title">'+
                    '<input class=" type="text" name="room_dimensions['+number_val+'][rom_dime_label]" id="room_label_'+number_val+'" value="">'+
                '</td>'+
                '<td class="field-title">'+
                    '<input class=" type="text" name="room_dimensions['+number_val+'][rom_dime_value]" id="room_value_'+number_val+'" value="">'+
                '</td>'+
                '<td class="action-field">'+
                    '<span data-remove="'+number_val+'" class="remove-room-row"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';
            jQuery( '#cityestate_room_value' ).append( add_room_row );
            remove_row();
        });
        
        // Sort floor plans
        jQuery( '#cityestate_floor_plans_main' ).sortable({ revert: 100, placeholder: 'detail-placeholder', handle: '.sort-floorplan-row', cursor: 'move' });

        // Add floor plan row
        jQuery( ".add-floorplan-row" ).click(function(e){
            e.preventDefault();
            // Set counter and get increment
            var number_val = jQuery(this).data("increment") + 1;
            jQuery(this).data('increment', number_val);
            jQuery(this).attr({ "data-increment" : number_val });
            // Add floor plan row
            var add_floor_row = '' +
            '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-floorplan-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+
                '<td class="sort-middle">'+
                    '<div class="row">'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<input name="floor_plans['+number_val+'][floor_plan_title]" type="text" placeholder="'+floor_plan_title+'" id="floor_plan_title_'+number_val+'" class="full-width-elements">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<input name="floor_plans['+number_val+'][floor_plan_room]" type="text" id="floor_plan_room_'+number_val+'" placeholder="'+floor_plan_bedroom+'" class="full-width-elements">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<input name="floor_plans['+number_val+'][floor_plan_bathroom]" type="text" id="floor_plan_bathroom_'+number_val+'" class="full-width-elements" placeholder="'+floor_plan_bathroom+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<input name="floor_plans['+number_val+'][floor_plan_price]" type="text" id="floor_plan_price_'+number_val+'" class="full-width-elements" placeholder="'+floor_plan_price+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<input name="floor_plans['+number_val+'][floor_plan_size]" type="text" id="floor_plan_size_'+number_val+'" class="full-width-elements" placeholder="'+floor_plan_size+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<div class="file-upload-block">'+
                                    '<input name="floor_plans['+number_val+'][floor_plan_image]" type="text" id="floor_plan_image_'+number_val+'" class="floor_plan_image" placeholder="'+floor_plan_image+'">'+
                                    '<button id="'+number_val+'" class="floor_plan_img btn btn-primary">'+floor_plan_upload+'</button>'+
                                '</div>'+
                                '<div id="plupload-container"></div>'+
                                '<div id="errors-log"></div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-12 col-xs-12">'+
                            '<textarea name="floor_plans['+number_val+'][floor_plan_info]" rows="4" id="floor_plan_info_'+number_val+'"  class="full-width-elements" placeholder="'+floor_plan_info+'"></textarea>'+
                        '</div>'+
                    '</div>'+
                '</td>'+
                '<td class="row-remove">'+
                    '<span data-remove="'+number_val+'" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';
            jQuery('#cityestate_floor_plans_main').append( add_floor_row );
            remove_row();
            add_floor_plan_image();
        });

        // Flor plan image
        var add_floor_plan_image = function(){            
            // Initialize uploader
            var uploader_floor = new plupload.Uploader({
                browse_button: '0',
                file_data_name: 'property_upload_file',
                container: 'plupload-container',
                drop_element: 'drag-and-drop',
                url: ajax_url + "?action=cityestate_upload_property_image&upload_nonce=" + property_nonce,
                filters: { mime_types : [ { title : upload_file_type, extensions : "jpg,jpeg,gif,png" } ], max_file_size: image_size, prevent_duplicates: true }
            });
            uploader_floor.init();

            uploader_floor.bind('FilesAdded', function(up, files){
                // Check image upload validation
                var upload_max_file = image_limit;                
                if( up.files.length > upload_max_file ){
                    up.splice(upload_max_file);
                    alert( 'no more than ' + upload_max_file + ' file(s)' );
                    return;
                }
                // Referesh uploader
                up.refresh();
                uploader_floor.start();
            });

            var active_button_id;
            
            // Run during upload 
            uploader_floor.bind( 'UploadProgress', function( up, file ){ } );

            // In case of error
            uploader_floor.bind( 'Error', function( up, error ){
                var herror = jQuery( '#'+active_button_id ).parents( 'tr' ).find( '#errors-log' ).html( 'Error #' + error.code + ': ' + error.message );
            });

            // If files are uploaded successfully
            uploader_floor.bind( 'FileUploaded', function( up, file, ajax_response ){
                var response = jQuery.parseJSON( ajax_response.response );
                if( response.success ){
                    jQuery( '#'+active_button_id ).parents( 'tr' ).find( '.floor_plan_image' ).val( response.image_url );
                } else {
                    alert ( response );
                    alert( 'error' );
                }
            });

            jQuery('.floor_plan_img').mouseenter(function(){
                active_button_id = jQuery(this).attr('id');
                uploader_floor.setOption("browse_button", jQuery(this).attr('id'));
                uploader_floor.refresh();
            });
        }
        add_floor_plan_image();

        // Property video image
        var property_video_image = function(){

            // Initialize uploader
            var uploader_video = new plupload.Uploader({
                browse_button: 'video_image',
                file_data_name: 'property_upload_file',
                container: 'plupload-container',
                drop_element: 'drag-and-drop',
                url: ajax_url + "?action=cityestate_upload_property_image&upload_nonce=" + property_nonce,
                filters: { mime_types : [ { title : upload_file_type, extensions : "jpg,jpeg,gif,png" } ], max_file_size: image_size, prevent_duplicates: true }
            });
            uploader_video.init();

            uploader_video.bind('FilesAdded', function(up, files){
                // Check image upload validation
                var upload_max_file = image_limit;                
                if( up.files.length > upload_max_file ){
                    up.splice(upload_max_file);
                    alert('no more than '+upload_max_file + ' file(s)');
                    return;
                }
                // Referesh uploader
                up.refresh();
                uploader_video.start();
            });

            var active_button_id;

            // Run during upload 
            uploader_video.bind( 'UploadProgress', function( up, file ){ } );

            // In case of error
            uploader_video.bind( 'Error', function( up, err ){
                var herror = jQuery( '#'+active_button_id ).parents( '.video_parent' ).find( '#errors-log' ).html( 'Error #' + error.code + ': ' + error.message );
            });

            // If files are uploaded successfully
            uploader_video.bind( 'FileUploaded', function( up, file, ajax_response ){
                var response = jQuery.parseJSON( ajax_response.response );
                if( response.success ){
                    jQuery( '#'+active_button_id ).parents( '.video_parent' ).find( '.property_video_image' ).val( response.image_url );
                } else {
                    alert( response );
                    alert( 'error' );
                }
            });

            jQuery( '.video_image' ).mouseenter(function(){
                active_button_id = jQuery(this).attr( 'id' );
                uploader_video.setOption( 'browse_button', jQuery(this).attr( 'id' ) );
                uploader_video.refresh();
            });
        }
        property_video_image();

        // Sort near by place
        jQuery( '#cityestate_near_by_place_main' ).sortable({ revert: 100, placeholder: 'detail-placeholder', handle: '.sort-nearbyplace-row', cursor: 'move' });

        jQuery( '.add-near-row' ).click(function(e){
            e.preventDefault();
            // Set counter and get increment
            var number_val = jQuery(this).data( 'increment' ) + 1;
            jQuery(this).data( 'increment', number_val );
            jQuery(this).attr({ 'data-increment' : number_val });

            // Set place type
            var near_by_place = '';
            jQuery.each(near_by_places, function( index, value ){
                near_by_place += '<option value='+index+'>'+value+'</option>'
            });

            var add_near_place = '' +
            '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-nearbyplace-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+
                '<td class="sort-middle">'+
                    '<div class="row">'+
                        '<div class="col-sm-4 col-xs-12">'+
                            '<div class="form-group">'+
                                '<select name="near_by_place['+number_val+'][place_type]" id="place_type_'+number_val+'" class="full-width-elements">'+
                                    near_by_place +
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-8 col-xs-12">'+
                            '<div class="form-group">'+
                                '<div class="file-upload-block">'+
                                    '<input name="near_by_place['+number_val+'][place_image]" type="text" id="place_image_'+number_val+'" class="place_image">'+
                                    '<button id="near_by_place_'+number_val+'" class="nearbyplace btn btn-primary">'+floor_plan_upload+'</button>'+
                                '</div>'+
                                '<div id="plupload-container"></div>'+
                                '<div id="errors-log"></div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</td>'+
                '<td class="row-remove">'+
                    '<span data-remove="'+number_val+'" class="remove-near-row remove"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';

            jQuery( '#cityestate_near_by_place_main' ).append( add_near_place );
            remove_row();
            add_near_by_place_image();
        });

        // Property near by place images
        var add_near_by_place_image = function(){

            // Initialize uploader
            var uploader_floor = new plupload.Uploader({
                browse_button: 'near_by_place_0',
                file_data_name: 'property_upload_file',
                container: 'plupload-container',
                drop_element: 'drag-and-drop',
                url: ajax_url + "?action=cityestate_upload_property_image&upload_nonce=" + property_nonce,
                filters: { mime_types : [ { title : upload_file_type, extensions : "jpg,jpeg,gif,png" } ], max_file_size: image_size, prevent_duplicates: true }
            });
            uploader_floor.init();

            uploader_floor.bind('FilesAdded', function(up, files){
                // Image upload limit
                var upload_max_file = image_limit;
                if( up.files.length > upload_max_file ){
                    up.splice(upload_max_file);
                    alert( 'no more than ' + upload_max_file + ' file(s)' );
                    return;
                }
                // Referesh uploader                
                up.refresh();
                uploader_floor.start();
            });

            var active_button_id;

            // Run during upload 
            uploader_floor.bind( 'UploadProgress', function( up, file ){ });

            // In case of error
            uploader_floor.bind( 'Error', function( up, error ){
                var herror = jQuery( '#'+active_button_id ).parents( 'tr' ).find( '#errors-log' ).html( 'Error #' + error.code + ': ' + error.message );
            });

            // If files are uploaded successfully
            uploader_floor.bind( 'FileUploaded', function( up, file, ajax_response ){
                var response = jQuery.parseJSON( ajax_response.response );
                if( response.success ){
                    jQuery( '#'+active_button_id ).parents( 'tr' ).find( '.place_image' ).val( response.image_url );
                } else {
                    alert ( response );
                    alert( 'error' );
                }
            });

            jQuery( '.nearbyplace' ).mouseenter(function(){
                active_button_id = jQuery(this).attr( 'id' );
                uploader_floor.setOption( 'browse_button', jQuery(this).attr('id') );
                uploader_floor.refresh();
            });
        }
        add_near_by_place_image();

        // Date picker
        if( jQuery('.input_date').length > 0 ){            
            jQuery( ".input_date" ).datepicker();
        }        
    }
});