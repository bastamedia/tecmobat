<?php get_header(); ?>
<div class="bs-archives-banner">
    <h2>Nos derniers articles</h2>
</div>
<section class="container-large archives-container has-medium-margin">
    <div class="bs-outer-news">
        <?php require_once __DIR__ . '/partials/loop.php' ?>
    </div>
</section>
<?php get_footer(); ?>
