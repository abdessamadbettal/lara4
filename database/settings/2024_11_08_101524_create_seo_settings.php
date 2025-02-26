<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.meta_robots', 'index, follow');
        $this->migrator->add('seo.meta_googlebot', 'index, follow');
        $this->migrator->add('seo.meta_bingbot', 'index, follow');
        $this->migrator->add('seo.meta_title', [
            'en' => 'Laravel Starter',
            'fr' => 'Monde Pour Vous',
            'es' => 'Mundo Para Ti'
        ]);
        $this->migrator->add('seo.meta_description', [
            'en' => 'This is a description of the site.',
            'fr' => 'Ceci est une description du site.',
            'es' => 'Esta es una descripción del sitio.'
        ]);
        $this->migrator->add('seo.meta_keywords', [
            'en' => 'world, for, you',
            'fr' => 'monde, pour, vous',
            'es' => 'mundo, para, ti'
        ]);
        $this->migrator->add('seo.meta_author', [
            'en' => 'Laravel Starter',
            'fr' => 'Monde Pour Vous',
            'es' => 'Mundo Para Ti'
        ]);
        $this->migrator->add('seo.og_title', [
            'en' => 'Laravel Starter',
            'fr' => 'Monde Pour Vous',
            'es' => 'Mundo Para Ti'
        ]);
        $this->migrator->add('seo.og_description', [
            'en' => 'This is a description of the site.',
            'fr' => 'Ceci est une description du site.',
            'es' => 'Esta es una descripción del sitio.'
        ]);
        $this->migrator->add('seo.tw_title', [
            'en' => 'Laravel Starter',
            'fr' => 'Monde Pour Vous',
            'es' => 'Mundo Para Ti'
        ]);
        $this->migrator->add('seo.tw_description', [
            'en' => 'This is a description of the site.',
            'fr' => 'Ceci est une description du site.',
            'es' => 'Esta es una descripción del sitio.'
        ]);

        $this->migrator->add('seo.json_ld', [
            'en' => [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'url' => 'https://laravel-starter.test',
                'logo' => 'https://laravel-starter.test/logo.png',
                'contactPoint' => [
                    [
                        '@type' => 'ContactPoint',
                        'telephone' => '+1-401-555-1212',
                        'contactType' => 'Customer service',
                        'areaServed' => 'US',
                        'availableLanguage' => 'English, Spanish, French'
                    ]
                ],
                'sameAs' => [
                    'https://www.facebook.com/your-profile',
                    'https://www.twitter.com/your-profile',
                    'https://www.linkedin.com/in/yourprofile'
                ]
            ],
            'fr' => [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'url' => 'https://monde-pour-vous.test',
                'logo' => 'https://monde-pour-vous.test/logo.png',
                'contactPoint' => [
                    [
                        '@type' => 'ContactPoint',
                        'telephone' => '+1-401-555-1212',
                        'contactType' => 'Customer service',
                        'areaServed' => 'US',
                        'availableLanguage' => 'English, Spanish, French'
                    ]
                ],
                'sameAs' => [
                    'https://www.facebook.com/your-profile',
                    'https://www.twitter.com/your-profile',
                    'https://www.linkedin.com/in/yourprofile'
                ]
            ],
            'es' => [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'url' => 'https://mundo-para-ti.test',
                'logo' => 'https://mundo-para-ti.test/logo.png',
                'contactPoint' => [
                    [
                        '@type' => 'ContactPoint',
                        'telephone' => '+1-401-555-1212',
                        'contactType' => 'Customer service',
                        'areaServed' => 'US',
                        'availableLanguage' => 'English, Spanish, French'
                    ]
                ],
                'sameAs' => [
                    'https://www.facebook.com/your-profile',
                    'https://www.twitter.com/your-profile',
                    'https://www.linkedin.com/in/yourprofile'
                ]
            ]
        ]);

        $this->migrator->add('seo.canonical', 'https://laravel-starter.com');

        $this->migrator->add('seo.twitter_card', 'summary_large_image');
        $this->migrator->add('seo.twitter_site', '@laravel_starter');
        $this->migrator->add('seo.twitter_creator', '@laravel_starter');
        $this->migrator->add('seo.twitter_image', 'https://laravel-starter.test/logo.png');

        $this->migrator->add('seo.og_type', 'website');
        $this->migrator->add('seo.og_site_name', 'Laravel Starter');
        $this->migrator->add('seo.og_image', 'https://laravel-starter.test/logo.png');
        $this->migrator->add('seo.og_url', 'https://laravel-starter.test');


    }
};
