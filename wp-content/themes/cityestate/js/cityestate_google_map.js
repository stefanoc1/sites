jQuery(document).ready(function($){

    "use strict";

    if( typeof CityEstate_google_map !== "undefined" ){

    	var ajaxurl         = CityEstate_google_map.admin_url;    	
    	var map_style       = CityEstate_google_map.map_style;
        var map_zoom        = CityEstate_google_map.map_zoom;        
        var infobox_close   = CityEstate_google_map.infobox_close;
        var cluster_icon    = CityEstate_google_map.cluster_icon;
        var no_found        = CityEstate_google_map.no_found;
        var city            = CityEstate_google_map.city;

        // Declare variables
        var cityestate_map;
        var markers = new Array();
        var current_marker = 0;

        // Set drag and drop status
        var drag_drop_status = true;
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
            drag_drop_status = false;
        }

        // Set property infobox style
        var infobox = new InfoBox({
            pixelOffset: new google.maps.Size(-145, -48),
            zIndex: null,
            disableAutoPan: true,
            maxWidth: 275,
            alignBottom: true,
            closeBoxMargin: "0 0 -16px -16px",
            closeBoxURL: infobox_close,
            infoBoxClearance: new google.maps.Size(1, 1),
            pane: "floatPane",
            isHidden: false,
            enableEventPropagation: false
        });        

        // Header type map option
        var header_map_option = {
            scroll:{x:jQuery(window).scrollLeft(),y:jQuery(window).scrollTop()},
            zoom: 5,
            maxZoom: 20,
            disableDefaultUI: true,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            draggable: drag_drop_status,
        };        

        var reload_marker = function(){                
            // Run loop for resert marker
            for( var i = 0; i < markers.length; i++ ){
                markers[i].setMap(null);
            }
            // Reset marker array
            markers = [];
        }

        // Google map zoom in
        var cityestate_map_zoom_in = function( cityestate_map ){
            google.maps.event.addDomListener( document.getElementById( 'google_map_zoom_in' ), 'click', function (){
                // Get current google map zoom in level
                var google_current = parseInt( cityestate_map.getZoom(),10);                    
                google_current++;
                // Check google map zoom level
                if( google_current > 20 ){
                    google_current = 20;
                }
                // Set google map zoom level
                cityestate_map.setZoom(google_current);
            });
        }

        // Google map zoom out
        var cityestate_map_zoom_out = function( cityestate_map ){
            google.maps.event.addDomListener( document.getElementById( 'google_map_zoom_out' ), 'click', function (){
                // Get current google map zoom out level
                var google_current = parseInt( cityestate_map.getZoom(),10);                    
                google_current--;                    
                // Check google map zoom level
                if( google_current < 0 ){
                    google_current = 0;
                }
                // Set google map zoom level
                cityestate_map.setZoom(google_current);
            });
        }    

        // Google map change map type
        var cityestate_change_map_type = function( cityestate_map, map_type ){
            // Check google map type
            if( map_type === 'roadmap' ){
                cityestate_map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
            } else if( map_type === 'satellite' ){
                cityestate_map.setMapTypeId( google.maps.MapTypeId.SATELLITE );
            } else if( map_type === 'hybrid' ){
                cityestate_map.setMapTypeId( google.maps.MapTypeId.HYBRID );
            } else if( map_type === 'terrain' ){
                cityestate_map.setMapTypeId( google.maps.MapTypeId.TERRAIN );
            }
            return false;
        }

        // Next property info window
        var cityestate_map_next_property = function( cityestate_map ){
            // Property counter
            current_marker++;            
            if( current_marker > markers.length ){
                current_marker = 1;
            }

            // Change property marker
            while( markers[current_marker-1].visible === false ){
                current_marker++;
                if( current_marker > markers.length ){
                    current_marker = 1;
                }
            }
            
            // Change google map zoom level
            if( cityestate_map.getZoom() < 15 ){
                cityestate_map.setZoom(15);
            }
            
            // Google map click event
            google.maps.event.trigger( markers[current_marker-1], 'click' );
        }

        // Preview property info window
        var cityestate_map_preview_property = function( cityestate_map ){
            // Property counter 
            current_marker--;

            // Change property marker
            if(current_marker < 1){
                current_marker = markers.length;
            }

            // Change google map zoom level
            while( markers[current_marker-1].visible === false ){
                current_marker--;
                if( current_marker > markers.length ){
                    current_marker = 1;
                }
            }

            // Change google map zoom level
            if( cityestate_map.getZoom() <15 ){
                cityestate_map.setZoom(15);
            }

            // Google map click event
            google.maps.event.trigger( markers[current_marker-1], 'click' );
        }

        // Cityestate Add Marker         
        var cityestate_add_marker = function( property, map ){
            
            jQuery.each(property, function(i, property){
                // Get property lat and lng
                var property_lat_lng = new google.maps.LatLng(property.lat,property.lng);

                // Set propert marker size
                var marker_size = new google.maps.Size( 44, 56 );

                // Get property url
                var marker_url = property.icon;

                // Check display is retina
                if( window.devicePixelRatio >= 2 ){
                    if( property.retinaIcon ){
                        // Set retina icon
                        marker_url = property.retinaIcon;
                        marker_size = new google.maps.Size( 84, 106 );
                    }
                }

                // Set marker icon option
                var marker_icon = { scaledSize: new google.maps.Size( 44, 56 ), url: marker_url, size: marker_size, origin: new google.maps.Point( 0, 0 ), anchor: new google.maps.Point( 7, 27 ) };

                // Set marker option
                var marker = new google.maps.Marker({ draggable: false, animation: google.maps.Animation.DROP, position: property_lat_lng, map: map, icon: marker_icon });

                // Set property title
                var property_title = property.data ? property.data.post_title : property.title;

                // Create property info box
                var infobox_detail = document.createElement("div");

                // Set class in info box
                infobox_detail.className = 'propertyerty-item item-grid map-info-box';

                // Set html for info box
                infobox_detail.innerHTML = '' +
                '<div class="property_list_grid recent-property-box1 grid-map-header">' +
                    '<div class="recent-proeprty-box1-img-box">' +
                        property.thumbnail +
                        property.property_featured +
                        property.property_status +
                        property.property_label +
                    '</div>' +
                    '<div class="recent-proeprty-box1-inner">' +
                        '<a href="'+property.url+'">' +
                            '<h3 class="property-box1-title">'+property_title+'</h3>' +
                        '</a>' +
                        property.property_address +
                        '<ul class="property-basic-info"> ' +
                            property.property_basic_deta +
                        '</ul>' +
                    '</div>' +
                    '<div class="recent-proeprty-box1-price-info">' +
                        property.property_price +
                    '</div>' +
                '</div>';

                // Add click listener
                google.maps.event.addListener(marker, 'click', (function (marker, i){                        
                    return function(){                            
                        var infobox_scale       = Math.pow(2, map.getZoom());
                        var infobox_offsety     = ( (100 / infobox_scale) || 0 );
                        var inffobox_projection = map.getProjection();
                        var marker_position     = marker.getPosition();
                        var screen_position     = inffobox_projection.fromLatLngToPoint(marker_position);
                        var screen_above        = new google.maps.Point(screen_position.x, screen_position.y - infobox_offsety);
                        var marker_lat_lng      = inffobox_projection.fromPointToLatLng(screen_above);
                        
                        // Set infobox in google map
                        map.setCenter(marker_lat_lng);

                        // Set infobox details
                        infobox.setContent(infobox_detail);
                        
                        // Add in googme map
                        infobox.open(map, marker);
                    }
                })(marker, i));
                // Return detail
                return markers.push(marker);
            });
        }

        // Remove map loader after window is loaded
        var remove_map_loader = function( map ){
            google.maps.event.addListener( map, 'tilesloaded', function(){
                jQuery( '#cityestate_map_loading' ).hide();
            });
        }

        // Property listing map
        jQuery.ajax({
            type : 'POST',
            dataType : 'json',
            url : ajaxurl,
            data : { 'action' : 'cityestate_header_map_list', 'city' : city, },
            beforeSend: function(){
                // Show map loader
                jQuery( '#cityestate_map_loading' ).show();
            },
            success: function(data){
                if(document.getElementById( 'cityestate_listing_map' ) !== null) {
                    // Initialize googme map
                    var cityestate_map = new google.maps.Map( document.getElementById( 'cityestate_listing_map' ), header_map_option );
                    google.maps.event.trigger( cityestate_map, 'resize' );
                }
                else {
                    return;
                }
                // Set google map style
                if( map_style !== '' ){
                    var styles = JSON.parse ( map_style );
                    cityestate_map.setOptions({styles: styles});
                }

                // Set map position
                var position = new google.maps.LatLng('', '');
                cityestate_map.setCenter(position);
                
                // Set map zoom level
                cityestate_map.setZoom(parseInt(map_zoom));

                // Google map zoom in set
                if( document.getElementById( 'google_map_zoom_in' ) ){
                    cityestate_map_zoom_in(cityestate_map);
                }

                // Google map zoom out set
                if( document.getElementById( 'google_map_zoom_out' ) ){
                    cityestate_map_zoom_out(cityestate_map);
                }
                
                // Change google map type
                jQuery( '.google_map_type' ).click(function(){
                    var maptype = jQuery(this).data( 'maptype' );
                    cityestate_change_map_type( cityestate_map, maptype );
                })

                // Focus next property
                jQuery( '#google_map_next_property' ).click(function(){
                    cityestate_map_next_property( cityestate_map );
                });

                // Focus previous property info window
                jQuery( '#google_map_preview_property' ).click(function(){
                    cityestate_map_preview_property( cityestate_map );
                });

                // Remove map loader
                remove_map_loader( cityestate_map );

                // Check property is found
                if( data.status === true ){

                    // Reload map makrer
                    reload_marker();

                    // Add map marker
                    cityestate_add_marker( data.property_data, cityestate_map );
                    
                    // Google map fit bounds
                    cityestate_map.fitBounds( markers.reduce(function(bounds, marker ) {
                        return bounds.extend( marker.getPosition() );
                    }, new google.maps.LatLngBounds()));

                    // Google map resize
                    google.maps.event.trigger( cityestate_map, 'resize' );

                    // Google map set cluster
                    var marker_cluster = new MarkerClusterer( cityestate_map, markers, { maxZoom : 18, gridSize : 60, styles : [ { url: cluster_icon, width: 48, height: 48, textColor: "#fff" } ] } );

                } else {
                    // Show properry not found message
                    jQuery( '#cityestate_listing_map' ).empty().html( '<div class="map-notfound">' + no_found + '</div>' );
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.responseText);
            }
        });                
    }
});