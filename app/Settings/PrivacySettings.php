<?php

namespace App\Settings;

use App\Helpers\ParsedownHelper;
use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class PrivacySettings extends Settings
{
    use HasTranslations;

    public array $title;
    public array $content;

    protected  $translatable = [
        'title',
        'content',
    ];

    public static function group(): string
    {
        return 'privacy';
    }

    public function getFormattedSettings(): array
    {

        return [
            'title' => $this->title[app()->getLocale()] ?? '',
            'content' => ParsedownHelper::parse($this->content[app()->getLocale()]) ?? '',
        ];
    }
}
