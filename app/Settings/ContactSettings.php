<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class ContactSettings extends Settings
{
    use HasTranslations;

    public string $email;
    public array $button_text;
    public array $label;
    public string $google_map_iframe;
    public array $info;

    protected $translatable = [
        'button_text',
        'label',
        'info',
    ];


    public static function group(): string
    {
        return 'contact';
    }

    public function getFormattedSettings(): array
    {
        return [
            'email' => $this->email,
            'button_text' => $this->button_text[app()->getLocale()] ?? '',
            'label' => $this->label[app()->getLocale()] ?? '',
            'google_map_iframe' => str_replace('<iframe ', '<iframe class="w-full h-[500px]" ', $this->google_map_iframe),
            'info' => $this->info[app()->getLocale()] ?? '',
        ];
    }
}
