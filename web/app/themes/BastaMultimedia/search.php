<?php get_header(); ?>
<?php

echo '<div class="bs-archives-banner"><h2>Votre recherche</h2></div><section class="container-large has-medium-margin bs-search-container">';

get_search_form();

require_once __DIR__ . '/partials/search-loop.php';

echo '</section>';

?>

<?php get_footer(); ?>
