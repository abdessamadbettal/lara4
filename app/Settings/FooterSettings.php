<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;
class FooterSettings extends Settings
{
    use HasTranslations;

    public array $copy_right;
    public array $footer_text;
    public array $links;
    public array $link_name;
    public array $info;
    public array $info_name;
    public array $info_desc;
    public array $newsletter;
    public array $newsletter_name;
    public string $newsletter_email;
    public array $newsletter_button;
    public array $newsletter_label;

    protected  $translatable = [
        'copy_right',
        'footer_text',
        'link_name',
        'info_name',
        'newsletter_name',
        'newsletter_button',
        'newsletter_label',
    ];

    public static function group(): string
    {
        return 'footer';
    }

    public function getFormattedSettings(): array
    {
        return [
            'copy_right' => $this->copy_right[app()->getLocale()] ?? '',
            'footer_text' => $this->footer_text[app()->getLocale()] ?? '',
            'links' => $this->links[app()->getLocale()] ?? '',
            'link_name' => $this->link_name[app()->getLocale()] ?? '',
            'info' => $this->info[app()->getLocale()] ?? '',
            'info_name' => $this->info_name[app()->getLocale()] ?? '',
            'info_desc' => $this->info_name[app()->getLocale()] ?? '',
            'newsletter' => $this->newsletter[app()->getLocale()] ?? '',
            'newsletter_name' => $this->newsletter_name[app()->getLocale()] ?? '',
            'newsletter_email' => $this->newsletter_email,
            'newsletter_button' => $this->newsletter_button[app()->getLocale()] ?? '',
            'newsletter_label' => $this->newsletter_label[app()->getLocale()] ?? '',
        ];
    }
}
