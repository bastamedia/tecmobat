<?php
/**
 * * activation theme
 **/
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

function wpdocs_theme_child_scripts()
{
    wp_register_style('main-child-style', get_stylesheet_directory_uri().'/style.css', array(), true);
    wp_register_style('font-style', get_stylesheet_directory_uri().'/fonts/stylesheet.css', array(), true);
    wp_register_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css', array(), true);
    wp_enqueue_script('style_child_script', get_stylesheet_directory_uri().'/js/style.js', array('jquery'), 1.1, true);
    wp_enqueue_script('loader_script', get_stylesheet_directory_uri().'/js/preloader.js', array(), 1.1, true);
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array(), 1.1, true);
    wp_enqueue_script('touch-swipe', get_stylesheet_directory_uri().'/js/jquery.touchSwipe.min.js', array(), 1.1, true);
    wp_enqueue_style('main-child-style');
    wp_enqueue_style('font-style');
    wp_enqueue_style('swiper-style');
}

add_action('wp_enqueue_scripts', 'wpdocs_theme_child_scripts');

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

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');
