<!-- Property slider -->
<div id="homepropertyslider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox"><?php
        // Collect the property status
        $args = array( 'post_type' => 'property', 'meta_key' => 'homeslide', 'meta_value' => 'yes', 'posts_per_page' => '-1' );
        $property_slider = new WP_Query( $args );

        $counter = 0;
        // Check property slider found
        if( $property_slider->have_posts() ): 
            while( $property_slider->have_posts() ): $property_slider->the_post();
                // Get slider image    
                $slider_image   = get_post_meta( $post->ID, 'slider_image', true );    
                $imag_url       = wp_get_attachment_image_src( $slider_image, 'cityestate_property_slider_image', true ); ?>
                <div class="item <?php echo ( $counter == 0 ) ? esc_attr('active') : ''; ?>">
                    <!-- Show property image -->
                    <img src="<?php echo esc_url($imag_url[0]); ?>" alt="<?php echo get_the_title(); ?>" class="image_header"/>
                    <!-- Show property info -->
                    <div class="container home-page-slider-header">
                        <div class="slider_text">
                            <!-- Property title -->
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <!-- Property location info -->
                            <?php echo include( get_template_directory() . '/template-parts/property_location_info.php'); ?>
                            <ul class="property-basic-info">
                                <!-- Property basic detail -->
                                <?php echo cityestate_basic_info(); ?>
                            </ul>
                            <div class="property_info_price">
                                <!-- Property basic detail -->
                                <?php echo cityestate_get_property_price(); ?>
                                <!-- Property status label -->
                                <?php echo include( get_template_directory() . '/template-parts/property_status_label.php'); ?>
                            </div>
                        </div>
                    </div>
                </div><?php
                $counter++;
            endwhile;
        endif;
        // Reset wp query
        wp_reset_postdata(); ?>
    </div>

    <!-- Slider previous arrow -->
    <a class="left carousel-control" href="#homepropertyslider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
    </a>
    <!-- Slider next arrow -->
    <a class="right carousel-control" href="#homepropertyslider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
    </a>    
</div>