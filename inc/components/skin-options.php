<?php
/**
 * Skin
 */

function theme_skin()
{

    $styles = get_inline_theme_root_styles();

    ?>
    <style>
        <?= $styles;?>
    </style>
    <?php
}

add_action('wp_head', 'theme_skin', 10);
