<?php

// Get show field in advance search
$show_hide_field = cityestate_option( 'adv_sea_show_hide_fileds' );

// Get the autocomplete searc hkeyword
$keyword_search = cityestate_option( 'adv_sea_keyword_search' );

// Property keyword search type
if( $keyword_search == 'property_title' ){        
    // Property search using title
    $search_placeholder = esc_html__( 'Enter keyword...', 'cityestate' );
} else if( $keyword_search == 'property_city_state' ){
    // Property search using city, status or area
    $search_placeholder = esc_html__( 'Search City, State or Area', 'cityestate' );
} else {    
    // Property search using address, town, street or zip
    $search_placeholder = esc_html__( 'Enter an address, town, street, or zip', 'cityestate' );
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

// Advance search icon
$active_form 	= 'style="display:none;"';
$icon_class 	= 'glyphicon-triangle-top';

// Show hide field
$hide_advanced = false;
if( $show_hide_field['keyword'] != 0 && $show_hide_field['type'] != 0 && $show_hide_field['status'] != 0 && $show_hide_field['location'] != 0 && $show_hide_field['bedrooms'] != 0 && $show_hide_field['bathrooms'] != 0 && $show_hide_field['garages'] != 0 && $show_hide_field['price_slider'] != 0 && $show_hide_field['other_features'] != 0 ){
    $hide_advanced = true;
}

// Get search page link
$search_template = cityestate_find_template_url( 'templates/template_search.php' );

// Advance search under menu
$search_over_header = cityestate_option( 'show_advance_search_on_header' );

if( $search_over_header != 0 ){ ?>

<div class="searchfilter">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<span id="search_label" class="search_label">
					<?php esc_html_e( 'Find Your Dream Home', 'cityestate' ); ?>
					<i class="glyphicon <?php echo esc_attr($icon_class); ?>"> </i>
				</span>
			</div>
		</div>
	</div>
	<form class="search-filter-form" method="get" action="<?php echo esc_url( $search_template ); ?>" name="property-filter" id="search_label_options" <?php echo esc_attr($active_form); ?> >
		<div class="container">
			<div class="search-filter-form">
				<div class="row">
					<!-- Property search using keyword -->
					<?php if( $show_hide_field['keyword'] != 1 ){ ?>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<input id="keyword" name="keyword" placeholder="<?php echo esc_attr($search_placeholder); ?>" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" type="text">
						</div>
					<?php } 
					// Search property using property type
					if( $show_hide_field['type'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="type"><?php
                            echo '<option value="">'.esc_html__( 'All Type', 'cityestate' ).'</option>';
                            $property_type = get_terms( array( "property_type" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                            cityestate_category_values( 'property_type', $property_type, $type ); ?>
						</select>
					</div>
					<?php } 
					// Search property using status
					if( $show_hide_field['status'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="status"><?php
                            echo '<option value="">'.esc_html__( 'All Status', 'cityestate' ).'</option>';
                            $property_status = get_terms( array( "property_status" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                            cityestate_category_values( 'property_status', $property_status, $status ); ?>
						</select>							
					</div>
					<?php } 
					// Search property using location
					if( $show_hide_field['location'] != 1 ){ ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="location"><?php
                            echo '<option value="">'.esc_html__( 'All Location', 'cityestate' ).'</option>';
                            $property_location = get_terms( array( "property_location" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                            cityestate_category_values( 'property_location', $property_location, $location ); ?>
						</select>							
					</div>
					<?php }
					// Property search using bedrooms
					if( $show_hide_field['bedrooms'] != 1 ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="bedrooms" title="<?php esc_html_e( 'All Bedrooms', 'cityestate' ); ?>">
							<option value="all"><?php esc_html_e( 'All Bedrooms', 'cityestate' ); ?></option>
							<?php cityestate_search_number_list( 'bedrooms' ); ?>
						</select>
					</div>
					<?php } 
					// Property search using bathrooms
					if( $show_hide_field['bathrooms'] != 1 ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<select class="selectpicker" name="bathrooms">
							<option value="all"><?php esc_html_e( 'All Bathrooms', 'cityestate' ); ?></option>
							<?php cityestate_search_number_list( 'bathrooms' ); ?>
						</select>
					</div>
					<?php }
					// Property search using garages
					if( $show_hide_field['garages'] != 1 ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">							
						<select class="selectpicker" name="garages">
							<option value="all"><?php esc_html_e( 'All Garages', 'cityestate' ); ?></option>
							<?php cityestate_search_number_list( 'garages' ); ?>
						</select>
					</div>
					<?php }
					// Property search price
					if( $show_hide_field['price_slider'] != 1 ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div id="property-price-range" class="property-price-range"></div>
						<input type="text" id="amount" class="amount" name="price" readonly="readonly">
						<input type="hidden" id="min_price" class="min_price" name="min_price" value="<?php echo isset ( $_GET['min_price'] ) ? $_GET['min_price'] : ''; ?>">
						<input type="hidden" id="max_price" class="max_price" name="max_price" value="<?php echo isset ( $_GET['max_price'] ) ? $_GET['max_price'] : ''; ?>">
					</div>
					<?php } ?>
				</div>
				<?php if( $show_hide_field['other_features'] != 1 ) { ?>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3">
						<button class="submit-filter"><?php esc_html_e( 'Search Now', 'cityestate' ); ?></button>
					</div>
					<!-- Property search using other features -->
					<div class="col-xs-12 col-sm-3 col-md-2 pull-right">
						<span id="advance_more_filter" class="more_filter pull-right">
							<?php esc_html_e( 'More Filters', 'cityestate' ); ?>
							<i class="glyphicon glyphicon-triangle-bottom"> </i>
						</span>
					</div>
					<!-- Property search using other features -->
					<div id="advance_more_filter_options" class="col-xs-12 col-sm-12 col-md-12">
						<div class="row"><?php
                            if( taxonomy_exists('property_feature') ){
                                // Property search featured
                                $property_features = get_terms( array( "property_feature" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                                if( !empty($property_features) ){                                    	
                                    foreach( $property_features as $feature ): ?>                                        
                                        <div class="col-xs-12 col-sm-4 col-md-3 option">
											<input id="features-<?php echo esc_attr( $feature->slug ); ?>" name="features[]" value="<?php echo esc_attr( $feature->slug ); ?>" type="checkbox" <?php if( isset( $features ) && in_array( $feature->slug, $features ) == 'yes' ){ echo esc_attr("checked"); } ?> >
											<label for="features-<?php echo esc_attr( $feature->slug ); ?>"><?php printf( esc_html__( '%s', 'cityestate'), $feature->name ); ?></label>
										</div><?php                                            
                                    endforeach;
                                }
                            } ?>								
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</form>
</div><?php
} ?>