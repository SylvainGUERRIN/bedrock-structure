<?php

use Timber\Post;
use Timber\Timber;

$context = Timber::context();
$context['post'] = new Post();
//$context['term'] = new \Timber\Term();
//$context['term_page'] = new \Timber\Term();

Timber::render('index.twig', $context);
