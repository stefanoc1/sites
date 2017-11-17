<?php



// Get show field in advance search
$show_hide_field = cityestate_option( 'adv_sea_show_hide_fileds' );

// Get the autocomplete searc hkeyword
$keyword_search = cityestate_option( 'adv_sea_keyword_search' );

$class="";

// Property keyword search type
if( $keyword_search == 'property_title' ){
    // Property search using title
    $keyword_placeholder = esc_html__( 'Enter keyword...', 'cityestate' );
} else if( $keyword_search == 'property_city_state' ) {
    // Property search using city, status or area
    $keyword_placeholder = esc_html__( 'Search City, State or Area', 'cityestate' );
} else {    
    // Property search using address, town, street or zip
    $keyword_placeholder = esc_html__( 'Enter an address, town, street, or zip', 'cityestate' );
}

// Declare variable
$keyword = $type = $status = $location = $bedrooms = $bathrooms = $garages = $min_price = $max_price = $features = '';

// Get property keyword
if( isset( $_GET['keyword'] ) ){
    $keyword = $_GET['keyword'];
}

// get property type
if( isset( $_GET['type'] ) ){
    $type = $_GET['type'];
}

// get property status
if( isset( $_GET['status'] ) ){
    $status = $_GET['status'];
}

// Get property location
if( isset( $_GET['location'] ) ){
    $location = $_GET['location'];
}

// Get property bedroom
if( isset( $_GET['bedrooms'] ) ){
    $bedrooms = $_GET['bedrooms'];
}

// Get property bathroms
if( isset( $_GET['bathrooms'] ) ){
    $bathrooms = $_GET['bathrooms'];
}

// Get property garages
if( isset( $_GET['garages'] ) ){
    $garages = $_GET['garages'];
}

// Get property max price
if( isset( $_GET['max_price'] ) ){
    $max_price = $_GET['max_price'];
}

// Get property features
if( isset( $_GET['features'] ) ){
    $features = $_GET['features'];
} else {
	$features = array();
}

// Show hide field
if( $show_hide_field['keyword'] != 0 && $show_hide_field['type'] != 0 && $show_hide_field['status'] != 0 && $show_hide_field['location'] != 0 && $show_hide_field['bedrooms'] != 0 && $show_hide_field['bathrooms'] != 0 && $show_hide_field['garages'] != 0 && $show_hide_field['price_slider'] != 0 && $show_hide_field['other_features'] != 0 ){
    $hide_advanced = true;
}

// Get search page link
$search_template = cityestate_find_template_url( 'templates/template_search.php' );

?>
<div class="third-header" <?php echo esc_attr( $class ); ?> >
	<div class="container">
		<form class="search-header" method="get" action="<?php echo esc_url( $search_template ); ?>" >
			<!-- Property search using keyword -->
			<?php if( $show_hide_field['keyword'] != 1 ){ ?>
				<input id="keyword" name="keyword" placeholder="<?php echo esc_attr($keyword_placeholder); ?>" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" type="text" class="keyword search-field">
			<?php } 
			// Search property using property type
			if( $show_hide_field['type'] != 1 ){ ?>
				<select name="type" class="search-field selectpicker"><?php
                    echo '<option value="">'.esc_html__( 'All Type', 'cityestate' ).'</option>';
                    $property_type = get_terms( array( "property_type" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                    cityestate_category_values( 'property_type', $property_type, $type ); ?>
				</select>
			<?php } 
			// Search property using status
			if( $show_hide_field['status'] != 1 ){ ?>			
				<select class="search-field selectpicker" name="status"><?php
                    echo '<option value="">'.esc_html__( 'All Status', 'cityestate' ).'</option>';
                    $property_status = get_terms( array( "property_status" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                    cityestate_category_values( 'property_status', $property_status, $status ); ?>
				</select>
			<?php } 
			// Search property using price
			if( $show_hide_field['price_slider'] != 1 ){
				$cityestate_max_price = cityestate_option('adv_sea_max_price'); ?>
				<select name="max_price" class="search-field selectpicker">
					<option value="<?php echo esc_attr($cityestate_max_price); ?>"><?php esc_html_e( 'Budget', 'cityestate' ); ?></option>
					<?php cityestate_min_property_price(); ?>
				</select>				
			<?php } ?>
			<!-- Advance search button -->
			<input type="button" name="advanced" value="<?php esc_html_e( 'Advanced', 'cityestate' ); ?>" class="search-field advance" id="more_filter"/>
			<input type="submit" name="search" value="<?php esc_html_e( 'Search', 'cityestate' ); ?>" class="search-field submit-search"/>
			<div class="search-filter-form" id="more_filter_options">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3"><?php
						// Property search using location
						if( $show_hide_field['location'] != 1 ){ ?>
							<select class="selectpicker" name="location"><?php
		                        echo '<option value="">'.esc_html__( 'All Location', 'cityestate' ).'</option>';
		                        $property_location = get_terms( array( "property_location" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
		                        cityestate_category_values( 'property_location', $property_location, $location ); ?>
							</select><?php
						} ?>
					</div><?php
				// Property search using bedrooms
				if( $show_hide_field['bedrooms'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="bedrooms" title="<?php esc_html_e( 'All Bedrooms', 'cityestate' ); ?>">
							<option value="all"><?php esc_html_e( 'All Bedrooms', 'cityestate' ); ?></option>
							<?php cityestate_search_number_list( 'bedrooms' ); ?>
						</select>
					</div>
					<?php } 
					// Property search using bathrooms
					if( $show_hide_field['bathrooms'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="bathrooms">
							<option value="all"><?php esc_html_e( 'All Bathrooms', 'cityestate' ); ?></option>
							<?php cityestate_search_number_list( 'bathrooms' ); ?>
						</select>
					</div>
					<?php }
					// Property search using garages
					if( $show_hide_field['garages'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-6 col-md-3">							
						<select class="selectpicker" name="garages">
							<option value="all"><?php esc_html_e( 'All Garages', 'cityestate' ); ?></option>
							<?php cityestate_search_number_list( 'garages' ); ?>
						</select>
					</div><?php 
				} ?>
				<!-- Property search using other features -->
				<?php if( $show_hide_field['other_features'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-12 col-md-12 option">
						<label><strong><?php esc_html_e( 'Advance Features', 'cityestate' ); ?></strong></label>
					</div><?php
                    if( taxonomy_exists('property_feature') ){
                    	// Property search featured
                    	$property_features = get_terms( array( "property_feature" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                        if( !empty($property_features) ){
                        	foreach( $property_features as $feature ): ?>
                                <div class="col-xs-12 col-sm-4 col-md-2 option">
									<input id="features-<?php echo esc_attr( $feature->slug ); ?>" name="features[]" value="<?php echo esc_attr( $feature->slug ); ?>" type="checkbox" <?php if( isset( $features ) && in_array( $feature->slug, $features ) == 'yes' ){ echo esc_attr("checked"); } ?> >
									<label for="features-<?php echo esc_attr( $feature->slug ); ?>"><?php printf( esc_html__( '%s', 'cityestate' ), $feature->name ); ?></label>
								</div><?php                                            
                            endforeach;
                        }
                    }
				} ?>
				</div>
			</div>
		</form>
	</div>
</div>