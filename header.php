<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package progresio
 */


get_template_part('template-parts/header/header', 'main');


if (!is_single()) {
    $container_with = get_field('page_container_size');
    if (!$container_with) {
        // Get from global settings
        $container_with = get_field('page_container_size', 'options');
    }
} else {
    $container_with = get_field('post_container_size', 'options');
}

?>
<!-- BEGIN CONTAINER -->
<div class="uk-container <?= $container_with; ?>">
