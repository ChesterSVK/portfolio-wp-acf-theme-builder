<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--    --><?php //include_once THEME_DIR . '/inc/meta.php'?>
    <?php wp_head(); ?>
</head>

<body>
<?php wp_body_open(); ?>
<!--BEGIN PAGE-->
<div id="page" class="">

    <?php echo get_template_part('template-parts/components/spinner')?>
    <!--BEGIN Menu -->
    <?php echo get_template_part('template-parts/header/menu')?>
    <!--END Menu -->
    <!--BEGIN MAIN-->
    <main id="content">
