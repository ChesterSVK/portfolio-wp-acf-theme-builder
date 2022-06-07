<?php

/**
 * Optimize front page function
 */
if (!function_exists('disable_front_page_obsolete_items')){
    function disable_front_page_obsolete_items()
    {
        if (!is_front_page() || !is_home()) return;
        if (is_admin()) return;
    }
}


/**
 * Optimize all pages function
 */
if (!function_exists('disable_global_obsolete_items')){
    function disable_global_obsolete_items()
    {
        if (is_admin()) return;
        wp_dequeue_style('wp-block-library');
        wp_deregister_style('wp-block-library');
        wp_dequeue_style('wc-block-style');
        wp_dequeue_script('wp-embed');
        wp_deregister_script('wp-embed');
        wp_deregister_script('query-monitor');
        echo '<style>#query-monitor-main {display: none;}</style>';
        if (WP_APPLICATION_STATE == WP_APPLICATION_STATE_PROD) {
//        wp_deregister_script('jquery');
//        wp_deregister_script('jquery-core');
//        wp_deregister_script('jquery-migrate');
            wp_dequeue_style('dashicons');
            wp_deregister_style('dashicons');
            wp_deregister_script('hoverintent-js');
        }
    }
}



/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}





// Optimize Font page
if (WP_APPLICATION_STATE == WP_APPLICATION_STATE_PROD) {
    // Optimize front page
    add_action('wp_enqueue_scripts', 'disable_front_page_obsolete_items', 20);
    // Optimize all pages
    add_action('wp_enqueue_scripts', 'disable_global_obsolete_items', 20);
    // Disable Emojis
    add_action( 'init', 'disable_emojis' );
    // Hide admin bar
    add_filter( 'show_admin_bar', '__return_false' );
}

