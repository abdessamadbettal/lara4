<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\SocialSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use phpDocumentor\Reflection\Types\Boolean;

class ManageSocial extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-rss';

    protected static string $settings = SocialSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('socials')
                    ->schema([
                        TextInput::make('icon')
                        ->placeholder('Pls use feathericons class')
                        ->label('Social icon (feathericons)')
                        ->required(),
                        TextInput::make('url')
                            ->required(),
                        // icon_url
                        TextInput::make('icon_url')
                            ->label('Icon URL (used for email template)')
                            ->required(),
                        Toggle::make('active')->default(true),
                    ])->columnSpanFull(),
            ]);
    }
}
