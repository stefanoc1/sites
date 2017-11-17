<?php

// Set CityEstate theme labels

if( !function_exists('cityestate_get_labels') ){
	
	function cityestate_get_labels(){

		$theme_labels = array(
			
			// Menu button label
			'menu_submit_property' 	=> esc_html__( 'Submit Property', 'cityestate' ),
			'menu_login' 			=> esc_html__( 'Login', 'cityestate' ),
			'menu_signup' 			=> esc_html__( 'Signup', 'cityestate' ),
			'menu_book_now' 		=> esc_html__( 'Book Now', 'cityestate' ),
			'menu_contact_me' 		=> esc_html__( 'Contact Me', 'cityestate' ),
			'submit_now' 			=> esc_html__( 'Submit Now', 'cityestate' ),

			// Blog page
			'about_author' 	=> esc_html__( 'About Author', 'cityestate' ),
			'view_all_post' => esc_html__( 'View All Post', 'cityestate' ),			
			
			// Comment list and comment form
			'comment_list_label' 	=> esc_html__( 'Comments', 'cityestate' ),
			'leave_a_reply' 		=> esc_html__( 'Leave a Reply', 'cityestate' ),			
			'comment_name' 			=> esc_html__( 'Your Name*', 'cityestate' ),
			'comment_email' 		=> esc_html__( 'Email*', 'cityestate' ),
			'comment_website' 		=> esc_html__( 'Website', 'cityestate' ),
			'comment_message' 		=> esc_html__( 'Comment*', 'cityestate' ),
			'comment_submit' 		=> esc_html__( 'Submit Now', 'cityestate' ),

			'at' 						=> esc_html__( 'at', 'cityestate' ),
			'office' 					=> esc_html__( 'Office', 'cityestate' ),
			'mobile' 					=> esc_html__( 'Mobile', 'cityestate' ),
			'fax' 						=> esc_html__( 'Fax', 'cityestate' ),
			'email' 					=> esc_html__( 'Email', 'cityestate' ),
			'website' 					=> esc_html__( 'Website', 'cityestate' ),
			'agent_found_properties' 	=> esc_html__( 'Properties', 'cityestate' ),
			'agent_found_property' 		=> esc_html__( 'Property', 'cityestate' ),
			'my_properties' 			=> esc_html__( 'My Properties', 'cityestate' ),
			'my_property' 				=> esc_html__( 'My Property', 'cityestate' ),
			'contact_me' 				=> esc_html__( 'Contact Me', 'cityestate' ),

			// User sashboard label
			'welcome_back' 		=> esc_html__( 'Welcome back', 'cityestate' ),
			'minimum_image' 	=> esc_html__( '*Minimum 500px x 500px', 'cityestate' ),
			'update_profile' 	=> esc_html__( 'Update Profile Picture', 'cityestate' ),
			'information' 		=> esc_html__( 'Information', 'cityestate' ),

			// Submit property
			'email_already_registerd' 		=> esc_html__( 'This email address is already registered', 'cityestate' ),
			'invalid_email' 				=> esc_html__( 'Invalid email address.', 'cityestate' ),			

			// Property listing
			'search' 			=> esc_html__( 'Search', 'cityestate' ),
			'search_listing'	=> esc_html__( 'Search Listing', 'cityestate' ),
			'published'			=> esc_html__( 'Published', 'cityestate' ),
			'pending'			=> esc_html__( 'Pending', 'cityestate' ),
			'expired'			=> esc_html__( 'Expired', 'cityestate' ),

			// Invoice list
			'properties_not_found' 	=> esc_html__( 'You don\'t have any properties yet!', 'cityestate' ),
			'invoice_heading' 		=> esc_html__( 'Invoices', 'cityestate' ),
			'invoices_total' 		=> esc_html__( 'Total Invoices:', 'cityestate' ),
			'invoices_title' 		=> esc_html__( 'Title', 'cityestate' ),
			'invoices_date' 		=> esc_html__( 'Date', 'cityestate' ),
			'invoices_type' 		=> esc_html__( 'Invoice Type', 'cityestate' ),
			'invoices_billing_type' => esc_html__( 'Billing Type', 'cityestate' ),
			'invoices_status' 		=> esc_html__( 'Status', 'cityestate' ),
			'invoices_price' 		=> esc_html__( 'Price', 'cityestate' ),
			'paid' 					=> esc_html__( 'Paid', 'cityestate' ),
			'not_paid' 				=> esc_html__( 'Not Paid', 'cityestate' ),
			'any' 					=> esc_html__( 'Any', 'cityestate' ),
			'start_date' 			=> esc_html__( 'Start date', 'cityestate' ),
			'end_date' 				=> esc_html__( 'End date', 'cityestate' ),
			'invoice_listing' 		=> esc_html__( 'Listing', 'cityestate' ),
			'invoice_package' 		=> esc_html__( 'Package', 'cityestate' ),
			'invoice_feat_list' 	=> esc_html__( 'Listing with Featured', 'cityestate' ),
			'invoice_upgrade_list' 	=> esc_html__( 'Upgrade to Featured', 'cityestate' ),
			'invoice_update' 		=> esc_html__( 'Update', 'cityestate' ),

			// Add property
			'sub_prop_main_des_title'	=> esc_html__( 'Property Description And Price', 'cityestate' ),
			'sub_prop_title'			=> esc_html__( 'Title', 'cityestate' ),
			'sub_prop_title_pl' 		=> esc_html__( 'Enter your property title', 'cityestate' ),
			'sub_prop_desc'				=> esc_html__( 'Description', 'cityestate' ),
			'sub_prop_type'				=> esc_html__( 'Type', 'cityestate' ),
			'sub_prop_status'			=> esc_html__( 'Status', 'cityestate' ),
			'sub_prop_label'			=> esc_html__( 'Label', 'cityestate' ),
			'sub_prop_sa_re'			=> esc_html__( 'Sale or Rent Price', 'cityestate' ),
			'sub_prop_sa_re_pl'			=> esc_html__( 'Enter Sale or Rent Price', 'cityestate' ),
			'sub_prop_se_price'			=> esc_html__( 'Second Price (Optional)', 'cityestate' ),
			'sub_prop_se_pr_pl'			=> esc_html__( 'Enter your property second price', 'cityestate' ),			
			'sub_prop_pr_pref'			=> esc_html__( 'After Price Label (ex: monthly)', 'cityestate' ),
			'sub_prop_pr_pl'			=> esc_html__( 'Enter after price label', 'cityestate' ),

			// Property media
			'sub_prop_main_medi_title'	=> esc_html__( 'Property Media', 'cityestate' ),
			'sub_prop_drag_drop'	=> esc_html__( 'Drag And Drop Images Here', 'cityestate' ),

			// Property basic detail
			'sub_prop_main_details_title'	=> esc_html__( 'Property Details', 'cityestate' ),
			'sub_prop_prop_la'				=> esc_html__( 'Property ID', 'cityestate' ),
			'sub_prop_prop_pl'				=> esc_html__( 'Enter Property ID', 'cityestate' ),
			'sub_prop_size_la'				=> esc_html__( 'Area Size ( Only digits )', 'cityestate' ),
			'sub_prop_size_pl'				=> esc_html__( 'Enter property area size', 'cityestate' ),
			'sub_prop_size_pre_la'			=> esc_html__( 'Size Prefix', 'cityestate' ),
			'sub_prop_bedroom_la'			=> esc_html__( 'Bedrooms', 'cityestate' ),
			'sub_prop_bedroom_pl'			=> esc_html__( 'Enter number of bedrooms', 'cityestate' ),
			'sub_prop_bathroom_la'			=> esc_html__( 'Bathrooms', 'cityestate' ),
			'sub_prop_bathroom_pl'			=> esc_html__( 'Enter number of bathrooms', 'cityestate' ),
			'sub_prop_garage_la'			=> esc_html__( 'Garages', 'cityestate' ),
			'sub_prop_garage_pl'			=> esc_html__( 'Enter number of garages', 'cityestate' ),
			'sub_prop_year_la'				=> esc_html__( 'Year Built', 'cityestate' ),
			'sub_prop_year_pl'				=> esc_html__( 'Enter year built', 'cityestate' ),
			'sub_prop_shot_addre_la'		=> esc_html__( 'Address (*only street name and building no)', 'cityestate' ),
			'sub_prop_shot_addre_pl'		=> esc_html__( 'Enter Address (*only street name and building no)', 'cityestate' ),

			// Property amenities
			'sub_prop_main_ame_title' 		=> esc_html__( 'Amenities Details', 'cityestate' ),
			'sub_prop_main_essential_title' => esc_html__( 'Essential Information', 'cityestate' ),

			// Property floor plan
			'sub_prop_main_flo_gods_title' 	=> esc_html__( 'Flooring & Goods Included', 'cityestate' ),
			'sub_prop_flo_la' 				=> esc_html__( 'Flooring', 'cityestate' ),
			'sub_prop_flo_pl' 				=> esc_html__( 'Carpet, Laminate Flooring, Linoleum ', 'cityestate' ),
			'sub_prop_goods_la' 			=> esc_html__( 'Goods Included', 'cityestate' ),
			'sub_prop_goods_pl' 			=> esc_html__( 'Dryer, Dishwasher-Build-in, Hood garage Opener-1 Control', 'cityestate' ),

			// Property interior, exterior and room dimensions
			'sub_prop_main_intext_title' 	=> esc_html__( 'Interior & Exterior', 'cityestate' ),
			'sub_prop_main_room_title' 		=> esc_html__( 'Room Dimensions', 'cityestate' ),
			
			// Property floor plan
			'sub_prop_main_floor_title' 	=> esc_html__( 'Floor Plan', 'cityestate' ),
			'sub_prop_floor_plan_title' 	=> esc_html__( 'Plan Title', 'cityestate' ),
			'sub_prop_plan_bedrooms' 		=> esc_html__( 'Plan Bedrooms', 'cityestate' ),
			'sub_prop_floor_plan_bathroom' 	=> esc_html__( 'Plan Bathrooms', 'cityestate' ),
			'sub_prop_floor_plan_price' 	=> esc_html__( 'Plan Price', 'cityestate' ),
			'sub_prop_floor_plan_size' 		=> esc_html__( 'Plan Size', 'cityestate' ),
			'sub_prop_floor_plan_image' 	=> esc_html__( 'Plan Image', 'cityestate' ),
			'sub_prop_plan_desc' 			=> esc_html__( 'Plan Description', 'cityestate' ),

			// Property features
			'sub_prop_main_features_title' => esc_html__( 'Property Features', 'cityestate' ),
			
			// Property location
			'sub_prop_main_location_title' 	=> esc_html__( 'Property Location', 'cityestate' ),
			'property_map_address' 			=> esc_html__( 'Address', 'cityestate' ),
			'property_map_address_pl' 		=> esc_html__( 'Enter your property address', 'cityestate' ),
			'property_area' 				=> esc_html__( 'Neighborhood', 'cityestate' ),
			'property_area_pl' 				=> esc_html__( 'Enter your property neighborhood', 'cityestate' ),
			'property_city' 				=> esc_html__( 'City', 'cityestate' ),
			'property_city_pl' 				=> esc_html__( 'Enter your property city', 'cityestate' ),
			'property_location' 			=> esc_html__( 'State / County', 'cityestate' ),
			'property_location_pl' 			=> esc_html__( 'Enter your property state/county', 'cityestate' ),
			'postal_code' 					=> esc_html__( 'Postal Code / Zip', 'cityestate' ),
			'postal_code_pl' 				=> esc_html__( 'Enter your property zip code', 'cityestate' ),
			'reset_label' 					=> esc_html__( 'Place the pin the address above', 'cityestate' ),
			'reset_btn' 					=> esc_html__( 'Reset Marker', 'cityestate' ),
			'latitude' 						=> esc_html__( 'Google Maps latitude', 'cityestate' ),
			'latitude_pl' 					=> esc_html__( 'Enter google maps latitude', 'cityestate' ),
			'longitude' 					=> esc_html__( 'Google Maps longitude', 'cityestate' ),
			'longitude_pl' 					=> esc_html__( 'Enter google maps longitude', 'cityestate' ),
			'property_google_street_view' 	=> esc_html__( 'Google Map Street View', 'cityestate' ),			

			// Property agent
			'sub_prop_main_agent_title' => esc_html__( 'Agent Information', 'cityestate' ),
			'sub_prop_agent_sub_title' 	=> esc_html__( 'What to display in agent information box?', 'cityestate' ),
			'sub_prop_author_info' 		=> esc_html__( 'Author information.', 'cityestate' ),
			'sub_prop_agent_info' 		=> esc_html__( 'Agent Information. ( Select the agent below )', 'cityestate' ),
			'sub_prop_hide_info_box' 	=> esc_html__( 'Hide information box', 'cityestate' ),

			// Property video
			'sub_prop_main_video_title' 	=> esc_html__( 'Property Video', 'cityestate' ),
			'sub_prop_video_img' 			=> esc_html__( 'Video Image', 'cityestate' ),
			'sub_prop_property_video_url' 	=> esc_html__( 'Video URL', 'cityestate' ),			
			'sub_prop_video_pl' 			=> esc_html__( 'YouTube, Vimeo, SWF File and MOV File are supported', 'cityestate' ),

			// Property near by place
			'sub_prop_main_near_title' => esc_html__( 'Near By Place', 'cityestate' ),
			'sub_prop_place_type' => esc_html__( 'Place Type', 'cityestate' ),
			'sub_prop_place_image' => esc_html__( 'Place Icon', 'cityestate' ),

			// Property submit validation
			'vali_msg_title' 		=> esc_html__( 'Property Title Is Required.', 'cityestate' ),
			'vali_msg_type' 		=> esc_html__( 'Please Select Property Type.', 'cityestate' ),
			'vali_msg_status' 		=> esc_html__( 'Please Select Property Status.', 'cityestate' ),
			'vali_msg_label' 		=> esc_html__( 'Please Select Property Label.', 'cityestate' ),
			'vali_msg_price' 		=> esc_html__( 'Property Price Is Required.', 'cityestate' ),
			'vali_msg_price_label' 	=> esc_html__( 'After Price Label Is Required.', 'cityestate' ),
			'vali_msg_id' 			=> esc_html__( 'Property ID Is Required.', 'cityestate' ),
			'vali_msg_size' 		=> esc_html__( 'Property Size Is Required.', 'cityestate' ),
			'vali_msg_beds' 		=> esc_html__( 'Property Bedrooms Is Required.', 'cityestate' ),
			'vali_msg_baths' 		=> esc_html__( 'Property Bathrooms Is Required.', 'cityestate' ),
			'vali_msg_garage' 		=> esc_html__( 'Property Garages Is Required.', 'cityestate' ),
			'vali_msg_year_built' 	=> esc_html__( 'Property Year Built Is Required.', 'cityestate' ),
			'vali_msg_address' 		=> esc_html__( 'Property Short Address Is Required.', 'cityestate' ),

			// Payment method label
			'payment_method' => esc_html__( 'Payment Method', 'cityestate' ),
		);
		return $theme_labels;
	}
}
