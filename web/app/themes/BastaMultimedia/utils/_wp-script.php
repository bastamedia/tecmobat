<?php

function wpdocs_theme_name_scripts() {
    wp_register_style('main-style', get_template_directory_uri().'/style.css', array(), true);
    wp_enqueue_script('style_script', get_template_directory_uri().'/src/js/style.js', array('jquery'), 1.1, true );
    wp_enqueue_style('main-style');
}

function myphpinformation_scripts() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/src/js/jquery-3.6.0.min.js', false);
    wp_register_script('jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.4.1.js', false);
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-migrate');
}
add_action( 'wp_enqueue_scripts', 'myphpinformation_scripts' );
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
