jQuery(document).ready(function(){
	'use strict';
	var addComment = "";
    // Row animation
	jQuery( '.fc-animate:not(.w-start_animation)' ).waypoint(function() {
		jQuery(this).addClass( 'w-start_animation' );
	}, {
		offset: '70%'
	});

	// Parallax Sections
	jQuery(function(){	
		if( jQuery( '.parallax-sec' ).hasClass( 'page-title-x' ) ){
			jQuery.stellar({ horizontalScrolling: false, responsive: false, hideDistantElements: false, });
		} else {
			jQuery.stellar({ horizontalScrolling: false, responsive: true, hideDistantElements: false, });
		}
	});

	//  Super slider
	jQuery( '.max-hero' ).superslides({
		animation: 'fade'
	});
	
    // Slider text margin
	var sliderTextMarginTop = ( jQuery(window).height() - ( jQuery( 'header' ).height() + jQuery( '.slider_text' ).height() ) ) / 2;
	if( sliderTextMarginTop <= 50 ){
		sliderTextMarginTop = 100;
	}
	
    // Check window width
	if( jQuery(window).width()<=640 ){
		sliderTextMarginTop=0;
	}

    // Slider text margn
	jQuery( '.slider_text' ).css( 'margin-top', sliderTextMarginTop );

    // Check window resize
	jQuery(window).resize(function(){
		
		sliderTextMarginTop = ( jQuery(window).height() - ( jQuery( 'header' ).height() + jQuery( '.slider_text' ).height() ) ) / 2;
		if( sliderTextMarginTop <= 50 ){
			sliderTextMarginTop = 100;
		}

        // Check window width
	    if( jQuery(window).width()<=640 ){
			sliderTextMarginTop=0;
		}

        // Slider text margn
		jQuery( '.slider_text' ).css( 'margin-top', sliderTextMarginTop );
	});

    // Slider text margin
	var sliderTextMarginTop = (jQuery(window).height() - (jQuery( 'header' ).height() + jQuery( '.slider_text_var_2' ).height() ) ) / 2;
	if( sliderTextMarginTop <= 50 ){
		sliderTextMarginTop = 100;
	}
	
	// Check window width
    if( jQuery(window).width()<=640 ){
		sliderTextMarginTop=0;
	}

	// Slider text margn
    jQuery( '.slider_text_var_2' ).css( 'margin-top', sliderTextMarginTop );

	jQuery(window).resize(function(){
		// Slider text margin
        var sliderTextMarginTop = ( jQuery(window).height() - ( jQuery( 'header' ).height() + jQuery( '.slider_text_var_2' ).height() ) ) / 2;
		
		if( sliderTextMarginTop <= 50 ){
			sliderTextMarginTop = 100;
		}

	    // Check window width
        if( jQuery(window).width()<=640 ){
			sliderTextMarginTop=0;
		}
		jQuery( '.slider_text_var_2' ).css( 'margin-top', sliderTextMarginTop );
	});

	// Toggle more filter option
	jQuery( '#more_filter' ).on( 'click', function(){
		jQuery( '#more_filter_options' ).slideToggle();
	});

    // Toggle advance search
	jQuery( '#advance_more_filter' ).on( 'click', function(){
		jQuery( '#advance_more_filter_options' ).slideToggle();
	});	

    // Search label on click
	jQuery( '#search_label' ).on( 'click', function(){
		jQuery( '#search_label_options' ).slideToggle();
        jQuery( '#search_label' ).find( 'i' ).toggleClass( 'glyphicon glyphicon-triangle-bottom' );
        jQuery( '#search_label' ).find( 'i' ).toggleClass( 'glyphicon glyphicon-triangle-top' );
	});
 	//Tool tip bootstrap
	jQuery( '[data-toggle="tooltip"]' ).tooltip();

	// Fit according to screen size
	jQuery( '.banner_fix_screen' ).css( 'height', GetWindowHeight() );

	function GetWindowHeight(){
        return Math.max( jQuery(window).height(), window.innerHeight);
    }

    // Change Grid List     
    jQuery( '.property_view_link' ).on( 'click', function(){
        
        jQuery( '.property_view_link' ).removeClass( 'active' );
        jQuery(this).addClass( 'active' );
        
        // Check property list view
        if( jQuery(this).hasClass( 'property_list_view' ) ){
        	jQuery( '.property_list_grid' ).hide();
            jQuery( '.property_list_list' ).show();
        // Check property grid view
        } else if( jQuery(this).hasClass( 'property_grid_view' ) ){
        	jQuery( '.property_list_list' ).hide();
        	jQuery( '.property_list_grid' ).show();
        }
    });

    // Add class in widgets
    jQuery( '.widget-area .widget .widget-top' ).next().addClass( 'widget-body' );    
    
    // Login and register Tab
    jQuery( '.modal .login_modal_tabs > li' ).on( 'click', function(){
        if( jQuery(this).hasClass( 'active' ) != true ){
            jQuery( '.login_modal_tabs > li' ).removeClass( 'active' );
            jQuery(this).addClass( 'active' );
            jQuery( '.modal .user_login_area .tab-pane' ).removeClass( 'in active' );
            jQuery( '.modal .user_login_area .tab-pane' ).eq(jQuery(this).index()).addClass( 'in active' );
        }
    });

    // Paypal and stripe options
    jQuery( '.choose_payment_type input' ).on( 'change', function(){
        if( jQuery(this).is( ':checked' ) ){
            jQuery( '.choose_payment_option' ).slideUp();
            jQuery(this).parents( '.choose_payment_section' ).next( '.choose_payment_option' ).slideDown();
        } else {
            jQuery( '.choose_payment_option' ).slideUp();
        }
    });

    // Set paypal payment method
    function paypal_option(tag){
        if( jQuery( tag ).attr( 'checked' ) ){
            jQuery( tag ).parents( '.choose_payment_section' ).next( '.choose_payment_option' ).slideDown();
        } else {
            jQuery( tag ).parents( '.choose_payment_section' ).next( '.choose_payment_option' ).slideUp();
        }
    }

    // Set payment method
    paypal_option( '.payment_paypal' );
    paypal_option( '.payment_stripe' );

    jQuery( 'button.stripe_payment_button span' ).prepend( '<i class="fa fa-credit-card"></i>' );
    
    // Single property room dimention
	jQuery( function() {
		jQuery( '#tabs' ).tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
		jQuery( '#tabs li' ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
	});

	// Date picker
    if( jQuery( '.input_date' ).length > 0 ){
        jQuery( '.input_date' ).datepicker( jQuery.datepicker.regional[ 'US' ] );
    }

    // Toggle agent social media
    jQuery(document).on( 'click', '.agent_social_media', function(){
		// Agent social collapsed
        jQuery(this).toggleClass( 'collapsed' );
		// Find agent social
        jQuery(this).parent().find( '.agent-social' ).toggleClass( 'in' );
	});

    // Property search auto completed
    jQuery( '#property_name' ).keyup(function(){
        // Get enter value
        var filter = jQuery(this).val();
        var count = 0;
        jQuery( '.property_list_keyword .item-wrap' ).each(function(){
            if( jQuery(this).text().search( new RegExp( filter, 'i' ) ) < 0 ){
                jQuery(this).fadeOut();                
            } else {
                jQuery(this).show();
                count++;
            }
        });
        jQuery( '.property_list_keyword_search button' ).text(count);
    });

    // Sticky height
    var stickyHight = jQuery( '.sticky' ).height();
	if( jQuery(window).scrollTop() > stickyHight ){
        jQuery( '.sticky' ).addClass( 'sticky-menu' );
    }  else {
        jQuery( '.sticky' ).removeClass( 'sticky-menu' );
    }

    // On scroll menu sticky
    jQuery(window).on( 'scroll', function(){
        if( jQuery(this).scrollTop() > stickyHight ){
            jQuery( '.sticky' ).addClass( 'sticky-menu' );
        }  else {
            jQuery( '.sticky' ).removeClass( 'sticky-menu' );
        }
    });

    // Declare gallery variable
    var imgsrc = '';
    var altertext = '';
    var openedImages = '';
    
    // Open gallery image on click
    jQuery( '.single-galery-inner' ).click(function() {
        // Get element
        openedImages = jQuery(this);
        
        // Get image source
        imgsrc = jQuery(this).parent().find( 'img' ).attr( 'src' );
        imgsrc = imgsrc.replace( '-300x225.jpg', '.jpg' );
        
        // Get alter text
        altertext = jQuery(this).parent().find( 'img' ).attr( 'alt' );
        
        // Next image
        if( jQuery(openedImages).parent().is( ':last-child' ) ){
            jQuery( '.next_image_btn' ).hide();
        } else {
            jQuery( '.next_image_btn' ).show();
        }
        
        // Previous image
        if( jQuery(openedImages).parent().is( ':first-child' ) ){
            jQuery( '.previous_image_btn' ).hide();
        } else {
            jQuery( '.previous_image_btn' ).show();
        }
    });

    // Show gallery image modal
    jQuery( '#image_lightbox' ).on( 'show.bs.modal', function(e) {
        jQuery( '#image_lightbox' ).find( 'img' ).attr( 'src', imgsrc);
        jQuery( '.image_lightbox_label' ).html(altertext);
    });

    // Click on next image
    jQuery( '.next_image_btn' ).click( function(){        
        openedImages = jQuery(openedImages).parent().next();
        
        // Show previous image
        jQuery( '.previous_image_btn' ).show();
        
        // Image last child
        if( jQuery(openedImages).is( ':last-child' ) ){
            jQuery(this).hide();
        } else {
            jQuery(this).show();
        }
        
        // Get image source
        imgsrc = jQuery(openedImages).find( 'img' ).attr( 'src' );
        // Get image alter text
        altertext = jQuery(openedImages).find( 'img' ).attr( 'alt' );
        
        // get image description
        openedImages = jQuery(openedImages).find( '.image_description' );
        
        // Show image on lightbox
        jQuery( '#image_lightbox' ).find( 'img' ).fadeOut( 'slow', function() {
            jQuery( '#image_lightbox' ).find( 'img' ).attr( 'src', imgsrc );
            jQuery( '.image_lightbox_label' ).html(altertext);
            jQuery( '#image_lightbox' ).find( 'img' ).fadeIn( 'slow' );
        });
    });
    
    // Get prebious image on click
    jQuery( '.previous_image_btn' ).click( function(){
        // Show next arrow
        jQuery( '.next_image_btn' ).show();
        
        openedImages = jQuery(openedImages).parent().prev();
        
        // Check first image is available
        if( jQuery(openedImages).is( ':first-child' ) ){
            jQuery(this).hide();
        } else {
            jQuery(this).show();
        }
            
        // Get image source
        imgsrc = jQuery(openedImages).find( 'img' ).attr( 'src' );
        
        // Get image alter text
        altertext = jQuery(openedImages).find( 'img' ).attr( 'alt' );
        
        // Get image description
        openedImages = jQuery(openedImages).find( '.image_description' );
        
        // Show image on lightbox
        jQuery( '#image_lightbox' ).find( 'img' ).fadeOut( 'slow', function(){
            jQuery( '#image_lightbox' ).find( 'img' ).attr( 'src', imgsrc );
            jQuery( '.image_lightbox_label' ).html(altertext);
            jQuery( '#image_lightbox' ).find( 'img' ).fadeIn( 'slow' );
        });
    });
    
    // Set select picker in widget
    jQuery( '.textwidget' ).find( 'select' ).selectpicker();


    jQuery('p').each(function() {
        var $this = jQuery(this);
        if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
            $this.remove();
    });

    //To give smooth scroll effect to the one page menu.
    jQuery(document).on('click', '.menu a', function(event) {
        var target = this.getAttribute('href');
        if(target.charAt(0) == "#") {
            event.preventDefault();
            var top = jQuery(target).offset().top - 150;
            jQuery('html, body').animate({
                scrollTop : top
            }, 2000);
        }
    });

    jQuery(".widget > select").wrap( "<div class='widget-body'></div>" );
});