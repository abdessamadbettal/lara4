<?php

use App\Models\Post;

return [
    'feeds' => [
        'posts' => [
            'items' => [Post::class, 'getFeedItems'],

            'url' => '/posts/feed',

            'title' => 'Lara4 Blog RSS Feed',
            'description' => 'The Lara4 Blog RSS feed',
            'language' => 'en-US',

            'image' => '',

            'format' => 'atom',

            'view' => 'feed::atom',

            'type' => '',

            'contentType' => '',
        ],
    ],
];
