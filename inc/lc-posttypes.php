<?php

function lc_register_post_types()
{

    $labels = [
        "name" => __("Testimonials", "lc-bbl2023"),
        "singular_name" => __("Testimonial", "lc-bbl2023"),
    ];

    $args = [
        "label" => __("Testimonials", "lc-bbl2023"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "menu_icon" => "dashicons-open-folder",
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => false,
        "query_var" => true,
        "supports" => [ "title", "editor" ],
        "show_in_graphql" => false,
        "exclude_from_search" => true
    ];

    register_post_type("testimonials", $args);

}
add_action('init', 'lc_register_post_types');



// add_action( 'after_switch_theme', 'lc_rewrite_flush' );
// function lc_rewrite_flush() {
//     lc_register_post_types();
//     flush_rewrite_rules();
// }
