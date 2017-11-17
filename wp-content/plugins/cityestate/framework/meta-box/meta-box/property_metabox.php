<?php

// List the agents which is register in agent post type
function cityestate_list_agent(){
    // Set none value of select box
    $agents_list = array( -1 => esc_html__( 'None', 'cityestate' ) );
    $agents_info = get_posts( array( 'post_type' => 'cityestate_agent', 'posts_per_page' => -1, 'suppress_filters' => 0 ) );
    // Check agent is available
    if( !empty($agents_info) ){
        foreach( $agents_info as $about_agent ){
            $agents_list[$about_agent->ID] = $about_agent->post_title;
        }
    }
    return $agents_list;
}

// Property metabox
$meta_boxes[] = array(

    'id' 	=> 'property-meta-box',    
    'title' => esc_html__( 'Property Information', 'cityestate' ),    
    'pages' => array( 'property' ),    
    'tabs' 	=> array(

        'property_basic_detail'	=> array(
            'label' => esc_html__( 'Basic Information', 'cityestate' ),
            'icon' 	=> 'dashicons-admin-home',
		),

        'property_map' => array(
        	'label' => esc_html__( 'Map', 'cityestate' ),
        	'icon' 	=> 'dashicons-location',
    	),

        'property_amenities' => array(
            'label' => esc_html__( 'Amenities', 'cityestate' ),
            'icon' 	=> 'dashicons-list-view',
        ),

        'property_info' => array(
            'label' => esc_html__( 'Essential Information', 'cityestate' ),
            'icon'  => 'dashicons-menu',
        ),

        'property_gallery' => array(
    		'label' => esc_html__( 'Gallery Images', 'cityestate' ),
    		'icon' 	=> 'dashicons-format-gallery',
		),

        'property_home_slider' => array(
            'label' => esc_html__( 'Property Slider', 'cityestate' ),
            'icon'  => 'dashicons-images-alt',
        ),

        'property_agent' => array(
            'label' => esc_html__( 'Agent Information', 'cityestate' ),
            'icon'  => 'dashicons-businessman',
        ),

        'property_floor_goods' => array(
            'label' => esc_html__( 'Flooring & Goods', 'cityestate' ),
            'icon'  => 'dashicons-admin-links',
        ),

        'property_interior_exterior' => array(
            'label' => esc_html__( 'Interior & Exterior', 'cityestate' ),
            'icon'  => 'dashicons-admin-generic',
        ),

        'property_room_dimensions' => array(
            'label' => esc_html__( 'Room Dimensions', 'cityestate' ),
            'icon'  => 'dashicons-screenoptions',
        ),

        'property_floor_plans' => array(
            'label' => esc_html__( 'Floor Plans', 'cityestate' ),
            'icon'  => 'dashicons-layout',
        ),

        'property_document' => array(
            'label' => esc_html__( 'Documents', 'cityestate' ),
            'icon'  => 'dashicons-book',
        ),

        'property_video' => array(
            'label' => esc_html__( 'Property Video', 'cityestate' ),
            'icon' 	=> 'dashicons-format-video',
        ),

        'property_near_by_place' => array(
            'label' => esc_html__( 'Near By Place', 'cityestate' ),
            'icon'  => 'dashicons-admin-generic',
        ),
    ),
    'tab_style' => 'left',
    'fields' 	=> array(

        // Property basic detail tab
        array(
            'id' 		=> 'property_price',
            'name' 		=> esc_html__( 'Price for Sale or Rent ( Only digits )', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 259900', 'cityestate' ),
            'type' 		=> 'text',
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'name' 		=> esc_html__( 'Want to mark this property as featured ?', 'cityestate' ),
            'id' 		=> 'featured',
            'type' 		=> 'radio',
            'std' 		=> 0,
            'options' 	=> array(
				                1 => esc_html__( 'Yes ', 'cityestate' ),
				                0 => esc_html__( 'No', 'cityestate' )
				            ),
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_second_price',
            'name' 		=> esc_html__( 'Descriptive Price ( Display optional Price for Rental or Square Feet )', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 1100', 'cityestate' ),
            'type' 		=> 'text',
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_price_postfix',
            'name' 		=> esc_html__( 'Price Label To Display After Descriptive Price', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: Per Month', 'cityestate' ),
            'type' 		=> 'text',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_size',
            'name' 		=> esc_html__( 'Area Size ( Only digits )', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 2150', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_size_prefix',
            'name' 		=> esc_html__( 'Size Prefix', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: Sq Ft', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_bedrooms',
            'name' 		=> esc_html__( 'Number Of Bedrooms', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 5', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_bathrooms',
            'name' 		=> esc_html__( 'Number Of Bathrooms', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 4', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_garages',
            'name' 		=> esc_html__( 'Number Of Garages', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 2', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_year',
            'name' 		=> esc_html__( 'Year Of Built', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex: 2016', 'cityestate' ),
            'type' 		=> 'date',
            'std' 		=> '',
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id' 		=> 'property_id',
            'name' 		=> esc_html__( 'Property ID', 'cityestate' ),
            'desc' 		=> esc_html__( 'Ex. C1011153.', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',            
            'columns' 	=> 6,
            'tab' 		=> 'property_basic_detail',
        ),

        array(
            'id'        => 'property_zip',
            'name'      => esc_html__( 'Zip Code', 'cityestate' ),
            'type'      => 'text',
            'columns'   => 6,
            'tab'       => 'property_basic_detail',
        ),

        array(
            'id'        => 'property_address',
            'name'      => esc_html__( 'Address (*only street name and building no)', 'cityestate' ),
            'class'     => 'property-address',
            'type'      => 'textarea',
            'columns'   => 12,
            'tab'       => 'property_basic_detail',
        ),

        // Property map tab
        array(
            'id' 		=> 'property_map_address',
            'name' 		=> esc_html__( 'Property Address', 'cityestate' ),
            'desc' 		=> esc_html__( 'Leave it empty if you want to hide map on property detail page.', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '',
            'columns' 	=> 12,
            'tab' 		=> 'property_map',
        ),

        array(
            'id' 			=> 'property_location',
            'name' 			=> esc_html__( 'Property Location at Google Map*', 'cityestate' ),
            'desc' 			=> esc_html__( 'Drag the google map marker to point your property location. You can also use the address field above to search for your property.', 'cityestate' ),
            'type' 			=> 'map',
            'std' 			=> '25.686540,-80.431345,15',
            'style' 		=> 'width: 95%; height: 400px',
            'address_field' => 'property_map_address',
            'columns' 		=> 12,
            'tab' 			=> 'property_map',
        ),

        array(
            'name' 		=> esc_html__( 'Google Map Street View', 'cityestate' ),
            'id' 		=> 'property_street_view',
            'type' 		=> 'select',
            'std' 		=> 'hide',
            'options' 	=> array(
				                'hide' => esc_html__( 'Hide', 'cityestate' ),
				                'show' => esc_html__( 'Show ', 'cityestate' )
				            ),
            'columns' 	=> 12,
            'tab' 		=> 'property_map',
        ),

        // Property amenities tab
        array(
            
            'id'            => 'propertyamenities',            
            'type'          => 'group',            
            'clone'         => true,            
            'sort_clone'    => true,            
            'tab'           => 'property_amenities',            
            'fields'        => array(
                                   
                array(
                    'name'      => esc_html__( 'Amenitiy', 'cityestate' ),
                    'id'        => 'amenities_value',
                    'type'      => 'text',
                    'columns'   => 12,
                ),

            ),
        ),

        // Property enssestial information tab
        array(
            
            'id'            => 'property_info',            
            'type'          => 'group',            
            'clone'         => true,            
            'sort_clone'    => true,            
            'tab'           => 'property_info',            
            'fields'        => array(
                                   
                array(
                    'name'      => esc_html__( 'Label', 'cityestate' ),
                    'id'        => 'property_info_label',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Value', 'cityestate' ),
                    'id'        => 'property_info_value',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

            ),
        ),

        // Property gallery tab
        array(
            'name'              => esc_html__( 'Property Gallery Images', 'cityestate' ),
            'id'                => 'property_images',
            'desc'              => esc_html__( 'Recommend image size 1170 x 738', 'cityestate' ),
            'type'              => 'image_advanced',
            'max_file_uploads'  => 40,
            'columns'           => 12,
            'tab'               => 'property_gallery',
        ),

        // Property homepage slider tab
        array(
            'name'      => esc_html__( 'Do you want to add this property in property slider?', 'cityestate' ),
            'id'        => 'homeslide',
            'desc'      => esc_html__( 'If yes, then provide slider image below.', 'cityestate' ),
            'type'      => 'radio',
            'options'   => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__ ('No', 'cityestate' ),
                            ),
            'columns'   => 12,
            'tab'       => 'property_home_slider',
        ),

        array(
            'name'              => esc_html__( 'Slider Image', 'cityestate' ),
            'id'                => 'slider_image',
            'desc'              => esc_html__( 'The recommended image size in 2000 x 700. You can use bigger and smaller image but keep same height to width ratio. Use same size images for all properties which you want to add in slider', 'cityestate' ),
            'type'              => 'image_advanced',
            'max_file_uploads'  => 1,
            'columns'           => 12,
            'tab'               => 'property_home_slider',
        ),

        // Property agent tab
        array(
            'name'      => esc_html__( 'What to display in agent information box ?', 'cityestate' ),
            'id'        => 'property_agent_display',
            'type'      => 'radio',
            'std'       => 'author_info',
            'options'   => array(
                                'author_info'   => esc_html__( 'Author information.', 'cityestate' ),
                                'agent_info'    => esc_html__( 'Agent Information. ( Select the agent below )', 'cityestate' ),
                                'none'          => esc_html__( 'Hide information box', 'cityestate' ),
                            ),
            'columns'   => 12,
            'tab'       => 'property_agent',
        ),

        array(
            'name'      => esc_html__( 'Agent Responsible', 'cityestate' ),
            'id'        => 'agents',
            'type'      => 'select',
            'options'   => cityestate_list_agent(),
            'columns'   => 12,
            'tab'       => 'property_agent',
        ),

         array(
            'name'      => esc_html__( 'Agent Responsible2', 'cityestate' ),
            'id'        => 'agents2',
            'type'      => 'post',
            'post_type'   => 'cityestate_agent',
            // Field type, either 'select' or 'select_advanced' (default)
            'field_type'  => 'select',
            'columns'   => 12,
            'tab'       => 'property_agent',
        ),


        // Property flooring and goods included tab
        array(
            'name'      => esc_html__( 'Flooring Description', 'cityestate' ),
            'id'        => 'flooring_detail',
            'type'      => 'textarea',
            'columns'   => 12,
            'tab'       => 'property_floor_goods',
        ),

        array(
            'name'      => esc_html__( 'Goods Included Description', 'cityestate' ),
            'id'        => 'goods_detail',
            'type'      => 'textarea',
            'columns'   => 12,
            'tab'       => 'property_floor_goods',
        ),

        // Property interior and exterior tab
        array(
            
            'id'            => 'interior_exterior',            
            'type'          => 'group',            
            'clone'         => true,            
            'sort_clone'    => true,            
            'tab'           => 'property_interior_exterior',            
            'fields'        => array(
                                   
                array(
                    'name'      => esc_html__( 'Label', 'cityestate' ),
                    'id'        => 'interior_label',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Value', 'cityestate' ),
                    'id'        => 'interior_value',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

            ),
        ),

        // Property room dimensions tab
        array(
            
            'id'            => 'room_dimensions',            
            'type'          => 'group',            
            'clone'         => true,            
            'sort_clone'    => true,            
            'tab'           => 'property_room_dimensions',            
            'fields'        => array(
                                   
                array(
                    'name'      => esc_html__( 'Label', 'cityestate' ),
                    'id'        => 'rom_dime_label',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Value', 'cityestate' ),
                    'id'        => 'rom_dime_value',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

            ),
        ),

        // Property floor plan tab
        array(
            'id'            => 'floor_plans',
            'type'          => 'group',
            'clone'         => true,
            'sort_clone'    => true,
            'tab'           => 'property_floor_plans',
            'fields'        => array(

                array(
                    'name'      => esc_html__( 'Floor Plan Title', 'cityestate' ),
                    'id'        => 'floor_plan_title',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Floor Plan Image', 'cityestate' ),
                    'id'        => 'floor_plan_image',
                    'type'      => 'file_input',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Floor Plan Size', 'cityestate' ),
                    'id'        => 'floor_plan_size',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Floor Plan Bebrooms', 'cityestate' ),
                    'id'        => 'floor_plan_room',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Floor Plan Bathrooms', 'cityestate' ),
                    'id'        => 'floor_plan_bathroom',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'name'      => esc_html__( 'Floor Plan Price', 'cityestate' ),
                    'id'        => 'floor_plan_price',
                    'type'      => 'text',
                    'columns'   => 6,
                ),                

                array(
                    'name'      => esc_html__( 'Floor Plan Description', 'cityestate' ),
                    'id'        => 'floor_plan_info',
                    'type'      => 'textarea',
                    'columns'   => 12,
                ),

            ),
        ),

        // Property documents tab
        array(
            'id'            => 'property_document',
            'type'          => 'group',
            'clone'         => true,
            'sort_clone'    => true,
            'tab'           => 'property_document',
            'desc'          => esc_html__( 'You can attach PDF files, Map images OR other documents to provide further details related to property.', 'cityestate' ),
            'fields'        => array(

                array(
                    'name'      => esc_html__( 'Document Title', 'cityestate' ),
                    'id'        => 'document_title',
                    'type'      => 'text',
                    'columns'   => 6,
                ),

                array(
                    'id'                => 'document_attachment',
                    'name'              => esc_html__( 'Attachments', 'cityestate' ),                    
                    'type'              => 'file_input',
                    'columns'           => 6,                    
                )

            ),
        ),
    
        // Property video tab
        array(
            'id'        => 'property_video_url',
            'name'      => esc_html__( 'Video URL', 'cityestate' ),
            'desc'      => esc_html__( 'Provide virtual tour video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'cityestate' ),
            'type'      => 'text',
            'columns'   => 12,
            'tab'       => 'property_video',
        ),

        array(
            'name'      => esc_html__('Video Image', 'cityestate' ),
            'id'        => 'property_video_image',
            'desc'      => esc_html__( 'Provide an image that will be displayed as a place holder and when user will click over it the video will be opened in a lightbox. You must provide this image otherwise the video will not be displayed. Image should have minimum width of 818px and minimum height 417px. Bigger size images will be cropped automatically.', 'cityestate' ),
            'type'      => 'file_input',            
            'columns'   => 12,
            'tab'       => 'property_video',
        ),

        // Property near by place tab
        array(
            
            'id'            => 'near_by_place',
            'type'          => 'group',            
            'clone'         => true,            
            'sort_clone'    => true,            
            'tab'           => 'property_near_by_place',            
            'fields'        => array(
                                   
                array(
                    'name'      => esc_html__( 'Place Type', 'cityestate' ),
                    'id'        => 'place_type',
                    'type'      => 'select',
                    'std'       => 'hide',
                    'options'   => cityestate_google_places(),
                    'columns'   => 6,                    
                ),

                array(
                    'name'      => esc_html__( 'Place Icon', 'cityestate' ),
                    'id'        => 'place_image',
                    'type'      => 'file_input',
                    'columns'   => 6,
                ),
            ),
        ),
    ),
);

// Return google near by place
function cityestate_google_places(){
    return array( "" => "Select", "accounting" => "Accounting", "airport" => "Airport", "amusement_park" => "Amusement Park", "aquarium" => "Aquarium", "art_gallery" => "Art Gallery", "atm" => "ATM", "bakery" => "Bakery", "bank" => "Bank", "bar" => "Bar", "beauty_salon" => "Beauty Salon", "bicycle_store" => "Bicycle Store", "book_store" => "Book Store", "bowling_alley" => "Bowling Alley", "bus_station" => "Bus Station", "cafe" => "Cafe", "campground" => "Campground", "car_dealer" => "Car Dealer", "car_rental" => "Car Rental", "car_repair" => "Car Repair", "car_wash" => "Car Wash", "casino" => "Casino", "cemetery" => "Cemetery", "church" => "Church", "city_hall" => "City Hall", "clothing_store" => "Clothing Store", "convenience_store" => "Convenience Store", "courthouse" => "Courthouse", "dentist" => "Dentist", "department_store" => "Department Store", "doctor" => "Doctor", "electrician" => "Electrician", "electronics_store" => "Electronics Store", "embassy" => "Embassy", "establishment" => "Establishment", "finance" => "Finance", "fire_station" => "Fire Station", "florist" => "Florist", "food" => "Food", "funeral_home" => "Funeral Home", "furniture_store" => "Furniture Store", "gas_station" => "Gas Station", "general_contractor" => "General Contractor", "grocery_or_supermarket" => "Grocery or Supermarket", "gym" => "Gym", "hair_care" => "Hair Care", "hardware_store" => "Hardware Store", "health" => "Health", "hindu_temple" => "Hindu Temple", "home_goods_store" => "Home Goods Store", "hospital" => "Hospital", "insurance_agency" => "Insurance Agency", "jewelry_store" => "Jewelry Store", "laundry" => "Laundry", "lawyer" => "Lawyer", "library" => "Library", "liquor_store" => "Liquor Store", "local_government_office" => "Local Government Office", "locksmith" => "Locksmith", "lodging" => "Lodging", "meal_delivery" => "Meal Delivery", "meal_takeaway" => "Meal Takeaway", "mosque" => "Mosque", "movie_rental" => "Movie Rental", "movie_theater" => "Movie Theater", "moving_company" => "Moving Company", "museum" => "Museum", "night_club" => "Night Club", "painter" => "Painter", "park" => "Park", "parking" => "Parking", "pet_store" => "Pet Store", "pharmacy" => "Pharmacy", "physiotherapist" => "Physiotherapist", "place_of_worship" => "Place Of Worship", "plumber" => "Plumber", "police" => "Police", "post_office" => "Post Office", "real_estate_agency" => "Real Estate Agency", "restaurant" => "Restaurant", "roofing_contractor" => "Roofing Contractor", "rv_park" => "RV Park", "school" => "School", "shoe_store" => "Shoe Store", "shopping_mall" => "Shopping Mall", "spa" => "Spa", "stadium" => "Stadium", "storage" => "Storage", "store" => "Store", "subway_station" => "Subway Station", "synagogue" => "Synagogue", "taxi_stand" => "Taxi Stand", "train_station" => "Train Station", "travel_agency" => "Travel Agency", "university" => "University", "veterinary_care" => "Veterinary Care", "zoo" => "Zoo" );
}

// Load property payment custom post metabox
add_action( 'load-post.php', 'cityestate_payment_status_metabox' );
add_action( 'load-post-new.php', 'cityestate_payment_status_metabox' );

// Add or show property payment metabox
if( !function_exists( 'cityestate_payment_status_metabox' ) ){

    function cityestate_payment_status_metabox(){
        global $typenow;
        // Get submission type
        $submission_type = cityestate_option( 'submit_property_type' );
        // Add or show property payment sidebar
        if( $typenow == 'property' && $submission_type == 'per_listing' ){
            add_action( 'add_meta_boxes', 'cityestate_property_metaboxes' );
            add_action( 'save_post', 'cityestate_save_property_metaboxes', 10, 2 );
        }
    }
}

// Add property payment metabox
if( !function_exists( 'cityestate_property_metaboxes' ) ){    
    function cityestate_property_metaboxes() {
        add_meta_box( 'cityestate_paid_submission', esc_html__( 'Paid Submission', 'cityestate' ), 'cityestate_paid_submission', 'property', 'side', 'high' );
    }
}

// Show property payment metabox
if( !function_exists('cityestate_paid_submission') ){

    function cityestate_paid_submission( $property, $metabox ){

        // Get property payment detail like payment status
        $submission_type = cityestate_option( 'submit_property_type' );         
        $payment_status  = get_post_meta( $property->ID, 'payment_status', true );

        // Check property submisiion is free or paid
        if( $submission_type == 'no' ){
            esc_html_e( 'Paid Submission is disabled', 'cityestate' );
        }
        // Payment status label
        esc_html_e( 'Payment Status: ', 'cityestate' );
        
        // Show property payment status
        if( $payment_status == 'paid' ){
            echo '<span class="status_done">'.esc_html__( 'Paid', 'cityestate' ).'</span>';
        } else {
            echo '<span class="status_not_dont">'.esc_html__( 'Not Paid', 'cityestate' ).'</span>';
        } ?>

        <!-- Admin can change the payment status of property -->
        <div class="property_payment_box">
            <p><?php esc_html_e( 'Change Status:', 'cityestate' ); ?></p>
            <select name="property_payment[payment_status]">
                <option value="paid" <?php selected( $payment_status, 'paid' ); ?> ><?php esc_html_e( 'Paid', 'cityestate' ); ?></option>
                <option value="not_paid" <?php selected( $payment_status, 'not_paid' ); ?> ><?php esc_html_e( 'Not Paid', 'cityestate' ); ?></option>
            </select>
        </div><?php
    }
}

// Save property metabox
if( !function_exists( 'cityestate_save_property_metaboxes' ) ){    
    function cityestate_save_property_metaboxes( $property_id, $property ){
        // Return if have auto save mode
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return;
        }
        // Save property metabox
        if( isset( $_POST['property_payment'] ) ){
            // Save property payment metabox
            $payment_status = isset( $_POST['property_payment']['payment_status'] ) ? $_POST['property_payment']['payment_status'] : '';
            update_post_meta( $property_id, 'payment_status', $payment_status );
        }
    }
}

?>