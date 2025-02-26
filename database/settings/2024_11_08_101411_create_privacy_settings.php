<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $content = <<<EOT
        # Overview :
        It seems that only *fragments* of the original text ~~remain~~ in the Lorem Ipsum texts used today. One may speculate that over the course of time certain letters were *added* or deleted at various positions within the text.

        In the 1960s, the text suddenly **became** known beyond the **professional** circle of typesetters and layout designers when it was used for Letraset sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text were subsequently included in DTP programmes such as PageMaker etc.

        There is now an **abundance** of readable dummy texts. These are usually used when a text is required purely to fill a space. These alternatives to the classic Lorem Ipsum texts are often amusing and tell short, funny or **nonsensical** stories.



        # We use your information to :
        * Digital Marketing Solutions for Tomorrow
        * Our Talented & Experienced Marketing Agency
        * Create your own skin to match your brand
        * Digital Marketing Solutions for Tomorrow
        * Create your own skin to match your brand
        * Our Talented & Experienced [Marketing Agency](https://github.com/abdessamadbettal)



        # Information Provided Voluntarily :
        In the 1960s, the text suddenly became known beyond the professional circle of typesetters and layout designers when it was used for **Letraset** sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text were subsequently included in DTP programmes such as PageMaker etc.

        > Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        EOT;

        $this->migrator->add('privacy.content', [
            'en' => $content,
            'fr' => $content,
            'es' => $content
        ]);

        $this->migrator->add('privacy.title', [
            'en' => 'Privacy Policy',
            'fr' => 'Politique de Confidentialité',
            'es' => 'Política de Privacidad'
        ]);
    }
};
