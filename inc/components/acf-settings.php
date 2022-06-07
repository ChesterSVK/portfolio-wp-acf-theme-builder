<?php

require_once THEME_INC_DIR . '/upgrades/acf-rgba/acf-color-picker-with-alpha.php';

$_THEME_BLOCKS = [];


/**********************************************************************
 * Functions
 *
 */


function theme_get_block_args($type, $default_args = [])
{
    $new_args = [];
    if (!$type) return $new_args;
    foreach ($default_args as $index => $arg) {
        if ($type == 'dynamic') {
            $new_val = get_sub_field($index);
        } else if ($type == 'block') {
            $new_val = get_field($index);
        } else if ($type == 'options') {
            $new_val = get_field($index, 'options');
        } else {
            $new_val = false;
        }
        $new_args[$index] = $new_val ?: $arg;
    }
    return $new_args;
}


/**
 * Parse components to proper php files
 */
function parse_acf_subfield_components($id = false)
{
    if ($id){
        while (has_sub_field(THEME_ACF_BUILDER_SLUG, $id)) :
            $layout = get_row_layout();
            if (in_array($layout, THEME_SUPPORTED_MODULES)) {
                get_template_part('template-parts/blocks/' . $layout . '/' . $layout);
            }
        endwhile;
    } else {
        while (has_sub_field(THEME_ACF_BUILDER_SLUG)) :
            $layout = get_row_layout();
            if (in_array($layout, THEME_SUPPORTED_MODULES)) {

                get_template_part('template-parts/blocks/' . $layout . '/' . $layout);
            }
        endwhile;
    }
}


/*********************************************************************************************
 * Setup
 */


//Remove update notice
if (function_exists('acf_add_options_page')) {
    // Hide ACF field group menu item
    //    add_filter( 'acf/settings/show_admin', '__return_false' );

    // Hide ACF Pro Update Notice
    function progresio_acf_remove_update_notice($value)
    {
        if (isset($value->response['advanced-custom-fields-pro/acf.php'])) {
            unset($value->response['advanced-custom-fields-pro/acf.php']);
        }
        return $value;
    }

    add_filter('site_transient_update_plugins', 'progresio_acf_remove_update_notice');
}


//Add preview flag for block template files to hook on
add_filter('acfe/block_type/register', 'acfe_add_example_preview_flag');
if (!function_exists('acfe_add_example_preview_flag')) {
    function acfe_add_example_preview_flag($args)
    {
        //If editing in admin
        if (is_admin()) {
            $args['example'] = array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => ['_is_preview' => true],
                )
            );
        }
        $args['supports']['jsx'] = true;
        $args['supports']['__experimental_jsx'] = true;
        return $args;
    }
}



function theme_acf_fallback()
{
    // ACF Plugin fallback
    if (!is_admin() && !function_exists('get_field')) {
        function get_field($field = '', $id = false)
        {
            return false;
        }

        function the_field($field = '', $id = false)
        {
            return false;
        }

        function have_rows($field = '', $id = false)
        {
            return false;
        }

        function has_sub_field($field = '', $id = false)
        {
            return false;
        }

        function get_sub_field($field = '', $id = false)
        {
            return false;
        }

        function the_sub_field($field = '', $id = false)
        {
            return false;
        }

        function the_sub_fields()
        {
            return false;
        }
    }
}

add_action('init', 'theme_acf_fallback');


function progresio_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'progresio',
                'title' => 'Progresio',
            ),
        )
    );
}

add_filter('block_categories_all', 'progresio_block_category', 10, 2);
