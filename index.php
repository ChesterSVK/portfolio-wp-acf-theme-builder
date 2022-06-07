<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package progresio
 */

get_header();
?>
    <div class="section blog">
        <div class="content">
            <?php if (have_posts()) : ?>
                <div class="title">
                    <div class="title_inner"><?php echo esc_html(get_site_option('name')); ?></div>
                </div>
                <div class="box-items">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        the_content();
                    endwhile;
                    ?>
                </div>

                <div class="pager">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => esc_html__('Prev', THEME_DOMAIN),
                        'next_text' => esc_html__('Next', THEME_DOMAIN),
                    ));
                    ?>
                </div>

            <?php else :
                get_template_part('template-parts/content', 'none');
            endif; ?>

            <div class="clear"></div>
        </div>
    </div>

<?php
get_sidebar();
get_footer();