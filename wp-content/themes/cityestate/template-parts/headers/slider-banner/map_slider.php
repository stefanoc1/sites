<!-- Header with map -->
<div class="cityestate-header-media">
    <div id="cityestate-gmap-main">
        <div id="cityestate_listing_map"></div>
        <!-- Declare map loader -->
        <div id="cityestate_map_loading">
            <div class="mapPlaceholder">
                <div class="loader-ripple">
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <!-- Google map zoom in and our -->
        <div class="map-arrows-actions">
            <button id="google_map_zoom_in" class="map-btn"><i class="fa fa-plus"></i> </button>
            <button id="google_map_zoom_out" class="map-btn"><i class="fa fa-minus"></i></button>            
        </div>
        <!-- Google map change map type -->
        <div class="map-next-prev-actions">
            <ul class="dropdown-menu" aria-labelledby="cityestate-gmap-view">
                <li><a href="#" class="google_map_type" data-maptype="roadmap"><span><?php esc_html_e( 'Roadmap', 'cityestate' ); ?></span></a></li>
                <li><a href="#" class="google_map_type" data-maptype="satellite"><span><?php esc_html_e( 'Satelite', 'cityestate' ); ?></span></a></li>
                <li><a href="#" class="google_map_type" data-maptype="hybrid"><span><?php esc_html_e( 'Hybrid', 'cityestate' ); ?></span></a></li>
                <li><a href="#" class="google_map_type" data-maptype="terrain"><span><?php esc_html_e( 'Terrain', 'cityestate' ); ?></span></a></li>
            </ul>
            <button id="cityestate-gmap-view" class="map-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-globe"></i> <span><?php esc_html_e( 'View', 'cityestate' ); ?></span></button>
            <!-- Previous property button -->
            <button id="google_map_preview_property" class="map-btn"><i class="fa fa-chevron-left"></i> <span><?php esc_html_e('Prev', 'cityestate'); ?></span></button>
            <!-- Next property button -->
            <button id="google_map_next_property" class="map-btn"><span><?php esc_html_e('Next', 'cityestate'); ?></span> <i class="fa fa-chevron-right"></i></button>
        </div>
        <!-- Google map action -->
        <div class="map-zoom-actions"></div>
    </div>

</div>