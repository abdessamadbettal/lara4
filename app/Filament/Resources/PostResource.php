<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Filament\Forms\Components\SpatieTagsInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Post Details')->schema([
                    TextInput::make('name')
                        ->label('The Name of the Post')
                        ->helperText(str('✨ pls provide a unique name and should be **SEO** friendly and should be **unique for each language**.')->inlineMarkdown()->toHtmlString())
                        ->translatable(true, null, [
                            'en' => ['required', 'string', 'max:255', 'min:10'],
                            'es' => ['required', 'string', 'max:255', 'min:10'],
                            'fr' => ['required', 'string', 'max:255', 'min:10'],
                        ]),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->hiddenOn(['create'])
                        ->helperText(str('✨ pls provide a unique slug and should be **SEO** friendly and separated by `-`  and should be **unique for each language** and the characters should be **alphanumeric** and `-` and `_` only.')->inlineMarkdown()->toHtmlString())
                        ->translatable(true
                        , null, [
                            'en' => ['required', 'string', 'max:255', 'min:10', 'regex:/^[a-zA-Z0-9-_]+$/'],
                            'es' => ['required', 'string', 'max:255', 'min:10', 'regex:/^[a-zA-Z0-9-_]+$/'],
                            'fr' => ['required', 'string', 'max:255', 'min:10', 'regex:/^[a-zA-Z0-9-_]+$/'],
                        ]),
                    Forms\Components\Select::make('author_id')
                        ->relationship('author', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    SpatieTagsInput::make('tags')->label('Tags')->required(),
                    Forms\Components\TextInput::make('time_to_read')
                        ->label('Time to read (in minutes)')
                        ->type('number')
                        ->required(),
                ])->columns(2),
                Translate::make()->locales(['en', 'es','fr'])
                    ->schema([
                        Forms\Components\MarkdownEditor::make('content')
                            ->disableToolbarButtons(['table'])
                            ->columnSpanFull()
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->suffixLocaleLabel(),
                Forms\Components\Section::make('Image')->schema([
                    SpatieMediaLibraryFileUpload::make('thumbnail')
                        ->label('thumbnail cover (recommended size: height: 800px, width: 1200px)')
                        ->image()
                        ->required()
                        ->columnSpanFull()
                        ->collection('thumbnail'),
                ])->columns(2),
                Forms\Components\Toggle::make('is_published')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->collection('thumbnail'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
