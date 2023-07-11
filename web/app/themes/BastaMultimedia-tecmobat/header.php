<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
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
if (is_home()){$class='blog';}
elseif (is_front_page()){$class='home';}
elseif (is_404()){$class='404';}
else{$class = $post -> post_name;}
?>
<body class="<?= $class; ?>">
<div class="loader">
    <div class="hourglass"></div>
</div>
<header>
    <nav>
        <?php the_custom_logo() ?>
        <?php wp_nav_menu(array('theme_location' => 'menu-principal')); ?>
        <img class="menu-burger" src="/wp-content/uploads/2023/03/menu-burger-tec.svg" alt="MENU" width="30">
    </nav>
</header>
