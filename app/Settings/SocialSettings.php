<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SocialSettings extends Settings
{
    public array $socials = []; // ['name' => $name, 'icon' => $icon, 'url' => $url, 'active' => $active]

    public static function group(): string
    {
        return 'social';
    }

    public function getIconUrl(string $icon): string
    {
        // Convert icon name to lowercase and return PNG URL
        $icon = strtolower($icon);
        return "https://cdn.simpleicons.org/{$icon}?format=png";
    }

    // If you want to expose the icons as URLs within your settings
    public function getFormattedSettings(): array
    {
        return [
            'socials' => array_map(function ($social) {
                return [
                    'name' => $social['name'],
                    'icon_url' => $social['icon_url'] ?? $this->getIconUrl($social['icon']),
                    'icon' => $social['icon'],
                    'url' => $social['url'],
                    'active' => $social['active'],
                ];
            }, $this->socials),
        ];
    }
}
