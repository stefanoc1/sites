<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Near By Place', 'cityestate' ),
		'base' 		=> 'near_by_place',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'near_by_place',
		'params' 	=> array(
			
			array(
				'heading' 		=> esc_html__( 'Latitude', 'cityestate' ),
				'description' 	=> wp_kses( __( 'This option is not necessary if an address is set.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'latitude',
				'type' 			=> 'textfield',
			),

			array(
				'heading' 		=> esc_html__( 'Longitude', 'cityestate' ),
				'description' 	=> wp_kses( __( 'This option is not necessary if an address is set.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'longitude',
				'type' 			=> 'textfield',
			),

			array(
				'heading' 		=> esc_html__( 'Zoom', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Default map zoom level. (1-19)<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'zoom',
				'std' 			=> '17',
				'type' 			=> 'textfield'
			),

			array(
				'heading' 		=> esc_html__( 'Scrollwheel', 'cityestate' ),
				'param_name' 	=> 'scrollwheel',
				'description' 	=> '<br/>',
				'value' 		=> array( esc_html__( 'Enable', 'cityestate' ) => 'enable' ),
				'type' 			=> 'checkbox'
			),

			array(
				'heading' 		=> esc_html__( 'Marker', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Enable an arrow pointing at the address.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'marker',
				'value' 		=> array( esc_html__( 'Enable', 'cityestate' ) => 'enable' ),
				'type' 			=> 'checkbox',
				'std' 			=> 'enable',
			),

			array(
				'param_name' 	=> 'marker_image',
				'type' 			=> 'attach_image',
				'heading' 		=> esc_html__( 'Marker Image/Icon', 'cityestate')  ,
				'description' 	=> esc_html__( 'Select the custom google map marker image or icon ', 'cityestate' )  ,
				'save_always' 	=> true
			),

			array(
				'heading' 		=> esc_html__( 'Popup Marker Content', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Content to be shown in a popup above the marker.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'info_content',
				'type' 			=> 'textarea',
			),

			array(
				'heading' 		=> esc_html__( 'Width (optional)', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Default is 100%.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'width',
				'std' 			=> '100%',
				'type' 			=> 'textfield'
			),
			
			array(
				'heading' 		=> esc_html__( 'Height', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Default is 500px.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'height',
				'std' 			=> '500px',
				'type' 			=> 'textfield'				
			),

			array(
				'heading'		=> esc_html__( 'Near By Place', 'cityestate' ),
				'type'			=> 'param_group',
				'param_name'	=> 'near_by_places',
				'group' 		=> 'Near By Place',
				'params' 		=> array(
					
					array(
						'param_name' 	=> 'place_type',
						'type' 			=> 'dropdown',
						'value' 		=> array( 'Select' => '', 'Accounting' => 'accounting', 'Airport' => 'airport', 'Amusement Park' => 'amusement_park',  'Aquarium' => 'aquarium', 'Art Gallery' => 'art_gallery',  'ATM' => 'atm', 'Bakery' => 'bakery', 'Bank' => 'bank', 'Bar' => 'bar', 'Beauty Salon' => 'beauty_salon',  'Bicycle Store' => 'bicycle_store',  'Book Store' => 'book_store',  'Bowling Alley' => 'bowling_alley',  'Bus Station' => 'bus_station',  'Cafe' => 'cafe', 'Campground' => 'campground', 'Car Dealer' => 'car_dealer',  'Car Rental' => 'car_rental',  'Car Repair' => 'car_repair',  'Car Wash' => 'car_wash',  'Casino' => 'casino', 'Cemetery' => 'cemetery', 'Church' => 'church', 'City Hall' => 'city_hall',  'Clothing Store' => 'clothing_store',  'Convenience Store' => 'convenience_store',  'Courthouse' => 'courthouse', 'Dentist' => 'dentist', 'Department Store' => 'department_store',  'Doctor' => 'doctor', 'Electrician' => 'electrician', 'Electronics Store' => 'electronics_store',  'Embassy' => 'embassy', 'Establishment' => 'establishment', 'Finance' => 'finance', 'Fire Station' => 'fire_station',  'Florist' => 'florist', 'Food' => 'food', 'Funeral Home' => 'funeral_home',  'Furniture Store' => 'furniture_store',  'Gas Station' => 'gas_station',  'General Contractor' => 'general_contractor',  'Grocery or Supermarket' => 'grocery_or_supermarket',  'Gym' => 'gym', 'Hair Care' => 'hair_care',  'Hardware Store' => 'hardware_store',  'Health' => 'health', 'Hindu Temple' => 'hindu_temple',  'Home Goods Store' => 'home_goods_store',  'Hospital' => 'hospital', 'Insurance Agency' => 'insurance_agency',  'Jewelry Store' => 'jewelry_store',  'Laundry' => 'laundry', 'Lawyer' => 'lawyer', 'Library' => 'library', 'Liquor Store' => 'liquor_store',  'Local Government Office' => 'local_government_office',  'Locksmith' => 'locksmith', 'Lodging' => 'lodging', 'Meal Delivery' => 'meal_delivery',  'Meal Takeaway' => 'meal_takeaway',  'Mosque' => 'mosque', 'Movie Rental' => 'movie_rental',  'Movie Theater' => 'movie_theater',  'Moving Company' => 'moving_company',  'Museum' => 'museum', 'Night Club' => 'night_club',  'Painter' => 'painter', 'Park' => 'park', 'Parking' => 'parking', 'Pet Store' => 'pet_store',  'Pharmacy' => 'pharmacy', 'Physiotherapist' => 'physiotherapist', 'Place Of Worship' => 'place_of_worship',  'Plumber' => 'plumber', 'Police' => 'police', 'Post Office' => 'post_office',  'Real Estate Agency' => 'real_estate_agency',  'Restaurant' => 'restaurant', 'Roofing Contractor' => 'roofing_contractor',  'RV Park' => 'rv_park',  'School' => 'school', 'Shoe Store' => 'shoe_store',  'Shopping Mall' => 'shopping_mall',  'Spa' => 'spa', 'Stadium' => 'stadium', 'Storage' => 'storage', 'Store' => 'store', 'Subway Station' => 'subway_station',  'Synagogue' => 'synagogue', 'Taxi Stand' => 'taxi_stand',  'Train Station' => 'train_station',  'Travel Agency' => 'travel_agency',  'University' => 'university', 'Veterinary Care' => 'veterinary_care',  'Zoo' => 'zoo' ),
						'heading' 		=> esc_html__( 'Near By Place Type:', 'cityestate' ),
						'save_always' 	=> true,
					),

					array(
					   'type' 			=> 'attach_image',
					   'heading' 		=> esc_html__( 'Map Marker', 'cityestate' ),
					   'param_name' 	=> 'place_marker_icon',
					   'description' 	=> esc_html__( 'Map Marker Image.', 'cityestate' ),
					),
										
				),
			),				
		)
	)
);

?>