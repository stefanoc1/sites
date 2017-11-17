<?php 
global $tab_class;
// Get property video image and video url
$video_image 	= get_post_meta( get_the_ID(), 'property_video_image', true );
$video_url 		= get_post_meta( get_the_ID(), 'property_video_url', true ); 

// Check video iamge and url available
if( !empty($video_image) || !empty($video_url) ){ ?>
	<div id="property_video" class="property_video property-detail-section <?php echo esc_attr($tab_class); ?>">
		<!-- Property video section title -->
		<h3 class="title"><?php esc_html_e( 'Property video','cityestate' ); ?></h3>
		<div class="video">
			<!-- Show property video image -->
			<a href="#" data-toggle="modal" data-target="#property-video-model">
				<img src="<?php echo esc_url( $video_image ); ?>" alt="video-image"/>
			</a>
		</div>
	</div><?php
}  else { ?>

	<div id="property_video" class="property_video property-detail-section <?php echo esc_attr($tab_class); ?>">
	<h3>No Property Video uploaded yet.</h3>
	</div>
<?php } ?>