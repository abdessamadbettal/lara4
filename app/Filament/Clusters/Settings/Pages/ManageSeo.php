<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\SeoSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManageSeo extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static string $settings = SeoSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
        ->schema([

            TranslatableContainer::make(
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('meta_description')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('meta_keywords')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('meta_author')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('og_title')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('og_description')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('tw_title')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('tw_description')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
        ]);
    }
}
