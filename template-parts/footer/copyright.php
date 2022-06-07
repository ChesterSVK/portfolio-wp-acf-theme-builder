<?php
$copyright = get_field('copyright', 'options');
$copyright_align = get_field('copyright_align', 'options') ?: 'uk-text-center';
$copyright_color = get_field('copyright_color', 'options') ?: false;
$copyright_padding = get_field('copyright_padding', 'options') ?: 'uk-padding';
$copyright_bg = get_field('copyright_background', 'options') ?: false;
$footer_container_with = get_field('footer_container_width', 'options');

if ($copyright) {
    ?>
    <div class="copyright-container <?= $footer_container_with; ?>" <?= ($copyright_bg ? 'style="background-color: ' . $copyright_bg . '"' : '')?>>
        <div class="uk-container <?= $footer_container_with; ?>">
            <div class="<?= $copyright_padding; ?>">
                <p class="uk-margin-remove <?= $copyright_align; ?>" style="<?= ($copyright_color) ? 'color: ' . $copyright_color : ''; ?>"><?= date('Y'); ?> <?= $copyright; ?></p>
            </div>
        </div>
    </div>
    <?php
}
?>