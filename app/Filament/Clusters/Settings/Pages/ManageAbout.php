<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\AboutSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManageAbout extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static string $settings = AboutSettings::class;

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
                        Forms\Components\TextInput::make('desc')
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

                Forms\Components\Section::make('Visitors')->schema([
                    Forms\Components\TextInput::make('visitors_number')
                        ->label('Number of visitors')
                        ->required(),
                    TranslatableContainer::make(
                        Forms\Components\TextInput::make('visitors_text')
                            ->label('Visitors text')
                            ->required(),
                    )
                        ->columnSpanFull()
                        ->requiredLocales(['en', 'fr', 'es']),
                    Forms\Components\TextInput::make('visitors_icon')
                        ->placeholder('Pls use feathericons class')
                        ->label('Visitors icon (feathericons)')
                        ->required(),
                ])->columns(2),

                Forms\Components\Section::make('Tours')->schema([
                    Forms\Components\TextInput::make('tours_number')
                        ->label('Number of tours')
                        ->required(),
                    TranslatableContainer::make(
                        Forms\Components\TextInput::make('tours_text')
                            ->label('Tours text')
                            ->required(),
                    )
                        ->columnSpanFull()
                        ->requiredLocales(['en', 'fr', 'es']),
                    Forms\Components\TextInput::make('tours_icon')
                        ->placeholder('Pls use feathericons class')
                        ->label('Tours icon (feathericons)')
                        ->required(),
                ])->columns(2),

            ]);
    }
}
