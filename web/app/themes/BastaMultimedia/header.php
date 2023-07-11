<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Basta Multimédia">
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
$type = get_post_type();
$home = is_home();
?>

<body>

