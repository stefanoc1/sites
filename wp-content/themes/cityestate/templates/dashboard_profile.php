<?php
/*
    Template Name: Dashboard Profile
*/
// Check user is login
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );
}

get_header();



// Define global variable
global $current_user, $theme_labels;

// Get current user info
wp_get_current_user();
$user_id    = $current_user->ID;
$user_login = $current_user->user_login;

// Get user info
$user_mobile            = get_the_author_meta( 'user_mobile', $user_id );
$user_office            = get_the_author_meta( 'user_office', $user_id );
$first_name             = get_the_author_meta( 'first_name', $user_id );
$last_name              = get_the_author_meta( 'last_name', $user_id );
$description            = get_the_author_meta( 'description', $user_id );
$user_skype_id          = get_the_author_meta( 'user_skype_id', $user_id );
$user_website_url       = get_the_author_meta( 'user_website_url', $user_id );
$user_facebook_link     = get_the_author_meta( 'user_facebook_link', $user_id );
$user_twitter_link      = get_the_author_meta( 'user_twitter_link', $user_id );
$user_email             = get_the_author_meta( 'user_email', $user_id );
$user_position          = get_the_author_meta( 'user_position', $user_id );
$user_linkedin_link     = get_the_author_meta( 'user_linkedin_link', $user_id );
$user_instagram_link    = get_the_author_meta( 'user_instagram_link', $user_id );
$user_pinterest_link    = get_the_author_meta( 'user_pinterest_link', $user_id );
$user_photo             = get_the_author_meta( 'user_custom_image', $user_id );
$picture_id             = get_the_author_meta( 'author_picture_id', $user_id );

// Check user photo is empty
if( $user_photo == '' ){
    // Set default user photo
    $user_photo = get_template_directory_uri().'/images/placeholder.jpg';
} ?>

