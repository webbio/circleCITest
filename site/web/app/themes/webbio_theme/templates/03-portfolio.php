<?php

/*
 Template Name: 03-portfolio
 */

$args = array(
  'post_type'     => 'portfolio',
  'post_per_page' => -1,
  'order'         => 'DESC'
);

$context = Timber::get_context();
$context['post'] = Timber::get_post();
$context['posts'] = Timber::get_posts($args);

echo Timber::compile('views/pages/03-portfolio.twig', $context);

?>