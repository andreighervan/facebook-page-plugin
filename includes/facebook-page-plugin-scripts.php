<?php
function fpp_add_scripts(){
    wp_enqueue_style('fpp-main-style',plugins_url().'/facebook-page-plugin/css/style.css');
    wp_enqueue_script('fpp-main-script',plugins_url().'/facebook-page-plugin/js/main.js');
}
add_action('wp_enqueue_scripts','fpp_add_scripts');
