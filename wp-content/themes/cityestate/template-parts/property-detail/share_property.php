<?php
global $tab_class;

// Check property share on social media
$share_social = cityestate_option( 'property_detail_share_social' );
// Active share social media
$share_show = cityestate_option( 'property_detail_share_show' );
$share_show = $share_show['enabled']; 
$twitter_user = '';//$ft_option['twitter_username'];

// Social media is active
if( $share_social == 1 ){ ?>
  <div id="share_property" class="share_property property-detail-section <?php echo esc_attr($tab_class); ?>">
  	<!-- Share property section title -->
    <h3 class="title"><?php esc_html_e( 'Share this Property','cityestate' ); ?></h3>
  	<div class="property-socials">
    	<!-- Share on facebook social media -->
      <?php if( in_array( 'Facebook', $share_show ) ){ ?>
    		<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" onclick="window.open( this.href, 'mywin', 'left=50, top=50, width=600, height=350, toolbar=0' ); return false;" class="socials-link facebook-color">
      			<img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/facebook-social.png" alt="facebook"/>
      			<?php esc_html_e( 'Share on Facebook','cityestate' ); ?>
      	</a><?php
      }
      // Share on twitter social media
      if( in_array( 'Twitter', $share_show ) ){ ?>
      	<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() ); ?>&url=<?php echo urlencode( get_permalink() ); ?>&via=<?php echo urlencode( $twitter_user ? $twitter_user : get_bloginfo('name') ); ?>" onclick="if( !document.getElementById('td_social_networks_buttons') ){ window.open( this.href, 'mywin', 'left=50, top=50, width=600, height=350, toolbar=0'); return false;}" class="socials-link twitter-color">
      			<img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/twitter-social.png" alt="twitter"/>
      			<?php esc_html_e( 'Share on Twiiter','cityestate' ); ?>
      	</a><?php
      }
      // Share on google social media
      if( in_array( 'Google Plus', $share_show ) ){ ?>
      	<a href="http://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" onclick="window.open( this.href, 'mywin', 'left=50, top=50, width=600, height=350, toolbar=0' ); return false;" class="socials-link google-color">
      			<img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/google-social.png" alt="google"/>
      			<?php esc_html_e( 'Share on Google','cityestate' ); ?>
      	</a><?php
      } 
    	// Share on pinterest social media
      if( in_array( 'Pinterest', $share_show ) ){ ?>
        <?php $property_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' ); ?>
      	<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink() ); ?>&amp;media=<?php $Property_Image = ( !empty( $property_image[0] ) ? $property_image[0] : '' ); echo esc_attr($Property_Image); ?>" onclick="window.open(this.href, 'mywin', 'left=50, top=50, width=600, height=350, toolbar=0' ); return false;" class="socials-link google-color">
      			<img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/google-social.png" alt="google"/>
      			<?php esc_html_e( 'Share on Pinterest','cityestate' ); ?>
      	</a><?php
      }
      // Share on email address
      if( in_array( 'Email', $share_show ) ){ ?>
      	<a href="mailto:example.com?subject=<?php echo urlencode( get_the_title() ); ?>&body=<?php echo urlencode( get_permalink() ); ?>" class="socials-link google-color">
      			<img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/google-social.png" alt="google"/>
      			<?php esc_html_e( 'Share on Email','cityestate' ); ?>
      	</a><?php
      } ?>
    </div>
  </div><?php
} ?>