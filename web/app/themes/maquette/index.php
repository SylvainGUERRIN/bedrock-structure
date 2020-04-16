<?php

$context = \Timber\Timber::context();
$context['post'] = new \Timber\Post();

\Timber\Timber::render('index.twig', $context);
