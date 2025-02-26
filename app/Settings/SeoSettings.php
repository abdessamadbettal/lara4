<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class SeoSettings extends Settings
{
    use HasTranslations;

    public array $meta_title;
    public array $meta_description;
    public array $meta_keywords;
    public array $meta_author;
    public array $og_title;
    public array $og_description;
    public array $tw_title;
    public array $tw_description;
    public string $meta_robots;
    public string $meta_googlebot;
    public string $meta_bingbot;

    protected  $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'og_title',
        'og_description',
        'tw_title',
        'tw_description',
    ];

    public static function group(): string
    {
        return 'seo';
    }

    public function getFormattedSettings(): array
    {
        return [
            'meta_title' => $this->meta_title[app()->getLocale()] ?? '',
            'meta_description' => $this->meta_description[app()->getLocale()] ?? '',
            'meta_keywords' => $this->meta_keywords[app()->getLocale()] ?? '',
            'meta_author' => $this->meta_author[app()->getLocale()] ?? '',
            'og_title' => $this->og_title[app()->getLocale()] ?? '',
            'og_description' => $this->og_description[app()->getLocale()] ?? '',
            'tw_title' => $this->tw_title[app()->getLocale()] ?? '',
            'tw_description' => $this->tw_description[app()->getLocale()] ?? '',
            'meta_robots' => $this->meta_robots,
            'meta_googlebot' => $this->meta_googlebot,
            'meta_bingbot' => $this->meta_bingbot,
        ];
    }
}
