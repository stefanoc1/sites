<?php
class CityEstate_User_Login_Register {

	// Cityestate class constructor
    public function __construct() {
        
        // Cityestate call constants function
        $this->cityestate_login_constant();
    	
        // Cityestate call include files function
        $this->cityestate_include_files();        
    }

    // Define constants
    protected function cityestate_login_constant(){
        define( 'CITYESTATE_LOGIN_PATH', plugin_dir_path( __FILE__ ) );
    }

    // Cityestate user login and register include files
    function cityestate_include_files(){
        // Login using wordpress
        require_once( get_template_directory() . '/inc/cityestate/frame-work/login-register/login_user.php' );

        // Register using wordpress
        require_once( get_template_directory() . '/inc/cityestate/frame-work/login-register/register_user.php' ); 

        // Register using wordpress
        require_once( get_template_directory() . '/inc/cityestate/frame-work/login-register/reset_password.php' );        
    }
}

$CityEstate_User_Login_Register = new CityEstate_User_Login_Register();

?>