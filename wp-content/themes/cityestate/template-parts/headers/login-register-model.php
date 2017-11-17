<!-- Login or register modal -->
<div class="modal fade" id="ce-login-model" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login_modal_tabs">
                    <!-- Login tab -->
                    <li class="active"><?php esc_html_e( 'Login', 'cityestate' ); ?></li>
                    <!-- Register tab -->
                    <li><?php esc_html_e( 'Register', 'cityestate' ); ?></li>
                </ul>
                <!-- Close modal button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body user_login_area">
                <!-- Allowe html tag array -->
                <?php $allowe_html = array( 'a' => array( 'href' => array(), 'title' => array() ) ); ?>
                <div class="tab-content">
                    <div class="tab-pane fade in active">
                        <div id="login_register_msg" class="login_register_msg message"></div>
                        <!-- Login form -->
                        <form>
                            <div class="form-group field-group">
                                <div class="input-user input-icon">
                                    <!-- Username field -->
                                    <input id="login_username" name="username" placeholder="<?php esc_html_e( 'Username','cityestate' ); ?>" type="text" />
                                </div>
                                <div class="input-pass input-icon">
                                    <!-- Password field -->
                                    <input id="password" name="userpassword" placeholder="<?php esc_html_e( 'Password','cityestate' ); ?>" type="password" />
                                </div>
                            </div>
                            <div class="forget-block clearfix">
                                <div class="form-group pull-left">
                                    <div class="checkbox">
                                        <label>
                                            <!-- Remember me option -->
                                            <input name="remember" id="remember" type="checkbox">
                                            <?php esc_html_e( 'Remember me', 'cityestate' ); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group pull-right">
                                    <!-- Reset password link -->
                                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#reset_passowrd"><?php esc_html_e( 'Lost your password?', 'cityestate' ); ?></a>
                                </div>
                            </div>
                            <!-- Login user security -->
                            <?php wp_nonce_field( 'cityestate_login_nonce', 'cityestate_login_security' ); ?>
                            <input type="hidden" name="action" id="login_action" value="cityestate_login">
                            <button type="submit" class="user_login_link btn btn-primary btn-block"><?php esc_html_e( 'Login', 'cityestate' ); ?></button>
                        </form><?php 
                        // User can login with facebook
                        $login_with_facebook = cityestate_option( 'user_login_with_facebook' );
                        // User can login with yahoo
                        $login_with_yahoo = cityestate_option( 'user_login_with_yahoo' );
                        // User can login with google
                        $login_with_google = cityestate_option( 'user_login_with_google' );
                        // Check social media login is active
                        if( $login_with_facebook != 'no' || $login_with_google != 'no' || $login_with_yahoo != 'no' ) { ?>
                            <hr>
                            <!-- User login with facebook -->
                            <?php if( $login_with_facebook != 'no' ){ ?>
                                <button class="login_with_facebook btn btn-social btn-bg-facebook btn-block"><i class="fa fa-facebook"></i> <?php esc_html_e( 'login with facebook', 'cityestate' ); ?></button>
                            <?php } ?>
                            <!-- User login with google -->
                            <?php if( $login_with_google != 'no' ){ ?>
                                <button class="login_with_google btn btn-social btn-bg-google-plus btn-block"><i class="fa fa-google-plus"></i> <?php esc_html_e( 'login with google', 'cityestate' ); ?></button>
                            <?php } ?>
                            <!-- User login with yahoo -->
                            <?php if( $login_with_yahoo != 'no' ){ ?>
                                <button class="login_with_yahoo btn btn-social btn-bg-yahoo btn-block"><i class="fa fa-yahoo"></i> <?php esc_html_e( 'login with yahoo', 'cityestate' ); ?></button>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <div class="tab-pane fade">
                        <!-- Check user can register -->
                        <?php if( cityestate_option('register_user_as_agent') ) { ?>
                        <div id="login_register_msg_register" class="login_register_msg_register message"></div>
                        <form>
                            <div class="form-group field-group">
                                <div class="input-user input-icon">
                                    <!-- Username field -->
                                    <input id="register_username" name="username" type="text" placeholder="<?php esc_html_e('Username','cityestate'); ?>" />
                                </div>
                                <div class="input-email input-icon">
                                    <!-- User email address field -->
                                    <input id="useremail" name="useremail" type="email" placeholder="<?php esc_html_e('Email','cityestate'); ?>" />
                                </div><?php 
                                // Check password auto generate and send via email
                                $create_password = cityestate_option( 'auto_create_password' );
                                if( $create_password == 'yes' ){ ?>
                                    <div class="input-pass input-icon">
                                        <!-- User password field -->
                                        <input id="userpassword" name="userpassword" placeholder="<?php esc_html_e('Password','cityestate'); ?>" type="password" />
                                    </div>
                                    <div class="input-pass input-icon">
                                        <!-- User retype password field -->
                                        <input id="userpassword_re" name="userpassword_re" placeholder="<?php esc_html_e('Retype Password','cityestate'); ?>" type="password" />
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input name="term_condition" id="term_condition" type="checkbox"><?php
                                        // Get terms and condition value
                                        $terms_conditions = cityestate_option( 'register_term_and_condition' );
                                        echo sprintf( wp_kses(__( 'I agree with your <a href="%s">Terms & Conditions</a>', 'cityestate' ), $allowe_html), get_permalink($terms_conditions) ); ?>
                                    </label>
                                </div>
                            </div>
                            <!-- Register user security -->
                            <?php wp_nonce_field( 'cityestate_register_nonce', 'cityestate_register_security' ); ?>
                            <input type="hidden" name="action" value="cityestate_register" id="register_action">
                            <button type="submit" class="user_register_link btn btn-primary btn-block"><?php esc_html_e('Register','cityestate');?></button>
                        </form>
                        <?php } else {
                            // User register disable
                            esc_html_e( 'User registration is disabled in this demo.', 'cityestate' );
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset password modal -->
<div class="modal fade" id="reset_passowrd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login_modal_tabs">
                    <!-- Reset password modal title -->
                    <li class="active"><?php esc_html_e( 'Reset Password', 'cityestate' ); ?></li>
                </ul>
                <!-- Modal close button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body user_login_area">
                <!-- Forgot password info -->
                <p><?php esc_html_e( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'cityestate' ); ?></p>
                <div id="reset_message" class="message"></div>
                <form>
                    <div class="form-group">
                        <div class="input-user input-icon">
                            <!-- Username or email id -->
                            <input name="login_forgot" id="login_forgot" placeholder="<?php esc_html_e( 'Enter your username or email', 'cityestate' ); ?>">
                        </div>
                    </div>
                    <!-- Forgot password security -->
                    <?php wp_nonce_field( 'cityestate_reset_nonce', 'cityestate_reset_security' ); ?>
                    <input type="hidden" name="action" value="cityestate_reset_password" id="cityestate_reset_password">                    
                    <button type="submit" class="btn btn-primary btn-block user_reset_password_link"><?php esc_html_e( 'Get new password', 'cityestate' ); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
