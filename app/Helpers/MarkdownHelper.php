<?php

namespace App\Helpers;

use League\CommonMark\CommonMarkConverter;

class MarkdownHelper
{
    public static function convertToHtml(string $markdown): string
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($markdown);
    }
}
