<?php
function meta_example( $meta_boxes ) {
    $prefix = 'example_post_';

    $meta_boxes[] = array(
        'id' => 'example_post',
        'title' => __('Example post', 'webbio_theme'),
        'post_types' => array( 'example_posts' ),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => false,
        'fields' => array(
            array(
                'id' => $prefix . 'title',
                'type' => 'text',
                'name' => __('Title', 'webbio_theme'),
            ),
            array(
                'id' => $prefix . 'content',
                'type' => 'wysiwyg',
                'name' => __('Content', 'webbio_theme'),
            ),
            array(
                'id' => $prefix . 'image',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'name' => __('Image', 'webbio_theme'),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'meta_example' );
