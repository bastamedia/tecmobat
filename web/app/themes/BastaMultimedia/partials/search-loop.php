<?php

$s=get_search_query();
$args = array(
    's' =>$s
);
// The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    _e("<h3>Resultats pour: ".get_query_var('s')."</h3><ul class='bs-search-result'>");
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        ?>
        <li>
            <a class="bs-inner-news" href="<?= get_post_permalink(); ?>">
                <span style="background: url(<?= the_post_thumbnail_url(); ?>) center no-repeat; background-size: cover; background-color: rgba(0,75,92,0.8);"></span>
                <div class="bs-info-news">
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_excerpt(); ?></p>
                </div>
            </a>
        </li>
        <?php
    }
    _e("</ul>");
}else{
    ?>
    <h3>Nous n'avons rien trouvé</h3>
    <div class="alert alert-info">
        <p>Désolé, mais rien ne correspond à vos critères de recherche. Veuillez réessayer avec d'autres mots-clés.</p>
    </div>
<?php }
