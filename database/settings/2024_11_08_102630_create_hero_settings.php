<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('hero.title', [
            'en' => 'Beauty of Discover',
            'fr' => 'Beauté de la Découverte',
            'es' => 'Belleza del Descubrimiento'
        ]);

        $this->migrator->add('hero.subtitle', [
            'en' => "Let's Leave The Road, And Take The Laravel Starter",
            'fr' => "Quittons la Route, Et Prenons Le Laravel Starter",
            'es' => "Dejemos el Camino, Y Tomemos El Laravel Starter"
        ]);

        $this->migrator->add('hero.description', [
            'en' => 'Planning for a trip? We will organize your trip with the best places and within best budget!',
            'fr' => 'Vous planifiez un voyage ? Nous organiserons votre voyage avec les meilleurs endroits et dans le meilleur budget !',
            'es' => '¿Planeando un viaje? ¡Organizaremos tu viaje con los mejores lugares y dentro del mejor presupuesto!'
        ]);
        $this->migrator->add('hero.image', '');
        $this->migrator->add('hero.youtube_iframe', '<iframe width="560" height="315" src="https://www.youtube.com/embed/e0qNKnwV40E?si=9Y4rsU63nO3jyPRY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>');

    }
};
