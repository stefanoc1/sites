<?php
// Get property images
$property_images = get_post_meta( get_the_ID(), 'property_images', false );
// Check property image is available
if( !empty( $property_images ) ){ ?>
	<div class="property-detail-slider">
		<div id="myCarousel" class="slider_div carousel slide" data-ride="carousel">
			<!-- Slider indicator -->
			<ol class="carousel-indicators">
			    <?php foreach( $property_images as $key => $image_id ): ?>
	                <!-- Slider indicator -->
	                <li data-target="#myCarousel" data-slide-to="<?php echo esc_attr($key); ?>" <?php if( $key == 0 ){ echo 'class="active"'; } ?> ></li>                
	            <?php endforeach; ?>
			</ol>
			<!-- Property image -->
			<div class="carousel-inner" role="listbox">
				<?php foreach( $property_images as $key => $image_id ): ?>
					<!-- Show property slider image -->
					<div class="item <?php if( $key == 0 ){ echo 'active'; } ?>">
						<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>					
					</div>
				<?php endforeach; ?>			
			</div>								
		</div>
	</div>
<?php } ?>