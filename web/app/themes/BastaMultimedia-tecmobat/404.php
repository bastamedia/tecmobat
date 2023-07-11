<?php get_header(); ?>

<h2 class="error-title is-in-full-large">ERREUR 404 | PAGE INTROUVABLE</h2>

<div class="error wp-block-group">
    <img src="/wp-content/uploads/2023/02/404.gif" alt="OUPS">
    <div>
        <h3>Nous sommes désolé nous ne parvenons pas à trouver la page demandée</h3>
        <a href="<?= get_home_url() ?>">Page d'accueil</a>
    </div>
</div>

<?php get_footer(); ?>
