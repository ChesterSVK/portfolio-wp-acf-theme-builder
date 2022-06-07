<?php

if (is_admin()) return;

function load_theme_fonts()
{
    $fonts = get_posts([
        'numberposts' => -1,
        'post_type' => 'theme-fonts'
    ]);
    if (!$fonts) return;

    $google_fonts = [];

    foreach ($fonts as $font) {
        $type = get_field('type', $font->ID);
        if (!$type) continue;

        $name = get_field('font', $font->ID);
        $weight = get_field('weight', $font->ID);


        switch ($type) {
            case 'google':
                array_push($google_fonts,
                    $name . ($weight ? ':wght@' . $weight : ''));
                break;
            default:
                break;
        }
    }
    if (count($google_fonts)) {
        $string = implode('&family=', $google_fonts);
        echo '
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=' . $string . '&subset=latin,latin-ext&display=swap" rel="stylesheet">
';
    }

}

add_action('wp_head', 'load_theme_fonts');