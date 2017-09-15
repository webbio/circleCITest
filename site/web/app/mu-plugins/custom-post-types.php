<?php
/**
 * Plugin Name: Custom post types
 * Description: Registers all custom post types that are necessary for this website
 * Version: 1.0.0
 * Author: Webbio B.V.
 * Author URI: https://webbio.nl
 */

function register_custom_post_types() {

    /**
     * Post Type: Diensten
     */

    $args = array(
        "label" => __( 'Diensten', 'oyetheme' ),
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "diensten", "with_front" => true ),
        "query_var" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => array( "title",'editor' ),
    );
    register_post_type( "diensten", $args );

    /**
     * Post Type: Portfolio items
     */

    $args = array(
        "label" => __( 'Portfolio', 'oyetheme' ),
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "portfolio", "with_front" => true ),
        "query_var" => true,
        "menu_icon" => "dashicons-portfolio",
        "supports" => array( "title", "thumbnail" ),
    );
    register_post_type( "portfolio", $args );

    /**
     * Post Type: Portfolio items
     */

    $args = array(
      "label" => __( 'Business cases', 'oyetheme' ),
      "description" => "",
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_rest" => false,
      "rest_base" => "",
      "has_archive" => false,
      "show_in_menu" => true,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => false,
      "rewrite" => array( "slug" => "business_cases", "with_front" => true ),
      "query_var" => true,
      "menu_icon" => "dashicons-archive",
      "supports" => array( "title", "thumbnail" ),
    );
    register_post_type( "business_cases", $args );

}

add_action( 'init', 'register_custom_post_types' );
