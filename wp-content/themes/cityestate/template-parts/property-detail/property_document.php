<?php 
global $tab_class;
// Get property document
$property_document = get_post_meta( get_the_ID(), 'property_document', true );

// Check property document is available
if( !empty($property_document) ){ ?>
	<div id="property_documents" class="property_floorplan property-detail-section <?php echo esc_attr($tab_class); ?>">
		<!-- Property document section title -->
		<h3 class="title"><?php esc_html_e( 'Property Documents','cityestate' ); ?></h3>
	  	<div class="property-documents"><?php 
	  		// Run the loop property documents
	  		foreach( $property_document as $info ): ?>
	  			<?php 
	  				if(empty($info['document_title'])) {
	  					$info['document_title'] = "Property Document";
	  				}
	  			?>
		  		<!-- Property document link -->
		  		<a href="<?php echo esc_url($info['document_attachment']); ?>" target="_blank" class="ducument-link">
		  			<!-- Property document icon or image -->
		  			<img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/linkimg.png" alt="link-image"/>
		  			<?php printf( esc_html__( '%s', 'cityestate' ), $info['document_title'] ); ?>
		  		</a><?php			  	
		  	endforeach; ?>
	  	</div>
	</div><?php
} else { ?>
	<div id="property_documents" class="property_floorplan property-detail-section <?php echo esc_attr($tab_class); ?>">
	<h3>No Documents uploaded yet.</h3>
	</div>
<?php } ?>