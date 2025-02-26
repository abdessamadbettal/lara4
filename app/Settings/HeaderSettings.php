<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class HeaderSettings extends Settings
{
    use HasTranslations;

    public array $links = [];

    protected  $translatable = [ 'links' ]; // 'title', 'url' , type, is_dropdown , dropdown, new_tab


    public static function group(): string
    {
        return 'header';
    }

    public function getFormattedSettings(): array
    {
        return [
            'links' => $this->links[app()->getLocale()] ?? '',
        ];
    }

}
