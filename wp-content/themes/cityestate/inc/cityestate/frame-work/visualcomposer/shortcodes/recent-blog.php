<?php

$categories = array();
$categories = get_categories();

$Category_ID_Array = array('');

foreach($categories as $category){
	$Category_ID_Array[$category->term_id] = $category->name;
}

vc_map(
	array(
		'name' 		=> esc_html__( 'Recent Blog', 'cityestate' ),
		'base' 		=> 'cityestate_recent_blog',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'recent-blog',
		'params' 	=> array(			

			array(
				'param_name' 	=> 'posts_limit',
				'type' 			=> 'textfield',
				'value' 		=> '6',
				'heading' 		=> esc_html__( 'Limit post number:', 'cityestate' ),				
				'save_always' 	=> true,
			),				

			array(
			   'type' 			=> 'dropdown',
			   'heading' 		=> esc_html__( 'Category', 'cityestate' ),
			   'param_name' 	=> 'category',
			   'value' 			=> $Category_ID_Array,
			   'description' 	=> esc_html__( 'Select specific category, leave blank to show all categories.', 'cityestate')
			),			

			array(
			   'type' 			=> 'dropdown',
			   'heading' 		=> esc_html__( 'Order By', 'cityestate' ),
			   'param_name' 	=> 'sort',
			   'value' 			=> array_flip( array( 'date' => esc_html__( 'Date', 'cityestate' ),'title' => esc_html__( 'Title', 'cityestate' ) ,'name' => esc_html__( 'Name', 'cityestate' ) ,'author' => esc_html__( 'Author', 'cityestate' ),'comment_count' => esc_html__( 'Comment Count', 'cityestate' ),'random' => esc_html__( 'Random', 'cityestate' ) ) ),			
			   'description' 	=> esc_html__( 'Enter the sorting order.', 'cityestate' )
			),

			array(
			   'type' 			=> 'dropdown',
			   'heading' 		=> esc_html__( 'Order', 'cityestate' ),
			   'param_name' 	=> 'order',
			   'value' 			=> array_flip(array('ASC' => esc_html__( 'Ascending', 'cityestate' ),'DESC' => esc_html__( 'Descending', 'cityestate' ) ) ),			
			   'description' 	=> esc_html__( 'Enter the sorting order.', 'cityestate' )
			),			

			array(
				'param_name' 	=> 'offset',
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading' 		=> esc_html__( 'Offset posts:', 'cityestate' ),				
				'save_always' 	=> true
			),
			
			array(
				'param_name' 	=> 'list_style',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Style 1', 'cityestate' ) => '0', esc_html__( 'Style 2', 'cityestate' ) => '1' ),
				'heading' 		=> esc_html__( 'Style:', 'cityestate' ),				
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
			),
			
			array(
				'param_name' 	=> 'slider_infinite',
				'type' 			=> 'dropdown',
				'value' 		=> array(
										esc_html__( 'Yes', 'cityestate' ) 	=> 'true',
										esc_html__( 'No', 'cityestate' ) 	=> 'false'
									),
				'heading' 		=> esc_html__( 'Infinite Scroll:', 'cityestate' ),				
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
			),

			array(
				'param_name' 	=> 'slider_auto',
				'type' 			=> 'dropdown',
				'value' 		=> array(
										esc_html__( 'Yes', 'cityestate' ) 	=> 'carousel',
										esc_html__( 'No', 'cityestate' ) 	=> 'no'
									),
				'heading' 		=> esc_html__( 'Auto Play:', 'cityestate' ),				
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
			),

			array(
				'param_name' 	=> 'slider_auto_speed',
				'type' 			=> 'textfield',
				'value' 		=> '5000',
				'heading' 		=> esc_html__( 'Auto Play Speed:', 'cityestate' ),
				'description' 	=> esc_html__( 'Autoplay Speed in milliseconds. Default 5000', 'cityestate' ),			
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
			),			

		)
	)
);

?>