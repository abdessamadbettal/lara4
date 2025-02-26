<?php

namespace App\Filament\Clusters\Settings\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use App\Settings\HeroSettings;
use Forms\Components\Textarea;
use Filament\Pages\SettingsPage;
use App\Filament\Clusters\Settings;
use Filament\Forms\Components\Section;
use Filament\Resources\Concerns\Translatable;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;


class ManageHero extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static string $settings = HeroSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Image and Video For Hero')
                    ->description('Upload an image and a video for the hero section.')
                    ->schema([
                        Section::make('Youtube')
                            ->description('You can get the iframe from Youtube by clicking on the share button and then on the embed map button.')
                            ->schema([
                                Forms\Components\Textarea::make('youtube_iframe')
                                    ->columnSpanFull()
                                    ->label('Youtube Iframe')
                                    ->required(),
                            ]),
                        Forms\Components\FileUpload::make('image')
                            ->label('Image (recommended size 1920x1080 pixels)')
                            ->image()
                            ->required()
                            ->disk('public'),
                    ]),
                TranslatableContainer::make(
                    Forms\Components\TextInput::make('title')
                        ->maxLength(255)
                        ->required()
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),
                TranslatableContainer::make(
                    Forms\Components\TextInput::make('subtitle')
                        ->maxLength(255)
                        ->required()
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),
                TranslatableContainer::make(
                    Forms\Components\Textarea::make('description')
                        ->required()
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),

            ]);
    }
}
