<?php

// Property category
class Cityestate_property_taxonomies extends WP_Widget {
    // Define construct
    public function __construct() {
        parent::__construct(
            'Cityestate_property_taxonomies',
            esc_html__( 'Cityestate: Property Taxonomies', 'cityestate' ),
            array( 'classname' => 'widget-categories', 'description' => esc_html__( 'Show property type, status, features, cities, states', 'cityestate' ), )
        );
    }

    public function widget( $args, $instance ){
        // Define global variable
        global $before_title, $after_title, $post;
        
        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'] );
        
        // Get category title and found
        $property_taxonomy  = $instance['taxonomy'];
        $taxonomy_count     = $instance['taxonomy_count'];        

        // Category found
        if( $taxonomy_count == 'yes' ){ 
            $show_count = true; 
        } else { 
            $show_count = false; 
        }

        echo '<div class="widget widget-property-status">';
        
        // Check title is set
        if( !isset($title) ) 
            $title='';

        if( !empty($title) )
            echo $before_title.esc_html($title).$after_title;

        echo '
            <div class="widget-body">
                <ul class="children">';
                    cityestate_get_property_taxonomies( $property_taxonomy, $show_count );
        echo '
                </ul>
            </div>
        </div>';        
    }


    public function update( $new_instance, $old_instance ){
        // Get update widget
        $instance = array();
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['taxonomy']       = $new_instance['taxonomy'];
        $instance['taxonomy_count'] = $new_instance['taxonomy_count'];
        return $instance;
    }

    public function form( $instance ) {
        // Category form
        $defaults = array( 'title' => '', 'taxonomy' => 'property_type', 'taxonomy_count' => 'yes', 'taxonomy_child' => 'no' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <!-- Widget title -->
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cityestate' ); ?></label>
            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_html_e( 'Taxonomy', 'cityestate' ); ?>
                <!-- Select category -->
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>">
                    <option value="property_type" <?php echo ($instance['taxonomy'] == 'property_type') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Property Type', 'cityestate' ); ?></option>
                    <option value="property_status" <?php echo ($instance['taxonomy'] == 'property_status') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Property Status', 'cityestate' ); ?></option>
                    <option value="property_area" <?php echo ($instance['taxonomy'] == 'property_area') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Property Area', 'cityestate' ); ?></option>
                    <option value="property_city" <?php echo ($instance['taxonomy'] == 'property_city') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Property City', 'cityestate' ); ?></option>                    
                    <option value="property_location" <?php echo ($instance['taxonomy'] == 'property_location') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Property State / Country', 'cityestate' ); ?></option>
                </select>
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy_count' ) ); ?>"><?php esc_html_e( 'Count', 'cityestate' ); ?>
                <!-- Show count property -->
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy_count' ) ); ?>">
                    <option value="yes" <?php echo ($instance['taxonomy_count'] == 'yes') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Show Count', 'cityestate' ); ?></option>
                    <option value="no" <?php echo ($instance['taxonomy_count'] == 'no') ? ' selected="selected"' : ''; ?>><?php esc_html_e( 'Hide Count', 'cityestate' ); ?></option>
                </select>
            </label>
        </p><?php
    }
}

if( ! function_exists( 'Cityestate_property_taxonomies_loader' ) ){
    // Call property category widget
    function Cityestate_property_taxonomies_loader (){
        register_widget( 'Cityestate_property_taxonomies' );
    }    
    add_action( 'widgets_init', 'Cityestate_property_taxonomies_loader' );

}

// List property category
function cityestate_get_property_taxonomies( $taxonomy, $show_count ){
    // Get category
    $terms = get_terms( $taxonomy , array( 'parent' => 0, 'hide_empty' => true ) );
    
    $count = count($terms);
    // Check category is found
    if( $count > 0 ){
        cityestate_hierarchical_property( $terms, $taxonomy, $show_count );
    }
}

// List property category hierarchical
function cityestate_hierarchical_property( $terms, $taxonomy, $show_count ){    
    // Get category
    $count = count( $terms );    
    if( $count > 0 ){        
        foreach( $terms as $term ){            
            // List child category
            echo '<li><a href="' . esc_url( get_term_link( $term->slug, $term->taxonomy ) ). '">' . esc_attr( $term->name ) . '</a>';            
            if( $show_count ){
                echo '<span class="cat-count"> (' . esc_attr( $term->count ) . ') </span>';
            }            
            echo '</li>';
        }
    }
}