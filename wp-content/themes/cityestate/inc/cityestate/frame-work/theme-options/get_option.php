<?php

// Get theme option
if( ! function_exists( 'cityestate_option' ) ){

	function cityestate_option( $id, $param = false ){

		$cityestate_options = get_option('cityestate_options');
		$result = "";
		if( !empty($cityestate_options[$id]) && $param ){
			$result = $cityestate_options[$id][$param];
		} else if (!empty($cityestate_options[$id])) {
			$result = $cityestate_options[$id];
		}

		return $result;
	}
}

?>