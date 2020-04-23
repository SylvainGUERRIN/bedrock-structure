<?php

$context = \Timber\Timber::context();
$context['post'] = new \Timber\Post();
//$context['term'] = new \Timber\Term();
//$context['term_page'] = new \Timber\Term();

\Timber\Timber::render('index.twig', $context);
