<?php

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if (isMobile()){
    add_filter( 'show_admin_bar', '__return_false' );
    remove_action('init', 'wp_admin_bar_init');
}