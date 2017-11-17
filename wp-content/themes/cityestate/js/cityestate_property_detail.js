jQuery(document).ready(function($){

    "use strict";

    if( typeof CityEstate_property_detail !== "undefined" ){
		
		var ajaxurl 		= CityEstate_property_detail.admin_url;
		var property_lat 	= CityEstate_property_detail.property_lat;
        var property_lng 	= CityEstate_property_detail.property_lng;
        var KM_label 		= CityEstate_property_detail.KM_label;
        var map_style 		= CityEstate_property_detail.map_style;
        var infobox_close  	= CityEstate_property_detail.infobox_close;
        var near_by_place 	= CityEstate_property_detail.near_by_place;
        var markers         = new Array();

        // Check print property available
        if( jQuery( '#print_property_detail' ).length > 0 ){
            // Print property
            jQuery( '#print_property_detail' ).click(function(e){
                // Stop submit form
                e.preventDefault();
                
                // Get property id
                var property_id 	= jQuery(this).attr( 'data-property-id' );
                var print_window    = window.open( '', 'Print Me', 'width=700', 'height=842' );

                // Call print property ajax
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: { 'action' : 'cityestate_print_property_detail', 'property_id' : property_id },
                    success: function( data ){
                        // Print property
                        print_window.document.write(data);
                        print_window.document.close();
                        print_window.focus();
                    },
                    error: function( xhr, status, error ){
                    	// Show error report
                        var err = eval( '(' + xhr.responseText + ')' );
                        alert(err.Message);
                    }
                });
            });
		}

        // Near by place
        if( jQuery( '#property_single_map' ).length > 0 ){

            // Calculate distance using latitude and longitude
            function cityestate_distance(latitude2, longitude2){
            	// Get property lat and lon    
                var lat1 = property_lat
                var lon1 = property_lng
                var lat2 = latitude2;
                var lon2 = longitude2;
                
                // Calculate property
                var radlat1 = Math.PI * lat1/180;
                var radlat2 = Math.PI * lat2/180;
                var radlon1 = Math.PI * lon1/180;
                var radlon2 = Math.PI * lon2/180;
                
                var theta 		= lon1-lon2;
                var radtheta 	= Math.PI * theta/180;
                var dist 		= Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                
                dist = Math.acos(dist);
                dist = dist * 180/Math.PI;
                dist = dist * 60 * 1.1515;
                dist = dist * 1.609344;
                
                // Return calculate
                return Math.round( dist * 100 )/100;
            }

            // Add near by place marker
            var cityestate_near_by_place = function( PointMap, Center ){
                
                jQuery.each(near_by_place, function( key, value ){
                    // Check place type is set
                    if( value.place_type != '' ){
                    	// Get google map service
                    	var service = new google.maps.places.PlacesService( PointMap );		                    
	                    // Set near by place
	                    service.nearbySearch( { location: Center, radius: 2000, types: [  value.place_type ] },
	                    	// Call place type
	                    	function call_place_type( Results, Status ){
		                        // Check place status
		                        if( Status === google.maps.places.PlacesServiceStatus.OK ){
		                            
		                            for( var i = 0; i < Results.length; i++ ){
		                               	// Place available in array
		                                if( jQuery.inArray( Results[i].place_id, PlacesIDs ) == -1 ){
		                                    // Create place marker
		                                    var Marker;
						                    Marker = new google.maps.Marker({
						                        map: PointMap,
						                        position: Results[i].geometry.location,
						                        icon: value.place_image
						                    });                
						                    // Get distance
						                    var Distance = cityestate_distance(Results[i].geometry.location.lat(),Results[i].geometry.location.lng()); 

						                    // Add near by place info
						                    jQuery( '#property_single_near_place').append( '<div class="near-location-wrap"><div class="near-location-img"><img src='+value.place_image+' alt='+ value.place_type+'/></div><div class="near-location-info"><ul><li class="left">'+ value.place_type.replace('_', ' ')+'</li><li class="right">'+Distance+' '+KM_label+'</li></ul><span>'+Results[i].name.substring(0, 40)+'</span></div></div>' );

                                            var Place_Info = new google.maps.InfoWindow({});

						                    google.maps.event.addListener(Marker, 'mouseout', function(){
						                        Place_Info.open(null,null);
						                    });							                
		                                    // Add place id in array
		                                    PlacesIDs.push( Results[i].place_id );
		                                }
		                            }
		                        }
	                   		}
	                   	);                            
                    }
                });
            }

            // Initialize near by place
            var near_map = null;
            var initialize = function(){
                // Get property lat and lng
                var property_lat_lng = new google.maps.LatLng( property_lat, property_lng );
                var map_options = {
                    center: property_lat_lng,
                    zoom: 15,
                    scrollwheel: false
                };

                // Add google map
                near_map = new google.maps.Map( document.getElementById( 'property_single_map' ), map_options );

                // Property detail
                var property_detail = jQuery( '#property_detail_google_map' ).val();

                // Call ajax for property map
                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: ajaxurl,
                    data: { 'action' : 'property_marker_info_box', 'property_id' : jQuery('.property_id').val(), 'security' : property_detail },
                    success: function( data ){
                        // Set google map style
                        if( map_style !== '' ){
                            var styles = JSON.parse ( map_style );
                            near_map.setOptions( {styles: styles} );
                        }
                        if( data.status === true ){
                            // Set property marker
                            cityestate_property_detail_marker( data.property_data, near_map );
                            // Add near by place
                            cityestate_near_by_place( near_map, near_map.getCenter());
                        }
                    },
                    error: function( errorThrown ){
                    	// Show error report
                    	alert( 'Problem in map!');
                    }
                });
            }

            // Load property map after tab is active
            if( jQuery( 'ul.property-detail.nav.nav-tabs' ).length > 0 ){
                // Set load map timeout
                jQuery( 'ul.property-detail.nav.nav-tabs li' ).on( 'click', 'a', function(event){
                    if( jQuery(this).attr('href') == "#near_by_place" ){
                       setTimeout( function(){ google.maps.event.trigger(near_map, 'resize'); near_map.setCenter( new google.maps.LatLng(property_lat, property_lng) ); }, 1000);
                    }
                });
            }
            // Call listener
            google.maps.event.addDomListener(window, 'load', initialize);
        }

        // Property get direction
        if( jQuery( '#property_get_direction' ).length > 0 ){
            
            // Address auto completed
            function init_auto_complete( PointMap, Center ){
                // Get direction service and display info
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                
                // Ser marker
                var marker = new google.maps.Marker({});                
                // Point to google map
                directionsDisplay.setMap(PointMap);                

                // Calculate the route
                var on_change_handler = function(event) {
                    event.preventDefault();
                    cityestate_calculate_route( directionsService, directionsDisplay );
                };

                // Calculate the route
                function cityestate_calculate_route( directionsService, directionsDisplay ){
                    // Google map calculate route
                    directionsService.route({
                        origin: Center,
                        destination: document.getElementById('GetDirectionsAddress').value,                    
                        travelMode: google.maps.TravelMode.DRIVING
                        }, function(response, status){
                            // Checl status
                            if( status === google.maps.DirectionsStatus.OK ){
                                marker.setVisible(false);
                                directionsDisplay.setDirections(response);
                            } else {
                                // Show failed message
                                window.alert( 'Directions request failed due to ' + status );
                            }
                        }
                    );
                }
            
                // Call get direction on click
                document.getElementById('GetDirections').addEventListener('click', on_change_handler);                
                var autocomplete = new google.maps.places.Autocomplete((document.getElementById('GetDirectionsAddress')),{types: ['geocode']});                
            }

            // Get direction
            var cityestate_get_direction = function( PointMap, Center ){
                init_auto_complete( PointMap, Center );   
            }

            // Location detail area load map
            var map = null;
            var initialize = function(){
            	// Get Property lat and lng
                var property_lat_lng = new google.maps.LatLng( property_lat, property_lng );
                
                // Set map option
                var map_options = {
                    center: property_lat_lng,
                    zoom: 15,
                    scrollwheel: false
                };

                // Initialize google map
                map = new google.maps.Map(document.getElementById('property_get_direction'), map_options);
                var property_direction = jQuery('#property_detail_google_map1').val();

                // Call ajax for property info box
                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: ajaxurl,
                    data: { 'action' : 'property_marker_info_box', 'property_id' : jQuery('.property_id').val(), 'security' : property_direction },
                    success: function( data ){
                        // Set google map style
                        if( map_style !== '' ){
                            var styles = JSON.parse ( map_style );
                            map.setOptions({styles: styles});
                        }
                        // Set propert map and info box
                        if( data.status === true ){
                            cityestate_property_detail_marker( data.property_data, map );
                            cityestate_get_direction( map, map.getCenter() );
                        }
                    },
                    error: function( errorThrown ){
                    	alert( 'Problem in map!' );
                    }
                });
            }

            // Load property map after tab is active
            if( jQuery( 'ul.property-detail.nav.nav-tabs' ).length > 0 ){
                // Set load map timeout
                jQuery( 'ul.property-detail.nav.nav-tabs li' ).on( 'click', 'a', function(event){
                    if( jQuery(this).attr('href') == "#get_directions" ){
                       setTimeout( function(){ google.maps.event.trigger(map, 'resize'); map.setCenter( new google.maps.LatLng(property_lat, property_lng) ); }, 250);
                    }
                });
            }
            // Call listener
            google.maps.event.addDomListener(window, 'load', initialize);
        }
        var PlacesIDs = new Array();
        // Set google map ifobox
        var infobox = new InfoBox({
            closeBoxMargin: "0 0 -16px -16px",
            closeBoxURL: infobox_close,
            infoBoxClearance: new google.maps.Size(1, 1),
            disableAutoPan: true,
            maxWidth: 275,
            alignBottom: true,
            pixelOffset: new google.maps.Size(-145, -48),
            zIndex: null,
            pane: "floatPane",
            isHidden: false,                
            enableEventPropagation: false
        });

        // Add map marker
        var cityestate_property_detail_marker = function( property, map ){
            
            jQuery.each(property, function(i, property){
            	// Get property lat and lng
                var property_lat_lng = new google.maps.LatLng( property.lat,property.lng );

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
                var marker_icon = { origin: new google.maps.Point( 0, 0 ), scaledSize: new google.maps.Size( 44, 56 ), anchor: new google.maps.Point( 7, 27 ), size: marker_size, url: marker_url };

                // Set marker option
                var marker = new google.maps.Marker({ icon: marker_icon, position: property_lat_lng, map: map, draggable: false, animation: google.maps.Animation.DROP });

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
                        var infobox_offsety   	= ( (100 / infobox_scale) || 0 );
                        var inffobox_projection = map.getProjection();
                        var marker_position     = marker.getPosition();
                        var screen_position    	= inffobox_projection.fromLatLngToPoint(marker_position);
                        var screen_above    	= new google.maps.Point(screen_position.x, screen_position.y - infobox_offsety);
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
        
        // Property detail expand more description
        jQuery( '.property-items-blocks .property_description .expand-link' ).click(function(){
            // Property detail expand text
            jQuery( '.property-items-blocks .property_description .expand-txt' ).css( 'display', 'block' );
            jQuery( '.property-items-blocks .property_description .expand-link' ).css( 'display', 'none' );
        });

        var icon_spinner = 'fa fa-spin fa-spinner';

        // Send message to property agent
        jQuery( '.property_agent_send_message' ).click(function(e){
            // Stop form submit
            e.preventDefault();

            // Collect agent detail
            var agent_this      = jQuery(this);
            var agent_form      = agent_this.parents( 'form' );
            var agent_result    = agent_form.find('.form_messages');

            // Call ajax for send message to agent
            jQuery.ajax({
                url: ajaxurl,
                data: agent_form.serialize(),
                method: agent_form.attr('method'),
                dataType: "JSON",
                beforeSend: function(){
                	// Show process icon before call ajax
                    agent_this.children('i').remove();
                    agent_this.prepend('<i class="fa-left '+icon_spinner+'"></i> ');
                },
                success: function( response ){
                    if( response.success ){
                        // Show success message
                        agent_result.empty().append(response.message);
                        // Clear input box
                        agent_form.find('textarea').val('');
                        agent_form.find('input').val('');                        
                    } else {
                    	// Reset message
                        agent_result.empty().append(response.message);
                    }
                },
                error: function( xhr, status, error ){
                    // Show error report
                    var err = eval( '(' + xhr.responseText + ')' );
                    alert(err.Message);
                },
                complete: function(){
                    // Remove process logo after complete ajax
                    agent_this.children('i').removeClass(icon_spinner);
                    agent_this.children('i').addClass(success_icon);
                }
            });
        });

        // Property detail tabs settings
        jQuery( 'ul.property-detail-tabs li' ).first().addClass( 'active' );
        if( jQuery( 'ul.property-detail.nav.nav-tabs' ).length > 0 ){
            jQuery( 'ul.property-detail.nav.nav-tabs li' ).first().addClass( 'active' );
            jQuery( '.tab-content' ).find( jQuery( 'ul.property-detail.nav.nav-tabs li' ).first().find('a').attr('href') ).addClass( 'in active' );
        }

        // Property detail page manage tabs
        jQuery( 'ul.property-detail-tabs li' ).on( 'click', 'a', function(event){
            event.preventDefault();                

            // Remove active class
            jQuery( 'ul.property-detail-tabs li' ).removeClass( 'active');
            jQuery(this).parent().addClass( 'active' );

            // Set tab animation
            jQuery( 'html, body' ).animate({ scrollTop: jQuery( jQuery.attr( this, 'href' ) ).offset().top - 75 }, 1000);
        });

        // Set property direction tab
        if( jQuery( '.property-directions' ).length > 0 ){
            // Set delay in property direction tab
            jQuery( '.property-directions' ).on( 'click', function(event){
                event.preventDefault();
                jQuery( 'html, body' ).animate({ scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top - 75 }, 1000 );
            });
        }
    }
});