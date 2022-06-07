<?php

function register_theme_shortcodes()
{
    $init_suffix = '_init_shortcode';
    $shortcodes = [];

    foreach ($shortcodes as $shortcode){
        add_shortcode( $shortcode, str_replace('-', '_', $shortcode) . $init_suffix );
    }
}

add_action('init', 'register_theme_shortcodes');