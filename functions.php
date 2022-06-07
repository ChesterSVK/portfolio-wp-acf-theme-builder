<?php
/**
 * Functions and definitions
 *
 * @package progresio
 */

// This number can be incremented to force flush caching plugins and browser caching, version number is appended to assets files
define('THEME_VERSION', '1.0.0');
define('THEME_DIR', get_template_directory());
define('THEME_DIR_URI', get_template_directory_uri());
define('THEME_ASSETS_DIR', THEME_DIR . '/assets');
define('THEME_ASSETS_DIR_URI', THEME_DIR_URI . '/assets');
define('THEME_IMAGES_DIR_URI', THEME_ASSETS_DIR_URI . '/images');
define('THEME_LANG_DIR', THEME_DIR . '/languages');
define('THEME_INC_DIR', THEME_DIR . '/inc');
define('THEME_TEMPLATES_DIR', THEME_DIR . '/template-parts');
define('THEME_TEMPLATES_DIR_URI', THEME_DIR_URI . '/template-parts');
define('THEME_DOMAIN', 'progresio');
define('THEME_ACF_BUILDER_SLUG', 'acf_content_builder');
define('THEME_ACF_OPTIONS_KEY', 'options');
define('THEME_ACF_FONT_OPTIONS_KEY', 'font_options');

// Each module has stylesheet, php file in modules folder and if existing also js file
define('THEME_SUPPORTED_MODULES', ['accordion', 'button', 'icon', 'video']);

/**
 * !!!!!!!!!!!!! Warning Order Dependent
 */

/**
 * HELPERS
 */
require_once THEME_INC_DIR . '/components/helpers.php';

/**
 * IE SUPPORT
 */
include_once THEME_INC_DIR . '/components/ie-support.php';

/**
 * THEME SETUP
 */
require_once THEME_INC_DIR . '/components/setup.php';

/**
 * THEME PLUGINS
 */
require_once THEME_INC_DIR . '/plugins/plugins.php';

/**
 * Widgets
 */
require_once THEME_INC_DIR . '/components/widgets.php';

/**
 * Scripts and styles
 */
require_once THEME_INC_DIR . '/components/scripts-and-styles.php';

/**
 * THEME SKIN OPTIONS
 */
include_once THEME_INC_DIR . '/components/skin-options.php';

/**
 * Required post types
 */
include_once THEME_INC_DIR . '/components/required-post-types.php';

/**
 * Required post types
 */
include_once THEME_INC_DIR . '/components/fonts.php';

/**
 * Shortcodes
 */
//include_once THEME_INC_DIR . '/components/shortcodes.php';

/**
 * Ajax API
 */
//include_once THEME_INC_DIR . '/components/ajax.php';

/**
 * Responsivity
 */
//include_once THEME_INC_DIR . '/components/respo.php';

/**
 * Optimalization
 */
include_once THEME_INC_DIR . '/optimization/global.php';


/**
 * ACF + ACFE settings
 */
include_once THEME_INC_DIR . '/components/acf-settings.php';
