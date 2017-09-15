<?php

/*
 Template Name: 04-contact
 */

$context = Timber::get_context();
$context['post'] = Timber::get_post();

echo Timber::compile('views/pages/04-contact.twig', $context);

?>