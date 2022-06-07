<?php
/**
 * Template Name: THEME Guttenberg builder
 *
 * @package progresio
*/

get_header();


if (have_posts()){
	/* Start the Loop */
	while (have_posts()) :
		the_post();

		the_content();
	endwhile;
}

get_sidebar();
get_footer();