<?php

/*
Template Name: Home Template
*/

get_header(); ?>

<div class="content">
    <?php
    $blocks = parse_blocks(get_the_content());
    $modifiedBlocks = array();

    foreach ($blocks as $block) {
        if ($block['blockName'] === "core/cover") {
            if ($block["attrs"]["url"]) {
                echo '<img class="object-cover" src="' . $block["attrs"]["url"]  .  '" />';
            }
            $modifiedBlocks[] = $block;
        } elseif ($block['blockName']=== 'core/group') {
            $modifiedBlocks[] = $block;
        } else {
            $modifiedBlocks[] = $block;
        }
    }

    foreach ($modifiedBlocks as $modifiedBlock) {
        echo render_block($modifiedBlock);
    }
    ?>
</div>

<?php get_footer();
