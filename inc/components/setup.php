<?php

if (!function_exists('theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on glitche, use a find and replace
         * to change 'glitche' to the name of your theme in all the template files.
         */
        load_theme_textdomain(THEME_DOMAIN, THEME_LANG_DIR);

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        add_theme_support('align-wide');


        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'progresio'),
            'top' => esc_html__('Top Small Menu', 'progresio'),
            'secondary' => esc_html__('Footer menu', 'progresio'),
        ));


        /**
         * Add post-formats support.
         */
//        add_theme_support(
//            'post-formats',
//            array(
//				'link',
//				'aside',
//				'gallery',
//				'image',
//				'quote',
//				'status',
//				'video',
//				'audio',
//				'chat',
//            )
//        );


        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Image Sizes
//        add_image_size( 'theme_100x100', 100, 100, true );
//        add_image_size( 'theme_282x232', 282, 232, true );
//        add_image_size( 'theme_282x282', 282, 282, true );
//        add_image_size( 'theme_500x500', 500, 500, true );
//        add_image_size( 'theme_680xAuto', 680, 9999, false );
//        add_image_size( 'theme_680x680', 680, 680, true );
//        add_image_size( 'theme_1920xAuto', 1920, 9999, false );


        // Note, the is_IE global variable is defined by WordPress and is used
        // to detect if the current browser is internet explorer.
        global $is_IE;
        if ($is_IE) {
//			TODO
        }

//        if (WP_WOOCOMMERCE){
//             Add support for woocommerce templates
//            add_theme_support( 'woocommerce' );
//        }
        // Add support for responsive embedded content.
//        add_theme_support( 'responsive-embeds' );

        // Add support for custom line height controls.
//        add_theme_support( 'custom-line-height' );

        // Add support for experimental link color control.
//        add_theme_support( 'experimental-link-color' );

        // Add support for experimental cover block spacing.
//        add_theme_support( 'custom-spacing' );

        // Add support for custom units.
        // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
//        add_theme_support( 'custom-units' );


        switch (WP_ADMIN_BUILDER) {
            case WP_SUPPORTED_BUILDER_ACF:
                theme_disable_guttenberg();
                break;
            case WP_SUPPORTED_BUILDER_GTG:
                break;
            case WP_SUPPORTED_BUILDER_ELEMENTOR:
                theme_disable_guttenberg();
                /**
                 * Enable ACF 5 early access
                 * Requires at least ACF 4.4.12 to work
                 */
                define('ACF_EARLY_ACCESS', 5);
            default:
                break;
        }
    }
endif;
add_action('after_setup_theme', 'theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('glitche_content_width', 900);
}

add_action('after_setup_theme', 'theme_content_width', 0);


//Remove unwanted roles
$wp_roles = new WP_Roles(); // create new role object
$wp_roles->remove_role('translator');
$wp_roles->remove_role('shop_manger');
$wp_roles->remove_role('contributor');



//add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );
//// This will remove the default image sizes and the medium_large size.
//function prefix_remove_default_images( $sizes ) {
//    unset( $sizes['small']); // 150px
//    unset( $sizes['medium']); // 300px
//    unset( $sizes['large']); // 1024px
//    unset( $sizes['medium_large']); // 768px
//    return $sizes;
//}
