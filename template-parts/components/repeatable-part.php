<?php


$pre_footer = get_field('page_pre_footer');
if (is_array($pre_footer) && count($pre_footer)){
    $pre_footer = $pre_footer[0];
}

if (get_field(THEME_ACF_BUILDER_SLUG, $pre_footer)) :
    parse_acf_subfield_components($pre_footer);
endif;

