<?php global $tab_class; ?>

<div id="details" class="property_aminities property-detail-section <?php echo esc_attr($tab_class); ?>"><?php
	// Show amenities
	$amenities = get_post_meta( get_the_ID(), 'propertyamenities', true );
	if( !empty($amenities) ){ ?>
		<div id="amenities" class="property_aminities property-space property-detail-section"><?php
			if( !empty($amenities) ){ ?>
				<h3 class="title"><?php esc_html_e( 'Amenities','cityestate' ); ?></h3>
				<ul class="amenities-list"><?php						
					// Amenities value
					foreach( $amenities as $amenitie ):
		                echo '<li>'.esc_attr( $amenitie['amenities_value'] ).'</li>';
		            endforeach; ?>
		        </ul><?php
		    } ?>
		</div><?php
	}

	// Get property essential infomation
	$property_info = get_post_meta( get_the_ID(), 'property_info', true );
	if( !empty($property_info) ){ ?>
		<div id="essential_infomation" class="essential_infomation property-detail-section">		
	    	<h3 class="title"><?php esc_html_e( 'Essential Infomation','cityestate' ); ?></h3>
			<ul class="essential-list"><?php				
				// Show property essential infomation
				foreach( $property_info as $info ):
	                echo '<li>'.esc_attr( $info['property_info_label'] ).' : <span>'.esc_attr( $info['property_info_value'] ).'</span></li>';
	            endforeach; ?>
			</ul>
		</div><?php
	}

	// Get propery flooring detail
	$flooring_detail = get_post_meta( get_the_ID(), 'flooring_detail', true );
	// Get property goods detail
	$goods_detail = get_post_meta( get_the_ID(), 'goods_detail', true );
	if( !empty($flooring_detail) || !empty($goods_detail) ){ ?>
		<div id="flooring_goods" class="property_aminities property-detail-section">
			<div class="color-box">
				<!-- Show property flooring detail -->
				<h3 class="title"><?php esc_html_e( 'Flooring','cityestate' ); ?></h3>
				<ul class="floor-list">
					<li><?php printf( esc_html__( '%s', 'cityestate' ), $flooring_detail); ?></li>
				</ul>
				<!-- Show property goods -->
				<h3 class="title"><?php esc_html_e( 'Goods included','cityestate' ); ?></h3>
				<ul class="floor-list">
					<li><?php printf( esc_html__( '%s', 'cityestate' ), $goods_detail); ?></li>
				</ul>
			</div>
		</div><?php
	}

	// Get property interior exterior detail
	$interior_exterior = get_post_meta( get_the_ID(), 'interior_exterior', true );
	if( !empty($interior_exterior) ){ ?>
		<div id="interior_exterior" class="interior_exterior property-detail-section">
			<h3 class="title"><?php esc_html_e( 'Interior & Exterior','cityestate' ); ?></h3>
			<ul class="essential-list"><?php
				// Show property interior exterior detail
				foreach( $interior_exterior as $info ):
	                echo '<li>'.esc_attr( $info['interior_label'] ).' : <span>'.esc_attr( $info['interior_value'] ).'</span></li>';
	            endforeach; ?>
			</ul>
		</div><?php
	}

	// Get room dimension
	$room_dimensions = get_post_meta( get_the_ID(), 'room_dimensions', true ); 
	if( !empty($room_dimensions) ){ ?>
		<div id="room_dimensions" class="property_roomdimension property-detail-section <?php echo esc_attr($tab_class); ?>">
			<h3 class="title"><?php esc_html_e( 'Room Dimensions','cityestate' ); ?></h3>
			<ul class="essential-list"><?php
				// Show room dimension
				foreach( $room_dimensions as $info ):

	                echo '<li>'.esc_attr( $info['rom_dime_label'] ).' : <span>'.esc_attr( $info['rom_dime_value'] ).'</span></li>';
	            endforeach; ?>
			</ul>
		</div><?php
	} ?>

</div>