<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\TermSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManageTerm extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-bars-3-center-left';

    protected static string $settings = TermSettings::class;

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
