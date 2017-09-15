<?php

/*
 Template Name: Page: Example
 */

global $paged;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//$paged = get_query_var('page');
if (!isset($paged) || !$paged){
  $paged = 1;
}

$context = Timber::get_context();

$args = array(
  'post_type' => 'example_posts',
  'posts_per_page' => 1, // -1
  'paged' => $paged
);

$args2 = array(
  'post_type' => 'example_posts',
  'posts_per_page' => -1,
);

$context['example_posts'] = Timber::get_posts($args);
$context['example_posts_category'] = Timber::get_terms('example_posts_category', array('parent' => 0));

query_posts($args); //this forces WP to rerun query stuff
$context['example_posts_pagination'] = Timber::get_pagination();

$context['example_posts2'] = Timber::get_posts($args2);

echo Timber::compile('views/pages/page-example.twig', $context);

?>
