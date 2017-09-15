<?php

$context = Timber::get_context();

$context['post'] = Timber::get_post();

echo Timber::compile('views/pages/03-portfolio-single.twig', $context);
?>