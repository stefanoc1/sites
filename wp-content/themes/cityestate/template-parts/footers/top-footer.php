<?php 
// Get top footer
$footer_type 	= cityestate_option('cityestate_footer_type'); ?>
<?php if(  is_active_sidebar( 'footer-section-1' ) || is_active_sidebar( 'footer-section-2' ) || is_active_sidebar( 'footer-section-3' ) ||  is_active_sidebar( 'footer-section-4' )) { ?>
	<div class="footer-first">
		<div class="row"><?php
			switch($footer_type){
				// Top footer type 1
				case 1: ?>
					<div class="col-xs-12 col-sm-6 col-md-4"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-4"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-4"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
				<?php break;
				// Top footer type 2
				case 2: ?>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-4' ) ) dynamic_sidebar('footer-section-4'); ?></div>
				<?php break;
				// Top footer type 3
				case 3: ?>
					<div class="col-xs-12 col-sm-6 col-md-6"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
				<?php break;
				// Top footer type 4
				case 4: ?>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-3"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-6"><?php if( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar('footer-section-3'); ?></div>
				<?php break;
				// Top footer type 5
				case 5: ?>
					<div class="col-xs-12 col-sm-6 col-md-6"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
					<div class="col-xs-12 col-sm-6 col-md-6"><?php if( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar('footer-section-2'); ?></div>
				<?php break;
				// Top footer type 6
				case 6: ?>
					<div class="col-xs-12 col-sm-12 col-md-12"><?php if( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar('footer-section-1'); ?></div>
				<?php break;
			} ?>					
		</div>
	</div>
<?php } ?>