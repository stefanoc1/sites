<?php

if( class_exists( "WPBakeryVisualComposerAbstract") ){
	
	if( !function_exists("cityestate_setup_vc_row") ){
		
		function cityestate_setup_vc_row(){
			
			vc_remove_param( "vc_row", "full_width" );
			vc_remove_param( "vc_row", "gap" );
			vc_remove_param( "vc_row", "full_height" );
			vc_remove_param( "vc_row", "columns_placement" );			
			vc_remove_param( "vc_row", "content_placement" );
			vc_remove_param( "vc_row", "video_bg" );
			vc_remove_param( "vc_row", "video_bg_url" );
			vc_remove_param( "vc_row", "video_bg_parallax" );
			vc_remove_param( "vc_row", "parallax" );
			vc_remove_param( "vc_row", "parallax_image" );
			vc_remove_param( "vc_row", "parallax_speed_video" );
			vc_remove_param( "vc_row", "parallax_speed_bg" );
			vc_remove_param( "vc_row", "el_id" );
			vc_remove_param( "vc_row", "el_class" );
			vc_remove_param( "vc_row", "css" );
			
			$attr = array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Select Row Type", "cityestate" ),
							"param_name" 	=> "row_type",
							"description" 	=> esc_html__( "Select row types available in theme, [row,blox,blox_dark,parallax,video background] are available", "cityestate" ),
							"value"			=> array( esc_html__( "Default", "cityestate" ) => "0", esc_html__( "FullWidth Row", "cityestate" ) => "1", esc_html__( "Blox", "cityestate" ) => "2", esc_html__( "Parallax", "cityestate" ) => "3", esc_html__( "Video Background", "cityestate" ) => "4", esc_html__( "MaxSlider", "cityestate" ) => "5" )
   						);			
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type" 			=> "checkbox",
							"heading" 		=> esc_html__( "Animation (Bottom to top)", "cityestate" ),
							"param_name" 	=> "animate",
							"description" 	=> esc_html__( "Specify the animation entry", "cityestate" ),
							"value" 		=> array( esc_html__( "Yes", "cityestate" ) => "fc-animate" ),
							"std" 			=> "fc-animate",
						);
			vc_add_param("vc_row",$attr);	
			
			$attr = array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Row ID", "cityestate" ),
							"param_name" 	=> "row_id",
							"description" 	=> esc_html__( "Enter the row ID", "cityestate" ),
							"value"			=> ""
   						);			
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type"			=> "dropdown",
							"heading"		=> esc_html__( "Background Video Source", "cityestate" ),
							"param_name"	=> "video_src",
							"value"			=> array(
														esc_html__( "Self Hosted", "cityestate" ) 	=> "host",
														esc_html__( "Youtube", "cityestate" )		=> "video_sharing",
													),
							"description" 	=> wp_kses( __( "<strong style=\"color: red;\">!Important:</strong> When you choose \"Host\" type, for better experience you must upload MP4,WebM and OGG format altogether", "cityestate"), array( "strong" => array( "style" => array() ) ) ),
							"dependency"	=> array( "element" => "row_type", "value" => array("4") )
						);			
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type"			=> "textfield",
							"heading"		=> esc_html__( "Youtube Video ID", "cityestate" ),
							"param_name"	=> "video_sharing_url",
							"value"			=> "",
							"description" 	=> esc_html__( "Input your youtube video ID", "cityestate"),
							"dependency"	=> array( "element" => "video_src", "value" => array( "video_sharing" ) )
						);
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type"			=> "textfield",
							"heading"		=> esc_html__( ".MP4 Format", "cityestate" ),
							"param_name"	=> "mp4_format",
							"value"			=> "",
							"description" 	=> esc_html__( "Compatibility for Safari and IE9", "cityestate"),
							"dependency"	=> array( "element" => "video_src", "value" => array("host") )
						);
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type"			=> "textfield",
							"heading"		=> esc_html__( ".WebM Format", "cityestate" ),
							"param_name"	=> "webm_format",
							"value"			=> "",
							"description" 	=> esc_html__( "Compatibility for Firefox4, Opera, and Chrome", "cityestate"),
							"dependency"	=> array( "element" => "video_src", "value" => array( "host" ) )
						);
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type"			=> "textfield",
							"heading"		=> esc_html__( ".Ogg Format", "cityestate" ),
							"param_name"	=> "ogg_format",
							"value"			=> "",
							"description" 	=> esc_html__( "Compatibility for older Firefox and Opera versions", "cityestate"),
							"dependency"	=> array( "element" => "video_src", "value" => array( "host" ) )
						);
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type"			=> "attach_image",
							"heading"		=> esc_html__( "Background image", "cityestate" ),
							"param_name"	=> "img_preview_video",
							"value"			=> "",
							"description" 	=> esc_html__( 'This Image will be showed up until video is loaded. If video is not supported or could not load on user"s machine, the image will stay in background.', "cityestate"),
							"dependency"	=> array( "element" => "row_type", "value" => array( "4" ) )
						);
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Height", "cityestate" ),
							"param_name" 	=> "blox_height",
							"description" 	=> esc_html__( "Select blox Height in number format Example: 380", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3", "4" ) )
						);			
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Background Image", "cityestate" ),
							"param_name" 	=> "blox_image",
							"description" 	=> esc_html__( "Select background image URL", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ) )
						);			
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Background Attachment", "cityestate" ),
							"param_name" 	=> "blox_bg_attachment",
							"description" 	=> esc_html__( "Select Background Attachment?", "cityestate" ),
							"value"			=> array( esc_html__( "Scroll", "cityestate" ) => "false", esc_html__( "Fixed", "cityestate" ) => "true" ),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2" ) )
						);			
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Background Position", "cityestate" ),
							"param_name" 	=> "blox_bg_position",
							"description" 	=> esc_html__( "The background-position property sets the starting position of a background image.", "cityestate" ),
							"value"			=> array(
														esc_html__( "Left Top", "cityestate" )			=> "left top",
														esc_html__( "Left Center", "cityestate" )		=> "left center",
														esc_html__( "Left Bottom", "cityestate" )		=> "left bottom",
														esc_html__( "Center Top", "cityestate" )		=> "center top",
														esc_html__( "Center Center", "cityestate" )		=> "center center",
														esc_html__( "Center Bottom", "cityestate" )		=> "center bottom",
														esc_html__( "Right Top", "cityestate" )			=> "right top",
														esc_html__( "Right Center", "cityestate" )		=> "right center",
														esc_html__( "Right Bottom", "cityestate" )		=> "right bottom",
													),
							"std" 			=> "center center",
							"dependency"	=> array( "element" => "row_type", "value" => array( "2" ) )
						);			
			vc_add_param("vc_row",$attr);
						
			$attr = array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Background Cover?", "cityestate" ),
							"param_name" 	=> "blox_cover",
							"description" 	=> esc_html__( "Blox has cover background?", "cityestate" ),
							"value"			=> array( esc_html__( "True", "cityestate" ) => "true", esc_html__( "False", "cityestate" ) => "false" ),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ) )
						);			
			vc_add_param("vc_row",$attr);
				
			$attr = array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Background Repeat?", "cityestate" ),
							"param_name" 	=> "blox_repeat",
							"description" 	=> esc_html__( "Is Background image repeated?", "cityestate" ),
							"value"			=> array( esc_html__( "No Repeat", "cityestate" ) => "no-repeat", esc_html__( "Repeat", "cityestate" ) => "repeat"),
							"dependency"	=> array( "element" => "row_type","value" => array( "2", "3" ) )
						);			
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type" 			=> "checkbox",
							"heading" 		=> esc_html__( "Align Center?", "cityestate" ),
							"param_name" 	=> "align_center",
							"description" 	=> esc_html__( "Align center content", "cityestate" ),
							"value" 		=> array( esc_html__( "Yes", 'cityestate' ) => "aligncenter" ),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3", "4") )
						);	
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type" 			=> "checkbox",
							"heading" 		=> esc_html__( "Full Width Container", "cityestate" ),
							"param_name" 	=> "full_container",
							"value" 		=> array( esc_html__( "Yes", 'cityestate' ) => "full-container" ),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ) ),
						);			
			vc_add_param("vc_row",$attr);	
			
			$attr = array(
							"type" 			=> "checkbox",
							"heading" 		=> esc_html__( "Background Image None in Mobile Size", "cityestate" ),
							"param_name" 	=> "responsive_bg_none",
							"value" 		=> array( esc_html__( "Yes", 'cityestate' ) => "respo-bg-none" ),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ) ),
						);			
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Padding Top", "cityestate" ),
							"param_name" 	=> "blox_padding_top",
							"description" 	=> esc_html__( "Blox Top Padding in px format", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ,"4" ) )
						);
			vc_add_param("vc_row",$attr);
						
			$attr = array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Padding Bottom", "cityestate" ),
							"param_name" 	=> "blox_padding_bottom",
							"description" 	=> esc_html__( "Blox Bottom Padding in px format", "cityestate" ),
							"value" 		=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3", "4" ) )
						);			
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Dark or Light?", "cityestate" ),
							"param_name" 	=> "blox_dark",
							"description" 	=> esc_html__( "If you choose Dark, Background Color goes dark and Text Color goes light<br/>If you choose Light, Background Color goes Light and Text Color goes dark", "cityestate" ),
							"value"			=> array( esc_html__( "Light", "cityestate" ) => "false", esc_html__( "Dark", "cityestate" ) => "true" ),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3", "4" ) )
						);			
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Extra Class", "cityestate" ),
							"param_name" 	=> "blox_class",
							"description" 	=> esc_html__( "Predefined colors are greenbox,redbox,bluebox,yellowbox,gray. To use custom color please use below Cutom Background Color", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type" , "value" => array( "0", "1", "2","3","4" ) )
						);			
			vc_add_param("vc_row",$attr);

			$attr = array(
							"type" 			=> "colorpicker",
							"heading" 		=> esc_html__( "Background Color", "cityestate" ),
							"param_name" 	=> "blox_bgcolor",
							"description" 	=> esc_html__( "Select Custom Background color", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ) )
						);			
			vc_add_param("vc_row",$attr);			
			
			$attr = array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Speed(Parallax)", "cityestate" ),
							"param_name" 	=> "parallax_speed",
							"description" 	=> esc_html__( "Select Parallax scroll speed in number format Example: 6", "cityestate" ),
							"value"			=> "6",
							"dependency"	=> array( "element" => "row_type", "value" => array( "3" ) )
						);			
			vc_add_param("vc_row",$attr);	
						
			$attr = array(
							"type"			=> "dropdown",
							"heading"		=> esc_html__( "Pattern", "cityestate" ),
							"param_name"	=> "video_pattern",
							"value"			=> array( "Enable" => "true", "Disable" => "false" ),
							"description" 	=> esc_html__( "Display Foreground dotted Pattern", "cityestate"),
							"dependency"	=> array( "element" => "row_type", "value" => array( "4" ) )
						);
			vc_add_param("vc_row",$attr);
			
			$attr = array(
							"type"			=> "colorpicker",
							"heading"		=> esc_html__( "Overlay color", "cityestate" ),
							"param_name"	=> "row_color",
							"value"			=> "",
							"description" 	=> esc_html__( "Overlay Color  for [blox,parallax]", "cityestate"),
							"dependency"	=> array( "element" => "row_type", "value" => array( "2", "3" ) )
						);
			vc_add_param("vc_row",$attr);				
			
			$attr =	array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Slide 1", "cityestate" ),
							"param_name" 	=> "maxslider_image1",
							"description" 	=> esc_html__( "Select Slide 1 Image", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )
			    		);
			vc_add_param("vc_row",$attr);

			$attr =	array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Slide 2", "cityestate" ),
							"param_name" 	=> "maxslider_image2",
							"description" 	=> esc_html__( "Select Slide 2 Image", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )
						);
		    vc_add_param("vc_row",$attr);

			$attr =	array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Slide 3", "cityestate" ),
							"param_name" 	=> "maxslider_image3",
							"description" 	=> esc_html__( "Select Slide 3 Image", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )
		    			);
		    vc_add_param("vc_row",$attr);

			$attr =	array(
						"type" 			=> "attach_image",
						"heading" 		=> esc_html__( "Slide 4", "cityestate" ),
						"param_name" 	=> "maxslider_image4",
						"description" 	=> esc_html__( "Select Slide 4 Image", "cityestate" ),
						"value"			=> "",
						"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )
		    		);
		    vc_add_param("vc_row",$attr);

			$attr =	array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Slide 5", "cityestate" ),
							"param_name" 	=> "maxslider_image5",
							"description" 	=> esc_html__( "Select Slide 5 Image", "cityestate" ),
							"value"			=> "",
							"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )
		    			);
			vc_add_param("vc_row",$attr);

			$attr =	array(
							"type"			=> "dropdown",
							"heading"		=> esc_html__( "Parallax Images", "cityestate" ),
							"param_name"	=> "maxslider_parallax",
							"value"			=> array( "Yes" => "true", "No" => "false" ),
							"description" 	=> esc_html__( "Parallax images for maxslider", "cityestate"),
							"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )				
						);
			vc_add_param("vc_row",$attr);

			$attr =	array(
							"type"			=> "dropdown",
							"heading"		=> esc_html__( "Pattern Images", "cityestate" ),
							"param_name"	=> "maxslider_pattern",
							"value"			=> array( "Yes" => "true", "No" => "false" ),
							"description" 	=> esc_html__( "Pattern images for maxslider", "cityestate"),
							"dependency"	=> array( "element" => "row_type", "value" => array( "5" ) )				
						);
			vc_add_param("vc_row",$attr);			
						
		}
		
	}
	
	add_action("admin_init", "cityestate_setup_vc_row");
	
}

?>