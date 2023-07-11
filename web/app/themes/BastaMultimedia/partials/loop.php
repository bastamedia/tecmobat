<?php
$args = array( 'numberposts' => 10, 'order'=> 'DESC', 'orderby' => 'date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?>
    <a class="bs-inner-news" href="<?= get_post_permalink(); ?>">
        <span style="background: url(<?= the_post_thumbnail_url(); ?>) center no-repeat; background-size: cover; background-color: rgba(0,75,92,0.8);"></span>
        <div class="bs-info-news">
            <h4><?php the_title(); ?></h4>
            <p><?php the_excerpt(); ?></p>
        </div>
    </a>
<?php endforeach; ?>
