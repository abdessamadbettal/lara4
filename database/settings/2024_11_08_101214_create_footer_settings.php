<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // footer
        $this->migrator->add('footer.copy_right', [
            'en' => '© 2024 Company. All Rights Reserved.',
            'fr' => '© 2024 Société. Tous droits réservés.',
            'es' => '© 2024 Empresa. Todos los derechos reservados.'
        ]);
        $this->migrator->add('footer.footer_text', [
            'en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'fr' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'es' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        // links
        $this->migrator->add('footer.links', [
            'en' => [
                Link::create('Home', 'home', '/'),
                Link::create('About', 'about', '/aboutus'),
                Link::create('Blogs', 'post', '/blogs'),
                Link::create('Contact', 'contact', '/contact'),
                Link::create('Privacy Policy', 'privacy', '/privacy'),
                Link::create('Terms of Service', 'terms', '/terms'),
                Link::create('Login', 'login', '/login'),
                Link::create('Register', 'register', '/signup'),
            ],
            'fr' => [
                Link::create('Accueil', 'home', '/'),
                Link::create('À propos', 'about', '/aboutus'),
                Link::create('Blogs', 'post', '/blogs'),
                Link::create('Contact', 'contact', '/contact'),
                Link::create('Politique de confidentialité', 'privacy', '/privacy'),
                Link::create('Conditions d\'utilisation', 'terms', '/terms'),
                Link::create('S\'identifier', 'login', '/login'),
                Link::create('S\'inscrire', 'register', '/signup'),
            ],
            'es' => [
                Link::create('Inicio', 'home', '/'),
                Link::create('Acerca de', 'about', '/aboutus'),
                Link::create('Blogs', 'post', '/blogs'),
                Link::create('Contacto', 'contact', '/contact'),
                Link::create('Política de privacidad', 'privacy', '/privacy'),
                Link::create('Términos de servicio', 'terms', '/terms'),
                Link::create('Iniciar sesión', 'login', '/login'),
                Link::create('Registrarse', 'register', '/signup'),
            ],
        ]);

        $this->migrator->add('footer.link_name', [
            'en' => 'Quick Links',
            'fr' => 'Liens Rapides',
            'es' => 'Enlaces Rápidos'
        ]);

        // info
        $this->migrator->add('footer.info', [
            'en' => [
                Info::create('Email', 'mail', 'mailto:test@gmail.com', 'contact@example.com'),
                Info::create('Phone', 'phone', '+1234567890', '+152 534-468-854'),
                Info::create('Address', 'map-pin', '123 Street, City, Country', 'Suite 558,  Houston, USA 485'),
            ],
            'fr' => [
                Info::create('Email', 'mail', 'mailto:test@gmail.com', 'contact@example.com'),
                Info::create('Phone', 'phone', '+1234567890', '+152 534-468-854'),
                Info::create('Address', 'map-pin', '123 Street, City, Country', 'Suite 558,  Houston, USA 485'),
            ],
            'es' => [
                Info::create('Email', 'mail', 'mailto:test@gmail.com', 'contact@example.com'),
                Info::create('Phone', 'phone', '+1234567890', '+152 534-468-854'),
                Info::create('Address', 'map-pin', '123 Street, City, Country', 'Suite 558,  Houston, USA 485'),
            ],
        ]);

        $this->migrator->add('footer.info_name', [
            'en' => 'Contact Info',
            'fr' => 'Info Contact',
            'es' => 'Información de Contacto'
        ]);
        $this->migrator->add('footer.info_desc', [
            'en' => 'Contact us anytime !',
            'fr' => 'Contactez-nous à tout moment !',
            'es' => '¡Contáctenos en cualquier momento !'
        ]);

        // newsletter
        $this->migrator->add('footer.newsletter', [
            'en' => Newsletter::create('Subscribe to our newsletter', 'Subscribe to our newsletter and get latest news and updates.'),
            'fr' => Newsletter::create('Abonnez-vous à notre newsletter', 'Abonnez-vous à notre newsletter et obtenez les dernières nouvelles et mises à jour.'),
            'es' => Newsletter::create('Suscríbete a nuestro boletín', 'Suscríbete a nuestro boletín y recibe las últimas noticias y actualizaciones.'),
        ]);

        $this->migrator->add('footer.newsletter_name', [
            'en' => 'Newsletter',
            'fr' => 'Bulletin',
            'es' => 'Boletín'
        ]);

        $this->migrator->add('footer.newsletter_email', 'test@gmail.com');
        $this->migrator->add('footer.newsletter_button', [
            'en' => 'Subscribe',
            'fr' => 'Souscrire',
            'es' => 'Suscribirse'
        ]);

        // newsletter label
        $this->migrator->add('footer.newsletter_label', [
            'en' => 'Enter your email address',
            'fr' => 'Entrez votre adresse e-mail',
            'es' => 'Ingrese su dirección de correo electrónico'
        ]);
    }
};
class Link
{
    public static function create($title, $url, $type = 'link', $newTab = false, $active = true)
    {
        return [
            'title' => $title,
            'type' => $type,
            'url' => $url,
            'type' => $type,
            'new_tab' => $newTab,
            'active' => $active,
        ];
    }
}

class Info
{
    public static function create($title, $icon, $value, $description, $active = true)
    {
        return [
            'title' => $title,
            'icon' => $icon,
            'value' => $value,
            'description' => $description,
            'active' => $active,
        ];
    }
}

class Newsletter
{
    public static function create($title, $description, $active = true)
    {
        return [
            'title' => $title,
            'description' => $description,
        ];
    }
}

