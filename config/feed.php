<?php

use App\Models\Post;

return [
    'feeds' => [
        'posts' => [
            'items' => [Post::class, 'getFeedItems'],

            'url' => '/posts/feed',

            'title' => 'Laravel starter Blog RSS Feed',
            'description' => 'The Laravel starter Blog RSS feed',
            'language' => 'en-US',

            'image' => '',

            'format' => 'atom',

            'view' => 'feed::atom',

            'type' => '',

            'contentType' => '',
        ],
    ],
];
