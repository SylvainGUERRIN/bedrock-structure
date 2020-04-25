<?php

namespace Maquette\Repository;

use Timber\PostQuery;

class IllustrationRepository
{
    public static function last(): PostQuery
    {
        return new PostQuery([
            'posts_per_page' => 4,
            'post_type' => 'illustration',
            'paged' => 1
        ]);
    }
}
