<?php


function cptui_register_my_cpts_repeatable_parts() {

    /**
     * Post Type: Repeatable parts.
     */

    $labels = [
        "name" => __( "Repeatable parts", "progresio" ),
        "singular_name" => __( "Repeatable part", "progresio" ),
        "menu_name" => __( "Repeatable parts", "progresio" ),
        "all_items" => __( "All parts", "progresio" ),
        "add_new" => __( "Add new", "progresio" ),
        "add_new_item" => __( "Add new part", "progresio" ),
        "edit_item" => __( "Edit part", "progresio" ),
        "new_item" => __( "New part", "progresio" ),
        "view_item" => __( "View part", "progresio" ),
        "view_items" => __( "View parts", "progresio" ),
        "search_items" => __( "Search parts", "progresio" ),
        "not_found" => __( "Not found", "progresio" ),
        "not_found_in_trash" => __( "Not found in Trash", "progresio" ),
        "parent" => __( "Parent", "progresio" ),
        "featured_image" => __( "Feature image", "progresio" ),
        "set_featured_image" => __( "Set featured image", "progresio" ),
        "remove_featured_image" => __( "Remove featured image", "progresio" ),
        "use_featured_image" => __( "Use featured image", "progresio" ),
        "archives" => __( "Part archives", "progresio" ),
        "insert_into_item" => __( "Insert into part", "progresio" ),
        "uploaded_to_this_item" => __( "Upload to part", "progresio" ),
        "filter_items_list" => __( "Filter parts list", "progresio" ),
        "items_list_navigation" => __( "Parts list navigation", "progresio" ),
        "items_list" => __( "Parts list", "progresio" ),
        "parent_item_colon" => __( "Parent", "progresio" ),
    ];

    $args = [
        "label" => __( "Repeatable parts", "progresio" ),
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => false,
        "query_var" => false,
        "supports" => [ "title" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "repeatable-parts", $args );
}

add_action( 'init', 'cptui_register_my_cpts_repeatable_parts' );


/////////////////////////////////////////////////////////////////////////

function cptui_register_my_cpts_fonts() {

    /**
     * Post Type: Fonts
     */

    $labels = [
        "name" => __( "Fonts", "progresio" ),
        "singular_name" => __( "Font", "progresio" ),
        "menu_name" => __( "Fonts", "progresio" ),
        "all_items" => __( "All fonts", "progresio" ),
        "add_new" => __( "Add new", "progresio" ),
        "add_new_item" => __( "Add new font", "progresio" ),
        "edit_item" => __( "Edit font", "progresio" ),
        "new_item" => __( "New font", "progresio" ),
        "view_item" => __( "View font", "progresio" ),
        "view_items" => __( "View fonts", "progresio" ),
        "search_items" => __( "Search fonts", "progresio" ),
        "not_found" => __( "Not found", "progresio" ),
        "not_found_in_trash" => __( "Not found in Trash", "progresio" ),
        "parent" => __( "Parent", "progresio" ),
        "featured_image" => __( "Feature image", "progresio" ),
        "set_featured_image" => __( "Set featured image", "progresio" ),
        "remove_featured_image" => __( "Remove featured image", "progresio" ),
        "use_featured_image" => __( "Use featured image", "progresio" ),
        "archives" => __( "Font archives", "progresio" ),
        "insert_into_item" => __( "Insert into font", "progresio" ),
        "uploaded_to_this_item" => __( "Upload to font", "progresio" ),
        "filter_items_list" => __( "Filter fonts list", "progresio" ),
        "items_list_navigation" => __( "Fonts list navigation", "progresio" ),
        "items_list" => __( "Fonts list", "progresio" ),
        "parent_item_colon" => __( "Parent", "progresio" ),
    ];

    $args = [
        "label" => __( "Fonts", "progresio" ),
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => false,
        "query_var" => false,
        "supports" => [ "title" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "theme-fonts", $args );
}

add_action( 'init', 'cptui_register_my_cpts_fonts' );
