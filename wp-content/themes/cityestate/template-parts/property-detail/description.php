<?php global $tab_class; ?>
<!-- Property description -->
<div id="description" class="property_description property-detail-section <?php echo esc_attr($tab_class); ?>">
	<h2 class="title"><?php esc_html_e('Description','cityestate'); ?></h2>
	<!-- Show few line -->
	<p><?php echo substr( $post->post_content, 0, 550 ); ?></p>
	<div class="expand-txt">
		<!-- Show full content -->
		<p><?php echo substr( $post->post_content, 550 ); ?></p>
	</div>
	<a href="javascript:void(0);" class="expand-link"><?php esc_html_e( '+ Expand more','cityestate' ); ?></a>					
</div>