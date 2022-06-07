<?php

global $wp;
global $post;

$main_ogg_name = 'ogg.jpg';
$icons_path = THEME_ASSETS_DIR_URI . '/icons/';
$images_path = THEME_ASSETS_DIR_URI . '/images/';

$ogg = get_field('ogg', 'options');
$favicon_ico = get_field('favicon_ico', 'options');
$favicon_gif = get_field('favicon_gif', 'options');
$favicon_png = get_field('favicon_png', 'options');
$favicon_png_32 = get_field('favicon_png_32', 'options');
$favicon_png_192 = get_field('favicon_png_192', 'options');

add_filter( 'wp_robots', 'wp_theme_robots' );

if (!function_exists('wp_theme_robots')){
    function wp_theme_robots($robots = []) {
        if ( ! get_option( 'blog_public' ) ) {
            return wp_robots_no_robots( $robots );
        }
        array_push($robots, 'index');
        array_push($robots, 'archive');
        array_push($robots, 'follow');
        return $robots;
    }
}

?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Progresio Solutions s.r.o">
<meta property="og:type" content="website"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="1200"/>
<meta property="og:image:height" content="600"/>
<meta property="og:image:alt" content="<?= get_bloginfo('name'); ?>"/>
<meta name="copyright" content="<?= date('Y') ?>, <?= get_bloginfo('name'); ?>">

<?php if ($favicon_png) { ?>
<link rel="icon" type="image/png" href="<?= $favicon_png['url'] ?>">
<?php } else { ?>
<link rel="icon" type="image/png" href="<?= $icons_path . 'favicon.png' ?>">
<?php } ?>
<?php if ($favicon_gif) { ?>
<link rel="icon" type="image/gif" href="<?= $favicon_gif['url'] ?>">
<?php } else { ?>
<link rel="icon" type="image/gif" href="<?= $icons_path . 'favicon.gif' ?>">
<?php } ?>
<?php if ($favicon_ico) { ?>
<link rel="icon" type="image/vnd.microsoft.icon" href="<?= $favicon_ico['url'] ?>">
<?php } else { ?>
<link rel="icon" type="image/vnd.microsoft.icon" href="<?= $icons_path . 'favicon.ico' ?>">
<?php } ?>
<?php if ($favicon_png) { ?>
<link rel="icon" type="image/x-icon" href="<?= $favicon_png['url'] ?>">
<?php } ?>
<?php if ($favicon_png_32) { ?>
<link rel="icon" type="image/png" href="<?= $favicon_png_32['url'] ?>">
<?php }  ?>
<?php if ($favicon_png_192) { ?>
<link rel="icon" type="image/png" href="<?= $favicon_png_192['url'] ?>">
<?php }?>

<?php if ($ogg) { ?>
    <meta property="og:image" content="<?= $ogg['url']; ?>">
<?php } else { ?>
    <meta property="og:image" content="<?= $images_path . $main_ogg_name ?>">
<?php }?>


<?php if (is_home() || is_front_page()) { ?>
<meta name="title" property="title" content="<?= get_bloginfo('name'); ?>"/>
<meta property="og:title" content="<?= get_bloginfo('name'); ?>"/>
<meta property="og:url" content="<?= home_url($wp->request) ?>"/>
<meta property="og:description" content="<?= get_bloginfo('description'); ?>"/>
<meta name="description" property="description" content="<?= get_bloginfo('description'); ?>"/>
<?php } else if (is_single()) { ?>
<meta name="title" property="title" content="<?= get_the_title() ?>">
<meta property="og:title" content="<?= get_the_title() ?>">
<meta name="description" property="description" content="<?= $post->post_excerpt; ?>">
<meta property="og:description" content="<?= $post->post_excerpt; ?>">
<meta property="og:url" content="<?= get_the_permalink() ?>">
<meta property="og:image" content="<?php
    if (has_post_thumbnail()) {
        echo esc_url(get_the_post_thumbnail_url());
    } else {
        echo $images_path . $main_ogg_name;
    }
    ?>">
<?php } else {  ?>
<meta property="title" content="<?= get_bloginfo('name'); ?>"/>
<meta property="description" content="<?= get_bloginfo('description'); ?>"/>
<meta property="og:description" content="<?= get_bloginfo('description'); ?>"/>
<meta property="og:title" content="<?= get_bloginfo('name'); ?>"/>
<meta property="og:url" content="<?= home_url($wp->request) ?>"/>
<meta property="og:image" content="<?php
    if (file_exists($images_path . $post->post_name . '.jpg')) {
        echo $images_path . $post->post_name . '.jpg'; } else { echo
 '<meta property="og:image" content="' . get_template_directory_uri() . $main_ogg_name;
} ?>">
<?php } ?>
<link rel="icon" href="<?= $icons_path . 'favicon.ico' ?>">
