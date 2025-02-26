<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class GeneralSettings extends Settings
{
    use HasTranslations;

    public array $site_name;
    public array $site_description;
    public array $work_time;

    public string $site_email;
    public string $site_phone;
    public string $site_address;
    public ?string $site_logo_dark;
    public ?string $site_logo_light;
    public string $site_favicon;
    public ?string $site_google_analytics;
    public ?string $site_google_recaptcha;
    public ?string $site_google_maps;
    public ?bool $site_active;
    public ?string $site_timezone;
    public ?string $site_locale;
    public ?string $site_currency;
    public ?string $site_currency_symbol;


    // protected  $translatable = [
    //     'site_name',
    //     'site_description',
    // ];

    public static function group(): string
    {
        return 'general';
    }

    public function getFormattedSettings(): array
    {
        $defaultLightImage = 'https://laravel.com/img/logotype.min.svg';
        $imageLightUrl = (!empty($this->site_logo_light) && Storage::disk('public')->exists($this->site_logo_light))
            ? Storage::disk('public')->url($this->site_logo_light)
            : $defaultLightImage;

        $defaultDarkImage  = 'https://laravel.com/img/logotype.min.svg';

        $imageDarkUrl = (!empty($this->site_logo_dark) && Storage::disk('public')->exists($this->site_logo_dark))
            ? Storage::disk('public')->url($this->site_logo_dark)
            : $defaultDarkImage;

        $faviconUrl = (!empty($this->site_favicon) && Storage::disk('public')->exists($this->site_favicon))
            ? Storage::disk('public')->url($this->site_favicon)
            : 'https://laravel.com/img/favicon/favicon-32x32.png';
        return [
            'site_name' => $this->site_name[app()->getLocale()] ?? '',
            'site_description' => $this->site_description[app()->getLocale()] ?? '',
            'work_time' => $this->work_time[app()->getLocale()] ?? '',
            'site_email' => $this->site_email,
            'site_phone' => $this->site_phone,
            'site_address' => $this->site_address,
            'site_logo_dark' => $imageDarkUrl,
            'site_logo_light' => $imageLightUrl,
            'site_favicon' => $faviconUrl,
            'site_google_analytics' => $this->site_google_analytics,
            'site_google_recaptcha' => $this->site_google_recaptcha,
            'site_google_maps' => $this->site_google_maps,
            'site_active' => $this->site_active,
            'site_timezone' => $this->site_timezone,
            'site_locale' => $this->site_locale,
            'site_currency' => $this->site_currency,
            'site_currency_symbol' => $this->site_currency_symbol,
        ];
    }

}
