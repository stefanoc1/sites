<?php 
global $tab_class;

// Get floor plan detail
$floor_plans = get_post_meta( get_the_ID(), 'floor_plans', true );

// Check floor plan is not empty
if( !empty($floor_plans) ){ ?>
	<div id="floor_plans" class="property_floorplan property-detail-section <?php echo esc_attr($tab_class); ?>">
		<!-- Floor plan title -->
		<h3 class="title"><?php esc_html_e( 'Floor Plans','cityestate' ); ?></h3>
		<ul class="nav nav-tabs" role="tablist"><?php
			// Show floor plan title
			$counter = 0;					
			foreach( $floor_plans as $info ):
	            $active_class = ( $counter == 0 ) ? $active_class = "active" : '';
	            echo '<li role="presentation" class="'.esc_attr( $active_class ).'"><a href="#'.esc_attr( $counter ).'" aria-controls="'.esc_attr( $counter ).'" role="tab" data-toggle="tab">'.sprintf( esc_html__( '%s', 'cityestate' ), $info['floor_plan_title'] ).'</a></li>';
	            $counter++;
	        endforeach; ?>
	    </ul>
	  	<!-- Tab panes -->
	  	<div class="tab-content"><?php
	  		$counter = 0;
			// Run floor plan loop
			foreach( $floor_plans as $info ):
				$active_class = ( $counter == 0 ) ? $active_class = "active" : ''; ?>
				<div role="tabpanel" class="tab-pane <?php echo esc_attr( $active_class ); ?>" id="<?php echo esc_attr( $counter ); ?>">
			    	<div class="feat-img">
			    		<!-- Floor plan image -->
			    		<?php if( !empty( $info['floor_plan_image'] ) ){ ?>
		                    <img src="<?php echo esc_url( $info['floor_plan_image'] ); ?>" alt="<?php echo esc_attr($info['floor_plan_title']); ?>">
		                <?php } ?>
			    	</div>
			    	<div class="price-box">
			    	<div class="pull-left">
			    		<!-- Floor plan size -->
			    		<?php if( !empty( $info['floor_plan_size'] ) ){ ?>
			    			<span><?php printf( esc_html__( '%s', 'cityestate' ), $info['floor_plan_size']); ?></span>
			    		<?php } ?>
			    		<!-- Floor plan room -->
			    		<?php if( !empty( $info['floor_plan_room'] ) ){ ?>
			    			<span><?php printf( esc_html__( '%s', 'cityestate' ), $info['floor_plan_room']); ?></span>
			    		<?php } ?>
			    		<!-- Floor plan bathroom -->
			    		<?php if( !empty( $info['floor_plan_bathroom'] ) ){ ?>
			    			<span><?php printf( esc_html__( '%s', 'cityestate' ), $info['floor_plan_bathroom']); ?></span>
			    		<?php } ?>
			    	</div>
			    	<!-- Floor plan price -->
			    	<div class="pull-right">
			    		<?php if( !empty( $info['floor_plan_price'] ) ){ ?>
			    			<span class="price"><?php printf( esc_html__( '%s', 'cityestate' ), $info['floor_plan_price']); ?></span>
			    		<?php } ?>
			    	</div>
			    	</div>
			    	<!-- Floor plan info -->
			    	<?php if( !empty( $info['floor_plan_info'] ) ){ ?>
			    		<p><?php printf( esc_html__( '%s', 'cityestate' ), $info['floor_plan_info']); ?></p>
			    	<?php } ?>
			    </div><?php
			    $counter++;
			endforeach; ?>
	  	</div>
	</div>
<?php } ?>