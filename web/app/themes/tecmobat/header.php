
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Basta Multimédia">
    <title>Tecmobat - Décapage et gommage</title>
    <!-- HTML5 shim et Respond.js pour supporter les éléments HTML5 pour Internet Explorer 8 -->
    <!--[if lt IE 9]>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<?php
$post = get_post();
if (is_home()) {
    $class='blog';
} elseif (is_front_page()) {
    $class='home';
} elseif (is_404()) {
    $class='404';
} else {
    $class = $post -> post_name;
}
?>
<body class="<?= $class; ?>">
<header id="navbar" class="fixed z-10 w-full">
    <div class="relative navbar">
        <div class="flex-1">
            <a href="/">
                LOGO
            </a>
        </div>

        <div class="flex-none">
            <button id="mobile-toggle">
                M
            </button>
        </div>
    </div>

    <?php wp_nav_menu(
        array(
        'container' => 'div',
        'container_id' => 'mobile-menu',
        'container_class' => 'invisible right-0 z-20 fixed',
        'menu_class' => 'p-4 bg-white top-20',
        'theme_location' => 'menu-principal',
        'walker' => new PrimaryMenuMobile(),
        )
    ); ?>
</header>
