<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;


return new class extends SettingsMigration
{
    public function up(): void
    {
        // contact
        $this->migrator->add('contact.email', 'test@gmail.com');
        $this->migrator->add('contact.button_text', [
            'en' => 'Contact Us',
            'es' => 'Contáctenos',
            'fr' => 'Nous contacter',
        ]);

        $this->migrator->add('contact.label', [
            'en' => 'Get in touch !',
            'es' => '¡Ponte en contacto!',
            'fr' => 'Entrer en contact !',
        ]);

        $this->migrator->add('contact.google_map_iframe', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13861.504838868728!2d-9.03342255!3d32.73581095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdaead45ca9c2d35%3A0x158c4f72ead2db52!2sOualidia!5e1!3m2!1sen!2sma!4v1727622300949!5m2!1sen!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');

            $this->migrator->add('contact.info', [
            'en' => [
                ContactInfo::create('Phone', 'phone', '+1234567890', 'tel:+1234567890', 'Call us anytime'),
                ContactInfo::create('Email', 'mail', 'abdessamadbattal@gmail.com', 'mailto:abdessamadbattal@gmail.com', 'Send us an email'),
                ContactInfo::create('Address', 'map-pin', '123 Street, City, Country', 'https://maps.app.goo.gl/nAeytqD2351v6wzW6', 'Visit our office'),
            ],
            'es' => [
                ContactInfo::create('Teléfono', 'phone', '+1234567890', 'tel:+1234567890', 'Llámenos en cualquier momento'),
                ContactInfo::create('Correo electrónico', 'envelope', 'abdessamadbattal@gmail.com', 'mailto:abdessamadbattal@gmail.com', 'Envíenos un correo electrónico'),
                ContactInfo::create('Dirección', 'map-marker-alt', '123 Street, City, Country', 'https://goo.gl/maps/1', 'Visite nuestra oficina'),
            ],
            'fr' => [
                ContactInfo::create('Téléphone', 'phone', '+1234567890', 'tel:+1234567890', 'Appelez-nous à tout moment'),
                ContactInfo::create('Email', 'envelope', 'abdessamadbattal@gmail.com', 'mailto:abdessamadbattal@gmail.com', 'Envoyez-nous un email'),
                ContactInfo::create('Adresse', 'map-marker-alt', '123 Street, City, Country', 'https://goo.gl/maps/1', 'Visitez notre bureau'),
            ],
        ]);
    }
};
class ContactInfo
{
    public static function create($name, $icon, $value, $link, $description)
    {
        return [
            'name' => $name,
            'icon' => $icon,
            'value' => $value,
            'link' => $link,
            'description' => $description,
        ];
    }
}

