<?php
function portfolioKoenig_enqueue_assets()
{
    // Enqueue styles
    wp_enqueue_style('portfolioKoenig-style', get_stylesheet_uri());
    wp_enqueue_style('index-style', get_template_directory_uri() . '/asset/css/index.css');

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/asset/js/mon_script.js', array('jquery'), '1.0', true);


}

add_action('wp_enqueue_scripts', 'portfolioKoenig_enqueue_assets');


