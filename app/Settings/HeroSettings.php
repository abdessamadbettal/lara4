<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class HeroSettings extends Settings
{
    use HasTranslations;

    public array $title;
    public array $subtitle;
    public array $description;
    public string $image;
    public string $youtube_iframe;

    protected $translatable = [
        'title',
        'subtitle',
        'description',
    ];

    public static function group(): string
    {
        return 'hero';
    }

    public function getFormattedSettings(): array
    {
        $defaultImage = 'https://images.unsplash.com/photo-1509339022327-1e1e25360a41?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
        $imageUrl = (!empty($this->image) && Storage::disk('public')->exists($this->image))
            ? Storage::disk('public')->url($this->image)
            : $defaultImage;
        return [
            'title' => $this->title[app()->getLocale()] ?? '',
            'subtitle' => $this->subtitle[app()->getLocale()] ?? '',
            'description' => $this->description[app()->getLocale()] ?? '',
            'image' => $imageUrl,
            'youtube_iframe' => $this->youtube_iframe,
        ];
    }

}
