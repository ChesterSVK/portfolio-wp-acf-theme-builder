<?php


/**
 * Enqueue styles.
 */
function theme_stylesheets()
{
    // Web fonts
//    wp_enqueue_style('theme-fonts', glitche_fonts_url(), array(), null);
    /*Styles*/
    wp_enqueue_style('uikit-style', THEME_ASSETS_DIR_URI . '/styles/libs/uikit-3.14/uikit' . get_asset_suffix('css'), [], '3.14.1');
    /*Styles*/
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style' . get_asset_suffix('css'), ['uikit-style'], THEME_VERSION);

    if (is_rtl()) {
        wp_enqueue_style('theme-style-rtl', THEME_ASSETS_DIR_URI . '/styles/rtl' . get_asset_suffix('css'), array(), '1.0.0', 'screen');
    }
}

/**
 * Enqueue uikit and other styles in admin editors
 */
function uikit_styles()
{
    $screen = get_current_screen();
    if ( $screen->post_type != 'acf-field-group' ) {
        wp_enqueue_style('uikit-style', THEME_ASSETS_DIR_URI . '/styles/libs/uikit-3.14/uikit' . get_asset_suffix('css'), [], '3.14.1');
        wp_add_inline_style('uikit-style', get_inline_theme_root_styles());
    }
}


add_action('wp_enqueue_scripts', 'theme_stylesheets');
add_action('admin_print_scripts', 'uikit_styles');


/**
 * Enqueue scripts
 *
 * @return void
 */
function theme_scripts()
{

    wp_enqueue_script('uikit-script', THEME_ASSETS_DIR_URI . '/js/libs/uikit-3.14.1/uikit' . get_asset_suffix('js'), ['jquery'], '3.14.1', true);
    wp_enqueue_script('theme-main', THEME_ASSETS_DIR_URI . '/js/jquery-effects' . get_asset_suffix('js'), ['jquery'], THEME_VERSION, true);


//    wp_enqueue_script('theme-skip-link-focus', THEME_ASSETS_DIR_URI . '/js/skip-link-focus-fix' . get_asset_suffix('js'), [], THEME_VERSION, true);
//    wp_enqueue_script(THEME_MODULES_EFFECTS_ID, THEME_ASSETS_DIR_URI . '/js/dist/main' . (WP_APPLICATION_STATE == WP_APPLICATION_STATE_PROD ? '.min' : '') . '.js', ['jquery'], THEME_VERSION, true);
//    wp_localize_script( THEME_MODULES_EFFECTS_ID, 'theme_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

function uikit_scripts()
{
    $screen = get_current_screen();
    if ( $screen->post_type != 'acf-field-group' ) {
        wp_enqueue_script('uikit-script', THEME_ASSETS_DIR_URI . '/js/libs/uikit-3.14.1/uikit' . get_asset_suffix('js'), ['jquery'], '3.14.1', true);
    }
}

add_action('wp_enqueue_scripts', 'theme_scripts');
add_action('admin_enqueue_scripts', 'uikit_scripts');
