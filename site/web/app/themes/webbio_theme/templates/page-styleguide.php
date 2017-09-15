<?php

/*
 Template Name: Page: Styleguide
 */

$context = Timber::get_context();
$context['post'] = new TimberPost();
echo Timber::compile('views/pages/page-styleguide.twig', $context);

?>
