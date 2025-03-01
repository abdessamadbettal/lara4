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
use Filament\Forms\Components\TagsInput;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Grid::make([
                'default' => 1,
                'lg' => 3,
            ])->schema([
                // Main content area (spans 2 columns)
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Main Content')
                        ->description('Create engaging, SEO-optimized content')
                        ->schema([
                            TextInput::make('name')
                                ->label('Post Title')
                                ->helperText(str('✨ Tips for SEO-friendly titles:
                                - Use keywords near the beginning
                                - Keep it under 60 characters
                                - Include your main keyword
                                - Make it compelling')->inlineMarkdown()->toHtmlString())
                                ->translatable(true, null, [
                                    'en' => ['string', 'max:60', 'min:10'],
                                    'es' => ['string', 'max:60', 'min:10'],
                                    'fr' => ['string', 'max:60', 'min:10'],
                                ])
                                ->columnSpanFull(),

                            TextInput::make('slug')
                                ->label('URL Slug')
                                ->hiddenOn(['create'])
                                    ->helperText(str('✨ URL-friendly version of the title (auto-generated)')->inlineMarkdown()->toHtmlString())
                                    ->translatable(
                                        true,
                                        null,
                                        [
                                            'en' => ['string', 'max:255', 'min:10', 'regex:/^[a-zA-Z0-9-_]+$/'],
                                            'es' => ['string', 'max:255', 'min:10', 'regex:/^[a-zA-Z0-9-_]+$/'],
                                            'fr' => ['string', 'max:255', 'min:10', 'regex:/^[a-zA-Z0-9-_]+$/'],
                                        ]
                                    )
                                ->columnSpanFull(),

                            Translate::make()
                                ->locales(['en', 'es', 'fr'])
                                ->schema([
                                    Forms\Components\MarkdownEditor::make('content')
                                        ->label('Article Content')
                                        ->helperText(str('✨ Content optimization tips:
                                        - Use headings (H2, H3) to structure content
                                        - Dont use H1 for headings bcs article title is H1
                                        - Include keywords naturally
                                        - Aim for 300+ words
                                        - Add internal/external links
                                        - Use bullet points for readability')->inlineMarkdown()->toHtmlString())
                                        ->disableToolbarButtons(['table'])
                                        ->columnSpanFull()
                                        ->required(),
                                ])
                                ->columnSpanFull()
                                ->suffixLocaleLabel(),
                        ]),
                ])->columnSpan(2),

                // Sidebar (spans 1 column)
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('SEO Metadata')
                        ->description('Optimize your content for search engines')
                        ->schema([
                            TagsInput::make('keywords')
                                ->label('Focus Keywords')
                                ->helperText(str('✨ Keyword best practices:
                                - Include 1 primary keyword
                                - Add 2-3 related keywords
                                - Use specific long-tail keywords
                                - Match search intent')->inlineMarkdown()->toHtmlString())
                                ->splitKeys(['Tab', ', '])
                                ->separator(',')
                                ->translatable(true),

                            Forms\Components\TextInput::make('time_to_read')
                                ->label('Reading Time (minutes)')
                                ->helperText('Helps users decide whether to read now or save for later')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(60)
                                ->required(),
                        ]),

                    Forms\Components\Section::make('Featured Image')
                        ->description('Visual content improves engagement')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('thumbnail')
                                ->label('Cover Image')
                                ->helperText(str('✨ Image optimization tips:
                                - Use 1200×800px size
                                - Add descriptive alt text
                                - Compress without quality loss
                                - Use relevant images')->inlineMarkdown()->toHtmlString())
                                ->image()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('3:2')
                                ->required()
                                ->collection('thumbnail'),
                        ]),

                    Forms\Components\Section::make('Categorization')
                        ->description('Help users find related content')
                        ->schema([
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->helperText('Choose the most relevant category')
                                ->searchable()
                                ->preload()
                                ->required(),

                            SpatieTagsInput::make('tags')
                                ->label('Topic Tags')
                                ->helperText(str('✨ Tagging tips:
                                - Use relevant topics
                                - Include industry terms
                                - Add related themes
                                - Be specific')->inlineMarkdown()->toHtmlString())
                                ->required(),
                        ]),

                    Forms\Components\Section::make('Publishing')
                        ->schema([
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->helperText('Make this post visible to readers')
                                ->default(true),

                            Forms\Components\Toggle::make('is_featured')
                                ->label('Featured Post')
                                ->helperText('Highlight important content on homepage'),

                            Forms\Components\DateTimePicker::make('published_at')
                                ->label('Publish Date')
                                ->helperText('Schedule or backdate your post')
                                ->required(),
                        ]),
                ])->columnSpan(1),
            ]),
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
