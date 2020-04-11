<?php

use App\Site;

add_filter('use_block_editor_for_post', '__return_false', 10);

new Timber\Timber();
//\Timber\Timber::$dirname = ['templates'];
//new \Timber\Site();
new Site();
