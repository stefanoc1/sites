<?php 
// Get theme labels
global $theme_labels; ?>

<!-- Agent section title -->
<h3><?php echo esc_html($theme_labels['sub_prop_main_agent_title']); ?></h3>

<!-- Agent section info -->
<p><?php echo esc_html($theme_labels['sub_prop_agent_sub_title']); ?></p>

<!-- Show agent type -->
<label><input value="author_info" type="radio" class="rwmb-radio" name="property_agent_display" checked="checked"><?php echo esc_html($theme_labels['sub_prop_author_info']); ?></label>
<label><input value="agent_info" type="radio" class="rwmb-radio" name="property_agent_display"><?php echo esc_html($theme_labels['sub_prop_agent_info']); ?></label>
<label><input value="none" type="radio" class="rwmb-radio" name="property_agent_display"><?php echo esc_html($theme_labels['sub_prop_hide_info_box']); ?></label>

<!-- Show agents -->
<select name="agents" class="selectpicker" data-live-search="false" data-live-search-style="begins">
    <option value="-1"><?php esc_html_e( 'None', 'cityestate' ); ?></option><?php
    // List agents
    $agents_posts = get_posts( array( 'post_type' => 'cityestate_agent', 'posts_per_page' => -1, 'suppress_filters' => 0 ) );
    if( !empty($agents_posts) ){
        foreach ($agents_posts as $agent_post) {
            echo '<option value="'.$agent_post->ID.'">'.$agent_post->post_title.'</option>';
        }
    } ?>
</select>