<?php
/**
 * Register widget area.
 *
 * @return void
 */
function theme_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Main Sidebar', THEME_DOMAIN ),
            'id'            => 'main-sidebar',
            'description'   => __( 'TODO', THEME_DOMAIN ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'theme_widgets_init' );
