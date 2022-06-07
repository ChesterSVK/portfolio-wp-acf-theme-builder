<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package progresio
 */


?>

<!-- END CONTAINER -->
</div>

<?php

if (get_field('page_pre_footer')){
    get_template_part('template-parts/components/repeatable', 'part');
}
get_template_part('template-parts/footer/footer', 'main');