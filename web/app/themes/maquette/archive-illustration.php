<?php

//dd('hello');
use Timber\Post;
use Timber\PostQuery;
use Timber\Timber;

$context = Timber::context();
//$context['post'] = new Post();
//$context['posts'] = Timber::get_posts();
$context['posts'] = new PostQuery;
Timber::render('illustration/archive-index.twig', $context);
