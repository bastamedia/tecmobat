<?php get_header(); ?>

<div class="bs-single-banner" style="background: url(<?= get_the_post_thumbnail_url() ?>) no-repeat center">
    <h2><?php the_title(); ?></h2>
    <span class="opacity-controller"></span>
</div>

<section class="container-large has-large-margin">
    <?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="yoast-breadcrumbs">','</div>' );
    }
    ?>
</section>

<section class="container-large has-large-margin">
    <div class="bs-single-columns">
        <div class="bs-single-column">
            <aside class="bs-aside">
                <h3>Dans cet article</h3>
            </aside>
        </div>
        <div class="bs-single-column in-full-size single-content">
            <?php the_content() ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>


