<?php
/**
 * Plugin Name: Taxonomies
 * Description: Registers all taxonomies that are necessary for this website
 * Version: 1.0.0
 * Author: Webbio B.V.
 * Author URI: https://webbio.nl
 */

function register_my_taxes() {


    /**
     * Taxonomy: Example post
     */

    $labels = array(
        "name" => __( 'Categories', 'webbio_theme' )
    );

    $args = array(
        "label" => __( 'Example posts category', 'webbio_theme' ),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "label" => "Example posts category",
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array( 'slug' => 'example_posts_category', 'with_front' => true, ),
        "show_admin_column" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "show_in_quick_edit" => false,
    );
    register_taxonomy( "example_posts_category", array( "example_posts" ), $args );

}

add_action( 'init', 'register_my_taxes' );
