<?php
//changer le logo de l'admin bar
/* Change logo administration bar */
function wphelp_change_admin_logo() {
    echo '
<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
background-image: url(https://bastamultimedia.com/wp-content/uploads/2022/07/PRISE-JAUNE.svg) !important;
background-repeat: no-repeat;
background-position: center;
background-size: contain;
color:rgba(0, 0, 0, 0);
}
#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
background-position: 0 0;
}
</style>
';
}
//hook the header admin output
add_action('wp_before_admin_bar_render', 'wphelp_change_admin_logo');

// Ajouter un widget dans le tableau de bord de WordPress
function wpc_dashboard_widget_function() {

// Saisie du texte entre les guillemets
    echo "
<div>
<h2>Bienvenue sur votre WordPress</h2>
<span>Ce site vous a été créé par <a href='https://bastamultimedia.com' target='_blank'>Basta Multimedia</a></span><br>
<span>Retrouvez l'ensemble de nos actualités sur <a href='https://www.instagram.com/bastamultimedia/' target='_blank'>Instagram</a></span><br>
<span>Ou sur <a href='https://fr.linkedin.com/company/basta-multimedia' target='_blank'>Linkedin</a></span>
</div>
";
}
function wpc_add_dashboard_widgets() {
    wp_add_dashboard_widget('wp_dashboard_widget', 'Informations', 'wpc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

//Style du login
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/src/css/login/login-style.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// Lien du logo de wp-login.php vers la page d'accueil //
function url_logo_personnalise() {
    return 'https://bastamultimedia.com';
}
add_filter( 'login_headerurl', 'url_logo_personnalise' );

function bs_register_newsletter_admin() {
    add_menu_page(
        __( 'Basta Multimédia', 'basta_2022' ),
        'Basta Multimedia',
        'manage_options',
        'bs-multimedia',
        'show_menu_bs',
        'dashicons-groups',
        2
    );
}
add_action( 'admin_menu', 'bs_register_newsletter_admin' );

function show_menu_bs () {
    require_once (get_template_directory(). '/admin/admin-basta.php');
}