<section>
    <!-- Add user dashboard menu -->
    <?php get_template_part( 'template-parts/dashboard_menu'); ?>
    <div class="vertical-space-60"></div>
    <div class="container">
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div id="profile_message"></div>
                <div class="invoice-container">
                    <!-- Add user name -->
                    <h3 class="title"><?php echo esc_html($theme_labels['welcome_back'] ).', '. esc_attr( $user_login ) . '!'; ?></h3>
                    <div class="row">
                        <form name="update_user_profile" id="update_user_profile" class="update_user_profile" method="post">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="profile-image">
                                    <div id="user-profile-img">
                                        <div class="user-profile-image"><?php
                                            // Show user photo
                                            if( !empty( $picture_id ) ){
                                                $picture_id = intval( $picture_id );
                                                if( $picture_id ){
                                                    // Add user photo
                                                    echo wp_get_attachment_image( $picture_id, array( 320, 280 ) );
                                                    echo '<input type="hidden" class="user_profile_image" id="user_profile_image" name="user_profile_image" value="' . esc_attr( $picture_id ).'" />';
                                                }
                                            } else {
                                                // Show user default photo
                                                print '<img id="profile-image" src="'.esc_url( $user_photo ).'" alt="'.$first_name.'" >';
                                            } ?>
                                        </div>
                                    </div>
                                    <!-- User photo uploader elements -->
                                    <div class="profile-img-controls">
                                        <div id="errors-log"></div>
                                        <div id="plupload-container"></div>
                                    </div>
                                    <!-- Upload user photo button -->
                                    <button id="user-profile-image" class="upload-profile-image-btn"><?php echo esc_html($theme_labels['update_profile']); ?></button>
                                </div>
                                <!-- User photo dimension related info -->
                                <p><?php echo esc_html($theme_labels['minimum_image']); ?></p>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <div class="row">
                                    <!-- User first name field -->
                                    <div class="col-xs-12 col-sm-6 co-md-6">
                                        <input type="text" name="first_name" id="first_name" placeholder="<?php esc_html_e( 'First Name', 'cityestate' ); ?>" value="<?php echo esc_attr( $first_name ); ?>" placeholder="<?php esc_html_e( 'First Name', 'cityestate' ); ?>">
                                    </div>
                                    
                                    <!-- User last name field -->
                                    <div class="col-xs-12 col-sm-6 co-md-6 padding-left-none">
                                        <input type="text" name="last_name" id="last_name" placeholder="<?php esc_html_e( 'Last Name', 'cityestate' ); ?>" value="<?php echo esc_attr( $last_name ); ?>">
                                    </div>
                                </div>                            
                                
                                <!-- User email address field -->
                                <input type="text" id="user_email" name="user_email" placeholder="<?php esc_html_e( 'Email', 'cityestate' ); ?>" value="<?php echo esc_attr( $user_email ); ?>">
                                
                                <!-- User office number field -->
                                <input type="text" id="user_office" name="user_office" placeholder="<?php esc_html_e( 'Phone', 'cityestate' ); ?>" value="<?php echo esc_attr( $user_office ); ?>" >
                                
                                <!-- User mobile number field -->
                                <input type="text" id="user_mobile" name="user_mobile" placeholder="<?php esc_html_e( 'Mobile', 'cityestate' ); ?>" value="<?php echo esc_attr( $user_mobile ); ?>">
                                
                                <!-- User skype id field -->
                                <input type="text" id="user_skype_id" name="user_skype_id" placeholder="<?php esc_html_e( 'Skype', 'cityestate' ); ?>" value="<?php echo esc_attr( $user_skype_id ); ?>">                                    
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7 co-md-7">
                                        <!-- User facebook social media field -->
                                        <input type="text" id="user_facebook_link"  name="user_facebook_link" placeholder="<?php esc_html_e( 'Facebook Url', 'cityestate' ); ?>" value="<?php echo esc_url( $user_facebook_link ); ?>" >
                                        
                                        <!-- User twitter social media field -->
                                        <input type="text" id="user_twitter_link" name="user_twitter_link" placeholder="<?php esc_html_e( 'Twitter Url', 'cityestate' ); ?>" value="<?php echo esc_url( $user_twitter_link ); ?>">
                                        
                                        <!-- User linkedin social media field -->
                                        <input type="text" id="user_linkedin_link" name="user_linkedin_link" placeholder="<?php esc_html_e( 'Linkedin Url', 'cityestate' ); ?>" value="<?php echo esc_url( $user_linkedin_link ); ?>">
                                        
                                        <!-- User pinterest social media field -->
                                        <input type="text" id="user_pinterest_link" name="user_pinterest_link" placeholder="<?php esc_html_e( 'Pinterest Url', 'cityestate' ); ?>" value="<?php echo esc_url( $user_pinterest_link ); ?>">
                                        
                                        <!-- User website url field -->
                                        <input type="text" id="user_website_url" name="user_website_url" placeholder="<?php esc_html_e( 'Website Url', 'cityestate' ); ?>" value="<?php echo esc_url($user_website_url); ?>">                                    
                                    </div>
                                    <div class="col-xs-12 col-sm-5 co-md-5 padding-left-none">
                                        <!-- User title or position field -->
                                        <input type="text" id="user_position" name="user_position" placeholder="<?php esc_html_e( 'Title/Position', 'cityestate' ); ?>" value="<?php echo esc_attr( $user_position ); ?>" >                            
                                        
                                        <!-- User about field -->
                                        <textarea id="description" name="description" rows="7" placeholder="<?php esc_html_e( 'About Me', 'cityestate' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
                                    </div>
                                </div>
                                <!-- User profile update security -->
                                <?php wp_nonce_field( 'cityestate_profile_nonce', 'cityestate_profile_security' ); ?>
                                <!-- Update profile button -->
                                <input type="submit" value="<?php esc_html_e( 'update profile', 'cityestate' ); ?>" class="one-line profile">
                                <!-- Show user profile update status -->
                                <p class="status"></p>                                
                            </div>
                        </form>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
                        <!-- User change password area -->
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <hr/>
                            <!-- User change password info -->
                            <h2 class="change-password"><?php esc_html_e( 'Change Password', 'cityestate' ); ?></h2>
                            <p><?php esc_html_e( '*After you change the password you will have to login again.', 'cityestate' ); ?></p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <form name="change_password" class="change_password" id="change_password" method="post">
                                        <!-- User old password field -->
                                        <input  id="old_password" value="" placeholder="<?php esc_html_e( 'Old Password', 'cityestate' ); ?>" name="old_password" type="password">
                                        
                                        <!-- User new password field -->
                                        <input  id="new_password" value="" placeholder="<?php esc_html_e( 'New Password ', 'cityestate' ); ?>" name="new_password" type="password">
                                        
                                        <!-- User confirm password field -->
                                        <input id="confirm_password" value="" placeholder="<?php esc_html_e( 'Confirm New Password', 'cityestate' ); ?>" name="confirm_password" type="password">
                                        
                                        <!-- User change password security -->
                                        <?php wp_nonce_field( 'cityestate_password_nonce', 'cityestate_security_password' ); ?>                                        
                                        <!-- User change password button -->
                                        <input type="submit" class="one-line profile" id="cityestate_change_password" value="<?php echo esc_html__( 'Update Password', 'cityestate' ); ?>">
                                        <!-- Show user password update status -->
                                        <p class="change_password"></p>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
    </div>    
    <div class="vertical-space-100"></div>
    <div class="vertical-space-100"></div>
</section>

<?php get_footer(); ?>