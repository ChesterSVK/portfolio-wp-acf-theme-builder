<?php
/**
 * Template Name: THEME ACF builder
 *
 * @package progresio
 */


get_header();
if (get_field(THEME_ACF_BUILDER_SLUG)) :
    parse_acf_subfield_components();
endif;
get_sidebar();
get_footer();