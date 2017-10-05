<?php
/**
 * Plugin Name:Facebook Page Plugin
 * Description:Widget that displays facebook page
 * Version:1.0
 * Author:Andrei Ghervan
 */
if(!defined('ABSPATH')){
    exit;
}
$ffl_options=get_option('ffl_settings');
//load scripts
require_once(plugin_dir_path(__FILE__).'/includes/facebook-page-plugin-scripts.php');
require_once(plugin_dir_path(__FILE__).'/includes/facebook-page-plugin-class.php');

function register_facebook_page_plugin(){
    register_widget('Facebook_Page_Plugin_Widget');
}

add_action('widgets_init','register_facebook_page_plugin');