<?php

/*
	Template Name: Dashboard Invoices
*/

// Check user is login
if( !is_user_logged_in() ){
    wp_redirect( home_url());
}

get_header();


// Define global variables
global $current_user, $theme_labels, $invoice_query, $invoice_total;

// Get current user info
wp_get_current_user();
$user_id = $current_user->ID;

ob_start();

// Prepare invoice query
$args = array( 'post_type' => 'cityestate_invoice', 'posts_per_page'=> '-1', 'meta_query' => array( array( 'key' => 'cityestate_inv_buyer', 'value' => $user_id, 'compare' => '=' ) ) );

// Call wp query
$invoice_query = new WP_Query( $args );

$invoice_total = 0;

if( $invoice_query->have_posts() ){
    // Run invoice loop
    while( $invoice_query->have_posts() ) : $invoice_query->the_post();
    	$invoice_meta = cityestate_filter_invoice_data( get_the_ID() );
    	// Add invoice detail
    	get_template_part( 'template-parts/invoices' );
    	$invoice_total += $invoice_meta['inv_price'];    	
    endwhile;
}

// Store invoice info
$invoices_detail = ob_get_contents();

ob_end_clean();

// Reset wo query
wp_reset_postdata(); ?>

<section>
	<!-- Add user dashboard menu -->
	<?php get_template_part( 'template-parts/dashboard_menu'); ?>
	<div class="vertical-space-60"></div>
	<div class="container">
		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<div class="invoice-container">
					<!-- Show dashboard page title -->
					<h3 class="title"><?php $page_title = get_the_title(); echo esc_html($page_title); ?></h3>
					<!-- Invoice filter start date field -->
					<div class="invioce-input-container">
						<input type="text" name="startdate" id="startdate" placeholder="<?php echo esc_attr($theme_labels['start_date']); ?>" class="one-line input_date">
					</div>
					
					<!-- Invoice filter end date field -->
					<div class="invioce-input-container">
						<input type="text" name="enddate" id="enddate" placeholder="<?php echo esc_attr($theme_labels['end_date']); ?>" class="one-line input_date">
					</div>
					
					<!-- Invoice filter invoice type field -->
					<select class="selectpicker" id="invoice_type" data-live-search="false" data-live-search-style="begins">
	                    <option value=""><?php echo esc_html($theme_labels['any']); ?></option>
	                    <option value="Listing"><?php echo esc_html($theme_labels['invoice_listing']); ?></option>
	                    <option value="package"><?php echo esc_html($theme_labels['invoice_package']); ?></option>
	                    <option value="Listing with Featured"><?php echo esc_html($theme_labels['invoice_feat_list']); ?></option>
	                    <option value="Upgrade to Featured"><?php echo esc_html($theme_labels['invoice_upgrade_list']); ?></option>
	                </select>
					
					<!-- Invoice filter paied status field -->
					<select class="selectpicker" id="invoice_status" data-live-search="false" data-live-search-style="begins">
	                    <option value=""><?php echo esc_html($theme_labels['any']); ?></option>
	                    <option value="1"><?php echo esc_html($theme_labels['paid']); ?></option>
	                    <option value="0"><?php echo esc_html($theme_labels['not_paid']); ?></option>
	                </select>
					
					<!-- Find invoice button -->
					<button class="one-line invoice_filter"><?php echo esc_html($theme_labels['invoice_update']); ?></button>
					
					<!-- Show total invoice price -->
					<p class="total-invoice"> <span><?php echo esc_html($theme_labels['invoices_total']); ?></span> <label id="invoices_total_price"><?php echo cityestate_get_invoice_price($invoice_total); ?></label></p>

					<!-- List filtered invoice -->
					<table class="table table-striped">
						<thead>
							<!-- Show invoice table header -->
							<tr>
								<th><?php echo esc_html($theme_labels['invoices_title']); ?></th>
								<th><?php echo esc_html($theme_labels['invoices_date']); ?></th>
								<th><?php echo esc_html($theme_labels['invoices_type']); ?></th>
								<th><?php echo esc_html($theme_labels['invoices_status']); ?></th>
								<th><?php echo esc_html($theme_labels['invoices_price']); ?></th>									
							</tr>
						</thead>
						<tbody id="invoices_content">
							<!-- Show invoice info -->
							<?php echo $invoices_detail; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="vertical-space-100"></div>
			<div class="vertical-space-100"></div>
		</div>
	</div>
</section>
<?php get_footer(); ?>