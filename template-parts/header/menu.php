<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$navbar_position = get_field('uk-navbar-position', 'options') ?: 'left';
$navbar_mode = get_field('uk-navbar-mode', 'options') ?: 'hover';
$logo_position = get_field('uk-logo-position', 'options')?: 'left';
$navbar_sticky = get_field('uk-navbar-sticky', 'options')?: false;

$container_with = get_field('header_container_size', 'options') ?: 'uk-container-xlarge';
$bg_color = get_field('header_background_color', 'options');

?>
<!-- BEGIN HEADER -->
<header id="header" role="banner" <?= ($bg_color ? 'style="background-color: ' . $bg_color . '"' : '')?>>
    <div class="uk-container <?= $container_with; ?>">
        <div class="header-menu-desktop" <?= ($navbar_sticky) ? 'uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky"' : ''?>>

            <nav class="" uk-navbar="mode: <?= $navbar_mode;?>" <?= ($navbar_sticky) ? 'style="position: relative; z-index: 980;"' : ''?>>
                <?= ($logo_position == 'left') ? get_template_part('template-parts/header/site-branding') : ''?>
                <div class="uk-navbar-<?=$navbar_position?>">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => 'ul',
                        'container_aria_label' => 'uk-navbar-nav',
                        'menu_class' => 'uk-navbar-nav',
                        'menu_id' => 'uk-navbar-nav-desktop',
                    )); ?>
                </div>
                <?= ($logo_position == 'right') ? get_template_part('template-parts/header/site-branding') : ''?>
            </nav>

        </div>
    </div>

<!--    <div class="header-menu-mobile">-->
<!--        --><?//= get_template_part('template-parts/header/site-branding'); ?>
<!--        --><?php //wp_nav_menu(array(
//            'theme_location' => 'primary',
//            'container' => 'div',
//            'container_class' => 'menu-container',
//            'container_id' => 'menu-container-mobile',
//            'container_aria_label' => 'menu-mobile',
//            'menu_class' => 'menu',
//            'menu_id' => 'menu-mobile',
//        )); ?>
<!--    </div>-->
</header>
<!-- END HEADER -->
