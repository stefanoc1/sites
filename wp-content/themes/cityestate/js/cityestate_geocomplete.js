jQuery(document).ready(function($){

    "use strict";

    jQuery(function($){
        // Initialize google map
        jQuery("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form",
            types: ["geocode", "establishment"],        
            markerOptions: {
                draggable: true
            }
        });

        // Auto setup google map lat and lng
        jQuery("#geocomplete").bind("geocode:dragged", function(event, latLng){
            jQuery("input[name=latitude]").val(latLng.lat());
            jQuery("input[name=longitude]").val(latLng.lng());
            jQuery("#reset").show();
        });

        // Reset google map detail
        jQuery("#reset").on("click",function(){
            jQuery("#geocomplete").geocomplete("resetMarker");
            jQuery("#reset").hide();
            return false;
        });

        jQuery("#find").on("click",function(e){
           // Find location
            e.preventDefault();
            jQuery("#geocomplete").trigger("geocode");
        });

        jQuery("#find").trigger("click");
    });
});