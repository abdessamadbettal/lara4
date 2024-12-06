<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\PrivacySettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManagePrivacy extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-eye-slash';

    protected static string $settings = PrivacySettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('The About Page')->schema([
                TranslatableContainer::make(
                Forms\Components\TextInput::make('title')
                    ->required(),
                    )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
                TranslatableContainer::make(
                   Forms\Components\MarkdownEditor::make('content')
                   ->disableToolbarButtons(['table'])
                       ->columnSpanFull()
                       ->required(),
                )
                ->columnSpanFull()
                ->requiredLocales(['en', 'fr', 'es']),
                 ])->columns(2),

        ]);
    }
}
