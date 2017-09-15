<?php

/*
 Template Name: 00-legal
 */

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();

echo Timber::compile('views/pages/00-legal.twig', $context);

?>