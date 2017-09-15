<?php

/*
 Template Name: Page: Components
 */

$context = Timber::get_context();
$context['post'] = new TimberPost();
echo Timber::compile('views/pages/page-components.twig', $context);

?>
