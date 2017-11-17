jQuery(document).ready(function(){
	"use strict";
	
	if( typeof CityEstate_near_by_place_Calls_Var !== "undefined" ){

		// Near by place
        var latitude 		= parseFloat( CityEstate_near_by_place_Calls_Var.latitude );
        var longitude 		= parseFloat( CityEstate_near_by_place_Calls_Var.longitude );
        var zoom 			= parseInt( CityEstate_near_by_place_Calls_Var.zoom );
        var scrollwheel 	= CityEstate_near_by_place_Calls_Var.scrollwheel;
        var google_map_style = CityEstate_near_by_place_Calls_Var.google_map_style;
        var map_marker 		= CityEstate_near_by_place_Calls_Var.map_marker;
        var marker_image 	= CityEstate_near_by_place_Calls_Var.marker_image;
        var info_content 	= CityEstate_near_by_place_Calls_Var.info_content;
        var Near_By_Place 	= CityEstate_near_by_place_Calls_Var.Near_By_Place;
        var Distance_Label 	= CityEstate_near_by_place_Calls_Var.Distance_Label;

        if( scrollwheel == 'enable' ){
        	scrollwheel = true;
        } else {
        	scrollwheel = false;
        }

        var vc_near_by_place = null;
        var initialize = function(){
            
            var vc_near_by_place = new google.maps.Map(document.getElementById('vc_near_by_place'), {
          		zoom: zoom,
          		scrollwheel: scrollwheel,
          		center: {lat: latitude, lng: longitude},          		
        	});

        	if( google_map_style !== '' ){
                var styles = JSON.parse( google_map_style );
                vc_near_by_place.setOptions({styles: styles});
            }
        	
        	if( map_marker == 'enable' ){
	        	var marker = new google.maps.Marker({
	          		position: {lat: latitude, lng: longitude},
	          		map: vc_near_by_place,
	          		icon: marker_image
	        	});
	        	if( info_content != '' ){
		        	var infowindow = new google.maps.InfoWindow({
		          		content: info_content
		        	});
		        	marker.addListener('click', function(){
		          		infowindow.open(vc_near_by_place, marker);
		        	});
		        }
	        }

	        Cityestate_VC_Near_Place( vc_near_by_place, vc_near_by_place.getCenter());
	        
        }

        // Get near by place
        var Cityestate_VC_Get_Near_Place = function( Position, PointMap, PointType, PointIcon ){
                
            var Service = new google.maps.places.PlacesService( PointMap );

            var PlacesIDs = new Array();

            Service.nearbySearch({ location: Position, radius: 1100, types: [ PointType ] }, function Place_Call_Back( Results, Status ){
                if( Status === google.maps.places.PlacesServiceStatus.OK ){
                	for( var i = 0; i < Results.length; i++ ){
                        if( jQuery.inArray( Results[i].place_id, PlacesIDs ) == -1 ){
                            Cityestate_VC_Create_Near_Place( Results[i], PointMap, PointType, PointIcon );
                            PlacesIDs.push( Results[i].place_id );
                        }
                    }
                }
            });
            
        }

        // Create near by place
        var Cityestate_VC_Create_Near_Place = function( Place, PointMap, PointType, PointIcon ){
            
            var Marker;
            
            Marker = new google.maps.Marker({
                map: PointMap,
                position: Place.geometry.location,
                icon: PointIcon
            });

            var infowindow = new google.maps.InfoWindow({
                content: Place.name
            });
            
            Marker.addListener('click', function(){
                infowindow.open(vc_near_by_place, Marker);
            });
            
            var Distance = Cityestate_VC_Distance(Place.geometry.location.lat(),Place.geometry.location.lng()); 

            jQuery(".single-property-near-by-list").append("<li> <div class='media'> <div class='media-body'> <h5 class='media-heading'>"+PointType.replace('_', ' ')+"</h5> <p>"+Place.name.substring(0, 40)+"</p> </div> <div class='media-right media-middle'> "+Distance+" " +Distance_Label+" </div> </div> </li>");            
        }

        // Add near place in google map
        var Cityestate_VC_Near_Place = function( PointMap, Center ){
            jQuery.each(Near_By_Place, function( key, value ){
            	if( value.place_type != '' ){
                    Cityestate_VC_Get_Near_Place(Center, PointMap, value.place_type, value.place_image);
                }
            });
        }

        // Calculate distance
        function Cityestate_VC_Distance(latitude2, longitude2) {
	        var lat1 = latitude;
	        var lon1 = longitude;
	        var lat2 = latitude2;
	        var lon2 = longitude2;
	        
	        var radlat1 = Math.PI * lat1/180;
	        var radlat2 = Math.PI * lat2/180;
	        var radlon1 = Math.PI * lon1/180;
	        var radlon2 = Math.PI * lon2/180;
	        var theta = lon1-lon2;
	        var radtheta = Math.PI * theta/180;
	        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	        dist = Math.acos(dist);
	        dist = dist * 180/Math.PI;
	        dist = dist * 60 * 1.1515;

	        dist = dist * 1.609344;
	        
	        return Math.round( dist * 100 )/100;
	    }

        google.maps.event.addDomListener(window, 'load', initialize);
    }

});