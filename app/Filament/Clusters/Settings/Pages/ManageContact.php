<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\ContactSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManageContact extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    protected static string $settings = ContactSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->columnSpanFull()
                    ->label('Email')
                    ->required(),
                TranslatableContainer::make(
                    Forms\Components\TextInput::make('button_text')
                        ->maxLength(255)
                        ->required()
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),
                TranslatableContainer::make(
                    Forms\Components\TextInput::make('label')
                        ->maxLength(255)
                        ->required()
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),
                Section::make('Google Map')
                    ->description('You can get the iframe from Google Maps by clicking on the share button and then on the embed map button.')
                    ->schema([
                        Forms\Components\Textarea::make('google_map_iframe')
                            ->columnSpanFull()
                            ->label('Google Map Iframe')
                            ->required(),
                    ]),
                TranslatableContainer::make(
                    Repeater::make('info')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Name')
                                ->required(),
                            Forms\Components\TextInput::make('icon')
                                ->placeholder('Pls use feathericons class')
                                ->label('Icon (feathericons)')
                                ->required(),
                            Forms\Components\TextInput::make('value')
                                ->label('Value')
                                ->required(),
                            Forms\Components\TextInput::make('link')
                                ->label('Link')
                                ->required(),
                            Forms\Components\TextInput::make('description')
                                ->label('Description')
                                ->required(),
                        ]),
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),

            ]);
    }
}
