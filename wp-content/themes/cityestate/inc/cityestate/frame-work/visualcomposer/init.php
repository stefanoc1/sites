<?php

if( class_exists('WPBakeryVisualComposerAbstract') ){
	
	$path =  get_template_directory() . '/inc/cityestate/frame-work/visualcomposer/';
	
	$files = glob($path . '/shortcodes/*.php');
	
	foreach($files as $file)	
		if( __FILE__ != basename($file) )
			include_once $file;
	
	$files = glob($path . '/setup/*.php');
	
	foreach($files as $file)	
		if( __FILE__ != basename($file) )
			include_once $file;

}