<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $socials = [
            Social::create('Facebook', 'facebook', 'https://facebook.com'),
            Social::create('X', 'x', 'https://twitter.com'),
            Social::create('Instagram', 'instagram', 'https://instagram.com'),
            Social::create('LinkedIn', 'linkedin', 'https://linkedin.com'),
            Social::create('YouTube', 'youtube', 'https://youtube.com'),
            Social::create('GitHub', 'github', 'https://github.com'),
            Social::create('Email', 'mail', 'mailto:test@gmail.com', false),
        ];

        $this->migrator->add('social.socials', $socials);
    }
};

class Social
{
    public static function create($name, $icon, $url, $active = true, $icon_url = null)
    {
        return [
            'name' => $name,
            'icon' => $icon,
            'url' => $url,
            'active' => $active,
            'icon_url' => $icon_url ?? "https://cdn.simpleicons.org/{$icon}?format=png",
        ];
    }
}
