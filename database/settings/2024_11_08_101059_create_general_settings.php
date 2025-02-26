<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', [
            'en' => 'Laravel Starter',
            'fr' => 'Monde Pour Vous',
            'es' => 'Mundo Para Ti'
        ]);
        $this->migrator->add('general.site_description', [
            'en' => 'This is a description of the site.',
            'fr' => 'Ceci est une description du site.',
            'es' => 'Esta es una descripción del sitio.'
        ]);

        $this->migrator->add('general.work_time', [
            'en' => 'Mon-Sat: 9am to 6pm',
            'fr' => 'Lun-Sam: 9h à 18h',
            'es' => 'Lun-Sáb: 9am a 6pm'
        ]);


        $this->migrator->add('general.site_email', 'contact@test.com');
        $this->migrator->add('general.site_phone', '+1234567890');
        $this->migrator->add('general.site_address', '123 Street, City, Country');
        $this->migrator->add('general.site_logo_light', 'logo-light.png');
        $this->migrator->add('general.site_logo_dark', 'logo-dark.png');
        $this->migrator->add('general.site_favicon', 'favicon.png');
        $this->migrator->add('general.site_google_analytics', '');
        $this->migrator->add('general.site_google_recaptcha', '');
        $this->migrator->add('general.site_google_maps', '');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.site_timezone', 'UTC');
        $this->migrator->add('general.site_locale', 'en');
        $this->migrator->add('general.site_currency', 'USD');
        $this->migrator->add('general.site_currency_symbol', '$');
    }
};
