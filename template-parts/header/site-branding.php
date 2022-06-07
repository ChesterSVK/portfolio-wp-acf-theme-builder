<?php
/**
 * Displays header site branding
 *
 *
 * @package progresio
 */


$logo_width = get_field('logo_width', 'options') ?: '84';
$logo_height = get_field('logo_height', 'options') ?: '66';
$logo = get_field('logo', 'options') ?: THEME_ASSETS_DIR_URI . '/icons/logo-w.svg';
$logo_retina = get_field('logo_retina', 'options') ?: THEME_ASSETS_DIR_URI . '/icons/logo-w.svg';
?>

<!-- BEGIN SITE BRANDING -->

<a href="<?php echo esc_url(home_url()); ?>" class="uk-navbar-item uk-logo" title="<?php bloginfo('name'); ?>">
    <img id="site-logo"
         width="<?= $logo_width; ?>"
         height="<?= $logo_height; ?>"
         src="<?= $logo; ?>"
         alt="<?php bloginfo('name'); ?>"/>
    <img id="site-logo-retina"
         width="<?= $logo_width; ?>"
         height="<?= $logo_height; ?>"
         src="<?= $logo_retina; ?>"
         alt="<?php bloginfo('name'); ?>"/>
</a>
<!-- END SITE BRANDING -->
