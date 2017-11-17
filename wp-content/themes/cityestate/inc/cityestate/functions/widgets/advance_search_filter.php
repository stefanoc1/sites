<?php

// Advance search filter widget
class Cityestate_advanced_search extends WP_Widget {

    public function __construct(){
        // Define construct
        parent::__construct(
            'cityestate_advanced_search',
            esc_html__( 'Cityestate: Advanced Search', 'cityestate' ),
            array( 'description' => esc_html__( 'Advanced Search', 'cityestate' ), )
        );

    }

    public function widget( $args, $instance ){
        // Define global variable
        global $before_title, $after_title, $post;
        extract( $args );
        // Get widget title
        $title = apply_filters('widget_title', $instance['title'] );

        // Get search property template link
        $search_template    = cityestate_find_template_url( 'templates/template_search.php' );
        
        // Get sohw hide field status
        $show_hide_field    = cityestate_option( 'adv_sea_show_hide_fileds' );
        $keyword_search     = cityestate_option( 'adv_sea_keyword_search' );

        // Property search by title
        if( $keyword_search == 'property_title' ){                
            $search_placeholder = esc_html__( 'Enter keyword...', 'cityestate' );
        // Property search by city or state
        } else if( $keyword_search == 'property_city_state' ){            
            $search_placeholder = esc_html__( 'Search City, State or Area', 'cityestate' );
        // Property search by address or zip
        } else {            
            $search_placeholder = esc_html__( 'Enter an address, town, street, or zip', 'cityestate' );
        }

        // Declare variable
        $location = $type = $status = '';

        // Get property type
        if( isset( $_GET['type'] ) ){
            $type = $_GET['type'];
        }

        // Get property status
        if( isset( $_GET['status'] ) ){
            $status = $_GET['status'];
        }
        
        // Get property location
        if( isset( $_GET['location'] ) ){
            $location = $_GET['location'];
        } ?>
        <div class="fliter-widget">
            <div class="filter-header">
                <!-- Widget title -->
                <?php if( $title ) echo $before_title . $title . $after_title; ?>
            </div>
            <div class="filter-widget-body">
                <form class="search-filter-form" method="get" action="<?php echo esc_url( $search_template ); ?>">
                    <div class="search-filter-form">
                        <div class="row">
                            <!-- Property search keyword -->
                            <?php if( $show_hide_field['keyword'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input name="keyword" placeholder="<?php echo esc_attr($search_placeholder); ?>" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" type="text">
                                </div><?php
                            }
                            
                            // Property type
                            if( $show_hide_field['type'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select class="selectpicker" name="type"><?php
                                        echo '<option value="">'.esc_html__( 'All Type', 'cityestate' ).'</option>';
                                        $property_type = get_terms( array( "property_type" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                                        cityestate_category_values('property_type', $property_type, $type ); ?>
                                    </select>
                                </div><?php 
                            } 
                            
                            // Property status
                            if( $show_hide_field['status'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select class="selectpicker" name="status"><?php
                                        echo '<option value="">'.esc_html__( 'All Status', 'cityestate' ).'</option>';
                                        $property_status = get_terms( array( "property_status" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                                        cityestate_category_values('property_status', $property_status, $status ); ?>
                                    </select>                           
                                </div><?php 
                            }
                            
                            // Property location
                            if( $show_hide_field['location'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select class="selectpicker" name="location"><?php
                                        echo '<option value="">'.esc_html__( 'All Location', 'cityestate' ).'</option>';
                                        $property_location = get_terms( array( "property_location" ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
                                        cityestate_category_values('property_location', $property_location, $location ); ?>
                                    </select>                           
                                </div><?php 
                            }
                            
                            // Property bedroom
                            if( $show_hide_field['bedrooms'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select class="selectpicker" name="bedrooms" title="<?php esc_html_e( 'All Bedrooms', 'cityestate' ); ?>">
                                        <option value="all"><?php esc_html_e( 'All Bedrooms', 'cityestate' ); ?></option>
                                        <?php cityestate_search_number_list( 'bedrooms' ); ?>
                                    </select>
                                </div><?php 
                            }
                            
                            // Property bathroom
                            if( $show_hide_field['bathrooms'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select class="selectpicker" name="bathrooms">
                                        <option value="all"><?php esc_html_e( 'All Bathrooms', 'cityestate' ); ?></option>
                                        <?php cityestate_search_number_list( 'bathrooms' ); ?>
                                    </select>
                                </div><?php 
                            }
                            
                            // Property garages
                            if( $show_hide_field['garages'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select class="selectpicker" name="garages">
                                        <option value="all"><?php esc_html_e( 'All Garages', 'cityestate' ); ?></option>
                                        <?php cityestate_search_number_list( 'garages' ); ?>
                                    </select>
                                </div><?php 
                            }
                            
                            // Property price
                            if( $show_hide_field['price_slider'] != 1 ){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="property-price-range"></div>
                                    <input type="text" id="amount" class="amount" name="price" readonly="readonly">
                                    <input type="hidden" id="min_price" class="min_price" name="min_price" value="<?php echo isset ( $_GET['min_price'] ) ? $_GET['min_price'] : ''; ?>">
                                    <input type="hidden" id="max_price" class="max_price" name="max_price" value="<?php echo isset ( $_GET['max_price'] ) ? $_GET['max_price'] : ''; ?>">
                                </div><?php
                            } ?>
                        </div>
                        <!-- Search property button -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button class="submit-filter"><?php esc_html_e( 'Search Now', 'cityestate' ); ?></button>
                        </div>                        
                    </div>
                </form>
            </div>
        </div><?php
    }

    public function update( $new_instance, $old_instance ){

        $instance = array();
        // Update widget title
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;

    }

    public function form( $instance ){

        $defaults = array( 'title' => esc_html__( 'Find Your Home', 'cityestate' ) );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <!-- Widget form -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cityestate' ); ?></label>
            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p><?php
    }

}

if( ! function_exists( 'Cityestate_advanced_search_loader' ) ){
    // Call property search widget
    function Cityestate_advanced_search_loader(){
        register_widget( 'Cityestate_advanced_search' );
    }
    add_action( 'widgets_init', 'Cityestate_advanced_search_loader' );

}