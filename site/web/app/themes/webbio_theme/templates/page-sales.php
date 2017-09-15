<?php

/*
 Template Name: Page: Sales
 */
$args = array(
  'post_type'      => 'business_cases',
  'posts_per_page' => -1,
  'order'          => 'ASC'
);

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['posts'] = Timber::get_posts($args);
echo Timber::compile('views/pages/page-sales.twig', $context);

?>