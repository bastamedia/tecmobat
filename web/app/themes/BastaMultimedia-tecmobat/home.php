<?php get_header(); ?>
<div class="content">
    <span class="home-opacity-controller"></span>
    <div class="bs-home-group wp-block-group">
        <h2 class="main-title"><span class="has-x-large-font-size has-black-color">Pour en savoir plus</span></h2>
        <p>Nous préparons les surfaces et le terrain pour vous laisser accomplir de grandes choses</p>
    </div>

    <div class="archives-container wp-block-group">
        <div class="bs-tcb-outer-news">
            <?php
            $args = array( 'numberposts' => 10, 'order'=> 'DESC', 'orderby' => 'date' );
            $postslist = get_posts( $args );
            foreach ($postslist as $post) :  setup_postdata($post); ?>
                <a class="bs-tcb-inner-news" href="<?= get_post_permalink(); ?>">
                    <span style="background: url(<?= the_post_thumbnail_url(); ?>) center no-repeat; background-size: cover; background-color: rgba(0,75,92,0.8);"></span>
                    <div class="bs-tcb-info-news">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="bs-home-follow-link wp-block-group">
        <a href="https://www.linkedin.com/company/tecmobat/" target="_blank"><img src="/wp-content/uploads/2023/03/linkedinhomeb.png" alt="In"></a>
        <div>
            <h2>Rejoignez-nous sur LinkedIn !</h2>
            <p>Pour avoir encore plus d’actualités sur Tecmobat</p>
        </div>
    </div>
</div>
<?php get_footer(); ?>
