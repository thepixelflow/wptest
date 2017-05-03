<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function starter_plugin_register_required_plugins() {

	$plugins = array(
		
		array(
            'name'               => 'Advanced Custom Fields', // The plugin name.
            'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => 'Redux Framework', // The plugin name.
            'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => 'Contact Form 7', // The plugin name.
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => 'Business One Toolkit', // The plugin name.
            'slug'               => 'business-one-toolkit', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 
        array(
            'name'               => 'WP Google Map', // The plugin name.
            'slug'               => 'wp-google-map-plugin', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        )   

        
	);



	$config = array(
		'domain'       		=> 'business',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'plugins.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'plugins.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'starter_plugin_register_required_plugins' );