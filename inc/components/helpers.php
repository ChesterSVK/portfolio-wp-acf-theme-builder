<?php

if (!defined('get_asset_suffix')) {
    function get_asset_suffix($suffix, $state = WP_APPLICATION_STATE_DEV)
    {
        if ($state == WP_APPLICATION_STATE_PROD) {
            return '.min.' . $suffix;
        }
        return '.' . $suffix;
    }
}

if (!function_exists('get_default_thumbnail_url')) {
    function get_default_thumbnail_url()
    {
        return THEME_IMAGES_DIR_URI . '/default.png';
    }
}


/**
 * Gets the output for global theme styles from the ACF Options variables
 *
 * @return HTML
 */
if (!function_exists('get_inline_theme_root_styles')) {
    function get_inline_theme_root_styles()
    {

        $options = [];
        $options['--uikit-primary-color'] = get_field('primary_color', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-primary-color-hover'] = get_field('primary_color_darker', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-primary-color-hover-2'] = get_field('primary_color_hover', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-primary-color-active'] = get_field('primary_color_active', THEME_ACF_OPTIONS_KEY);

        $options['--uikit-secondary-color'] = get_field('secondary_color', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-secondary-color-hover'] = get_field('secondary_color_hover', THEME_ACF_OPTIONS_KEY);
        //    $secondary_color_3 = get_field('secondary_color_hover', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-secondary-color-active'] = get_field('secondary_color_active', THEME_ACF_OPTIONS_KEY);

        $options['--uikit-danger-color'] = get_field('danger_color', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-success-color'] = get_field('success_color', THEME_ACF_OPTIONS_KEY);
        $options['--uikit-warning-color'] = get_field('warning_color', THEME_ACF_OPTIONS_KEY);


        $out = ':root {';

        foreach ($options as $index => $option) {
            $out .= $index . ': ' . $option . ';
            ';
        }
        $out .= '}';

        if (is_admin()) {
            $out .= '.acfe-flexible-placeholder{padding: 15px;}';
        }


        $font_settings = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'anchor', 'span', 'small'];
        foreach ($font_settings as $font_setting) {
            $font_tag = get_field('theme_font_' . $font_setting, THEME_ACF_FONT_OPTIONS_KEY);
            if (!$font_tag || !isset($font_tag) || !is_array($font_tag) || !count($font_tag)) continue;
            $options['--theme-font-' . $font_setting . '-size'] = $font_tag['font_size'] ?: '';
            $options['--theme-font-' . $font_setting . '-line-height'] = $font_tag['line_height'] ?: '';
            $options['--theme-font-' . $font_setting . '-weight'] = $font_tag['font_weight'] ?: '';
            $options['--theme-font-' . $font_setting . '-family'] = $font_tag['font_family'] ? get_post_fonts_titles($font_tag['font_family']) : '';
            $out .= '

' . $font_setting . '{'
            . ($font_tag['font_size'] ? 'font-size: ' . $font_tag['font_size'] . ';' : '')
            . ($font_tag['line_height'] ? 'line-height: ' . $font_tag['line_height'] . ';' : '')
            . ($font_tag['font_weight'] ? 'font-weight: ' . $font_tag['font_weight'] . ';' : '')
            . ($font_tag['font_family'] ? 'font-family: ' . get_post_fonts_titles($font_tag['font_family']) . ';' : '')
                . '}';
        }


        return $out;
    }
}

if (!function_exists('get_post_fonts_titles')) {
    function get_post_fonts_titles($fonts)
    {
        if (!$fonts || !is_array($fonts) || !count($fonts)) return '';

        $font_titles = array_map(function ($font_post){
            if (!$font_post) return '';
            if (!is_object($font_post)) return '';
            return '"' . $font_post->post_title . '"';
        }, $fonts);
        return implode(',', $font_titles) . ', sans-serif';
    }
}


/**
 * Gets the SVG code for a given icon.
 *
 * @param string $group The icon group.
 * @param string $icon The icon.
 * @param int $size The icon size in pixels.
 *
 * @return string
 * @since Twenty Twenty-One 1.0
 *
 */
if (!function_exists('theme_get_icon_svg')) {
    function theme_get_icon_svg($group, $icon, $size = 24)
    {
        return IconBlockTemplate::get_svg($group, $icon, $size);
    }
}


/**
 * Detects the social network from a URL and returns the SVG code for its icon.
 *
 * @param string $uri Social link.
 * @param int $size The icon size in pixels.
 *
 * @return string
 * @since Twenty Twenty-One 1.0
 *
 */
if (!function_exists('theme_get_social_link_svg')) {
    function theme_get_social_link_svg($uri, $size = 24)
    {
        return IconBlockTemplate::get_social_link_svg($uri, $size);
    }
}


function theme_disable_guttenberg(){
    /**
     * Disables the block editor from managing widgets in the Gutenberg plugin.
     */
    //add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
    add_filter('use_block_editor_for_post', '__return_false');

    // Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
    add_filter('use_widgets_block_editor', '__return_false');
}
