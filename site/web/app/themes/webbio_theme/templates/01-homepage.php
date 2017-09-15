<?php

/*
 Template Name: 01-homepage
 */

$context = Timber::get_context();
$context['post'] = Timber::get_post();

echo Timber::compile('views/pages/01-homepage.twig', $context);

?>