<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\FooterSettings;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ManageFooter extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static string $settings = FooterSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Footer Text')
                    ->description('Footer Text & Copy Right')
                    ->schema([
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('footer_text')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('copy_right')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                    ]),

                Section::make('Newsletter')
                    ->description('Newsletter Section')
                    ->schema([
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('newsletter_name')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                        Forms\Components\TextInput::make('newsletter_email')
                            ->columnSpanFull()
                            ->required(),
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('newsletter_label')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                        TranslatableContainer::make(
                            Forms\Components\KeyValue::make('newsletter')
                                ->columnSpanFull()
                                ->required()
                                ->editableKeys(false)
                                ->addable(false)
                                ->deletable(false)
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                    ]),

                Section::make('Footer Links')
                    ->description('Footer Links')
                    ->schema([
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('link_name')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                        TranslatableContainer::make(
                            Repeater::make('links')
                                ->schema([
                                    TextInput::make('title')->required(),
                                    Select::make('type')
                                        ->options([
                                            'text' => 'Text',
                                            'link' => 'Link',
                                            'category' => 'Category',
                                            'home' => 'Home',
                                            'post' => 'Post',
                                            'login' => 'Login',
                                            'register' => 'Register',
                                            'terms' => 'Terms',
                                            'privacy' => 'Privacy',
                                            'about' => 'About',
                                            'contact' => 'Contact',
                                        ])
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            if ($state === 'login') {
                                                $set('url', '/login');
                                            } elseif ($state === 'register') {
                                                $set('url', '/signup');
                                            } elseif ($state === 'terms') {
                                                $set('url', '/terms');
                                            } elseif ($state === 'privacy') {
                                                $set('url', '/privacy');
                                            } elseif ($state === 'about') {
                                                $set('url', '/aboutus');
                                            } elseif ($state === 'contact') {
                                                $set('url', '/contact');
                                            } elseif ($state === 'category') {
                                                $set('url', '/category');
                                            } elseif ($state === 'post') {
                                                $set('url', '/blogs');
                                            } elseif ($state === 'home') {
                                                $set('url', '/');
                                            }
                                        })
                                        ->live()
                                        ->required(),
                                    Select::make('category')
                                        ->options(fn() => \App\Models\Category::pluck('name', 'slug')->toArray())
                                        ->visible(fn(Get $get): bool => $get('type') == 'category')
                                        ->live()
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            $set('url', '/category/' . $state);
                                        })
                                        ->required(),
                                    Select::make('post')
                                        ->options(fn() => \App\Models\Post::pluck('name', 'slug')->toArray())
                                        ->visible(fn(Get $get): bool => $get('type') == 'post')
                                        ->live()
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            $set('url', '/post/' . $state);
                                        }),
                                    TextInput::make('url')
                                        ->visible(fn(Get $get): bool => $get('type') === 'link')
                                        ->required(),
                                    Toggle::make('new_tab')->default(true),
                                ])->columnSpanFull(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                    ]),


                Section::make('Footer Info')
                    ->description('Footer Info')
                    ->schema([
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('info_name')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                        TranslatableContainer::make(
                            Forms\Components\TextInput::make('info_desc')
                                ->required(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                        TranslatableContainer::make(
                            Repeater::make('info')
                                ->schema([
                                    TextInput::make('title')->required(),
                                    TextInput::make('description')->required(),
                                    TextInput::make('icon')
                                        ->placeholder('Pls use feathericons class')
                                        ->label('Icon (Feathericons)')
                                        ->required(),
                                    TextInput::make('value')->required(),
                                    Toggle::make('active')->default(true),
                                ])->columnSpanFull(),
                        )
                            ->columnSpanFull()
                            ->requiredLocales(['en', 'fr', 'es']),
                    ]),




            ]);
    }
}
