<?php
/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function theme_add_ie_class() {
    ?>
    <script>
        if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
            document.body.classList.add( 'is-IE' );
        }
    </script>
    <?php
}
add_action( 'wp_footer', 'theme_add_ie_class' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function theme_skip_link_focus_fix() {

    // If SCRIPT_DEBUG is defined and true, print the unminified file.
    if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
        echo '<script>';
        include THEME_ASSETS_DIR . '/js/skip-link-focus-fix' . get_asset_suffix('js');
        echo '</script>';
    }

    // The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
    ?>
    <script>
        /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'theme_skip_link_focus_fix' );
