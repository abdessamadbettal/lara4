<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $content = <<<EOT
        # Overview :

        In the 1960s, the text suddenly **became** known beyond the **professional** circle of typesetters and layout designers when it was used for Letraset sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text were subsequently included in DTP programmes such as PageMaker etc.

        There is now an **abundance** of readable dummy texts. These are usually used when a text is required purely to fill a space. These alternatives to the classic Lorem Ipsum texts are often amusing and tell short, funny or **nonsensical** stories.

        # We use your information to :
        * Digital Marketing Solutions for Tomorrow
        * Our Talented & Experienced Marketing Agency
        * Create your own skin to match your brand
        * Digital Marketing Solutions for Tomorrow
        * Create your own skin to match your brand
        * Our Talented & Experienced [Marketing Agency](https://github.com/abdessamadbettal)
        EOT;

        $this->migrator->add('about.visitors_number', 40300);
        $this->migrator->add('about.visitors_text', [
            'en' => 'Happy Visitors',
            'fr' => 'Visiteurs Heureux',
            'es' => 'Visitantes Felices'
        ]);

        $this->migrator->add('about.visitors_icon', 'users');

        $this->migrator->add('about.tours_number', 531);
        $this->migrator->add('about.tours_text', [
            'en' => 'Tours Completed',
            'fr' => 'Visites Terminées',
            'es' => 'Tours Completados'
        ]);

        $this->migrator->add('about.tours_icon', 'globe');

        $this->migrator->add('about.content', [
            'en' => $content,
            'fr' => $content,
            'es' => $content
        ]);

        // have reviews
        $this->migrator->add('about.have_reviews', true);

        $this->migrator->add('about.title', [
            'en' => 'Travel in Agency Laravel Starter World',
            'fr' => 'Voyage dans le monde de l\'agence Laravel Starter',
            'es' => 'Viaje en la agencia Laravel Starter World'
        ]);
        $this->migrator->add('about.desc', [
            'en' => 'World Best Travel in Agency Laravel Starter',
            'fr' => 'Meilleure agence de voyage au monde',
            'es' => 'Mejor agencia de viajes del mundo'
        ]);
    }
};
