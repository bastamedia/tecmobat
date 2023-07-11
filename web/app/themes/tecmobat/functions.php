<?php

require_once(get_template_directory() . '/lib/PrimaryMenuMobile.php');

register_nav_menus(array(
    'menu-principal' => 'Menu principal',
    'footer' => 'Footer',
));


add_action('wp_enqueue_scripts', 'core_enqueue_styles');
function core_enqueue_styles()
{
    wp_enqueue_style('core_css', get_stylesheet_uri(), array(), '1.0');
}

add_action('wp_enqueue_scripts', 'core_enqueue_scripts');
function core_enqueue_scripts()
{
    wp_enqueue_script('core_js', get_template_directory_uri().'/dist/app.js', array(), 1.1, true);
}

add_theme_support(
    'editor-color-palette',
    array(
        array(
            'name'  => 'Rouge',
            'slug'  => 'red',
            'color' => '#E73337',
        ),
        array(
            'name'  => 'Bleu',
            'slug'  => 'blue',
            'color' => '#0056A4',
        ),
        array(
            'name'  => 'Noir',
            'slug'  => 'noir',
            'color' => '#1D1D1B'
        ),
        array(
            'name'  => 'Blanc',
            'slug'  => 'white',
            'color' => '#fff',
        ),
    )
);
