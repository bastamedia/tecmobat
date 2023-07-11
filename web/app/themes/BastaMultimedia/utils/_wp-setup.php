<?php
register_nav_menus(array(
    'menu-principal' => 'Menu principal',
    'footer' => 'Footer',
));

function basta_setup() {
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'basta_setup' );
add_theme_support('post-thumbnails');

function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 80,
        'width'                => 80,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false,
    );

    add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

add_theme_support( 'custom-spacing' );

// Limite l'extrait à 20 mots
add_filter( 'excerpt_length', function () {
    return 15;
}, 999 );
