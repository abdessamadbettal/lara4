<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('header.links', [
            'en' => [
                Link::create('Home', 'home', '/'),
                Link::create('Blogs', 'post', '/blogs'),
                Link::create('Projects', 'project', '/projects'),
                Link::create('Contact', 'contact', '/contact'),
                Link::create('About', 'about', '/aboutus'),
            ],
            'fr' => [
                Link::create('Accueil', 'home', '/'),
                Link::create('Blogs', 'post', '/blogs'),
                Link::create('Projets', 'project', '/projects'),
                Link::create('Contact', 'contact', '/contact'),
                Link::create('À propos', 'about', '/aboutus')
            ],
            'es' => [
                Link::create('Inicio', 'home', '/'),
                Link::create('Blogs', 'post', '/blogs'),
                Link::create('Proyectos', 'project', '/projects'),
                Link::create('Contacto', 'contact', '/contact'),
                Link::create('Acerca de', 'about', '/aboutus'),
            ],
        ]);
    }
};

class Link
{
    public static function create($title, $type, $url, $newTab = false, $isDropdown = false, $dropdown = [])
    {
        return [
            'title' => $title,
            'type' => $type,
            'url' => $url,
            'new_tab' => $newTab,
            'is_dropdown' => $isDropdown,
            'dropdown' => $dropdown,
        ];
    }
}

class Dropdown
{
    public static function create($links)
    {
        return array_map(function ($link) {
            return Link::create($link['title'], $link['type'],  $link['url'], $link['new_tab'] ?? false, $link['is_dropdown'] ?? false, $link['dropdown'] ?? []);
        }, $links);
    }
}

