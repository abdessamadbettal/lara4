<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Section;
use Filament\Resources\Concerns\Translatable;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManageGeneral extends SettingsPage
{
    use Translatable;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
        ->schema([


            Forms\Components\TextInput::make('site_email')
                ->label('Site Email')
                ->required(),
            Forms\Components\TextInput::make('site_phone')
                ->label('Site Phone')
                ->required(),
            Forms\Components\TextInput::make('site_address')
                ->label('Site Address')
                ->required(),
            Section::make('Site Logo')
                ->description('Site Logo Light & Dark (recommended size 133x28 pixels)')
                ->schema([
                    Forms\Components\FileUpload::make('site_logo_light')
                        ->image()
                        ->disk('public')
                        ,
                    Forms\Components\FileUpload::make('site_logo_dark')
                        ->image()
                        ->disk('public'),
                    // Forms\Components\FileUpload::make('site_favicon')
                    //     ->image()
                    //     ->disk('public'),
                    Forms\Components\FileUpload::make('site_order_confirmation_image')
                        ->label('Order Confirmation Image')
                        ->image()
                        ->disk('public'),
                ]),
            Forms\Components\TextInput::make('site_google_analytics')
                ->label('Site Google Analytics'),
            Forms\Components\TextInput::make('site_google_recaptcha')
                ->label('Site Google Recaptcha')
                ->required(),
            Forms\Components\TextInput::make('site_google_maps')
                ->label('Site Google Maps')
                ->required(),
            Forms\Components\Toggle::make('site_active')
                ->label('Site Active')
                ->required(),
            Forms\Components\TextInput::make('site_timezone')
                ->label('Site Timezone')
                ->required(),
            Forms\Components\TextInput::make('site_locale')
                ->label('Site Locale')
                ->required(),
            Forms\Components\TextInput::make('site_currency')
                ->label('Site Currency')
                ->required(),
            Forms\Components\TextInput::make('site_currency_symbol')
                ->label('Site Currency Symbol')
                ->required(),
            Forms\Components\TextInput::make('site_meta_robots')
                ->label('Site Meta Robots')
                ->required(),
            Forms\Components\TextInput::make('site_meta_googlebot')
                ->label('Site Meta Googlebot')
                ->required(),
            Forms\Components\TextInput::make('site_meta_bingbot')
                ->label('Site Meta Bingbot')
                ->required(),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('site_name')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('site_description')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
            TranslatableContainer::make(
                Forms\Components\TextInput::make('work_time')
                    ->maxLength(255)
                    ->required()
            )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),

        ]);
    }
}
