<?php

namespace App\Settings;

use App\Helpers\ParsedownHelper;
use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class AboutSettings extends Settings
{
    use HasTranslations;

    public array $title;
    public array $desc;
    public array $content;
    public int $visitors_number;
    public array $visitors_text;
    public string $visitors_icon;

    public int $tours_number;
    public array $tours_text;
    public string $tours_icon;

    protected  $translatable = [
        'title',
        'content',
        'visitors_text',
        'tours_text',
    ];

    public static function group(): string
    {
        return 'about';
    }

    public function getFormattedSettings(): array
    {
        return [
            'title' => $this->title[app()->getLocale()] ?? '',
            'desc' => $this->desc[app()->getLocale()] ?? '',
            'content' => ParsedownHelper::parse($this->content[app()->getLocale()]) ?? '',
            'visitors_number' => $this->visitors_number,
            'visitors_text' => $this->visitors_text[app()->getLocale()] ?? '',
            'visitors_icon' => $this->visitors_icon,
            'tours_number' => $this->tours_number,
            'tours_text' => $this->tours_text[app()->getLocale()] ?? '',
            'tours_icon' => $this->tours_icon,
        ];
    }
}
