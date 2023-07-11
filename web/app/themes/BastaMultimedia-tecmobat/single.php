<?php get_header(); ?>

<div class="content">
    <div class="wp-block-group articles-group">
        <h2 class="has-x-large-font-size"><?php the_title(); ?></h2>
        <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div class="yoast-breadcrumbs">','</div>' );
        }
        ?>
        <div class="bs-single-columns">
            <div class="bs-single-column">
                <aside class="bs-aside">

                </aside>
            </div>
            <div class="bs-single-column in-full-size single-content">
                <div class="scrollerArticles"><span>⇧</span></div>
                <?php the_content() ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>


