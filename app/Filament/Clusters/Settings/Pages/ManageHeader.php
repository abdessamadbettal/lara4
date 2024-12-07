<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\HeaderSettings;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;
use Filament\Pages\SettingsPage;

class ManageHeader extends SettingsPage
{
    use Translatable;
    protected static ?string $navigationIcon = 'heroicon-o-window';

    protected static string $settings = HeaderSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                                ->visible(fn(Get $get): bool => $get('type') == 'link')
                                ->required(),
                            Toggle::make('new_tab')->default(true),
                            Toggle::make('is_dropdown')
                                ->live()
                                ->default(false),
                            Repeater::make('dropdown')
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
                                            }  elseif ($state === 'post') {
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
                                    Toggle::make('is_dropdown')
                                        ->live()
                                        ->default(false),

                                    Repeater::make('dropdown')
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
                                                    }),
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

                                        ])
                                        ->visible(fn(Get $get): bool => $get('is_dropdown'))
                                        ->columnSpanFull(),


                                ])
                                ->visible(fn(Get $get): bool => $get('is_dropdown'))
                                ->columnSpanFull(),
                        ])->columnSpanFull(),
                )
                    ->columnSpanFull()
                    ->requiredLocales(['en', 'fr', 'es']),
            ]);
    }
}
