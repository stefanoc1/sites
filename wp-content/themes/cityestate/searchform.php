<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage City_Estate
 * @since City Estate 1.0
 */
?>
<!-- Search form -->
<form method="get" id="searchform" class="form-search-custom" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="input-group">
		<!-- Search input box -->
		<input type="text" name="s" id="s" placeholder="<?php echo esc_html__( 'Search', 'cityestate' ); ?>" class="widget-search-textbox">
		<!-- Search button -->
		<span class="input-group-btn">
        	<button type="submit" class="btn btn-default custom_input widget-search-button"><i class="fa fa-search"></i></button>
    	</span>
	</div>
</form>
