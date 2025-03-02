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
                        Forms\Components\Section::make('SEO Title & Description')
                            ->description('These elements appear in search results')
                            ->schema([
                                TextInput::make('name')
                                    ->label('SEO Title')
                                    ->helperText(str('✨ Title Optimization Tips:
                                    - Start with main keyword (most important)
                                    - Keep between 50-60 characters
                                    - Include your brand name if space allows
                                    - Use power words (e.g., Ultimate, Guide, Best)
                                    - Match search intent')->inlineMarkdown()->toHtmlString())
                                    ->translatable(true, null, [
                                        'en' => ['string', 'max:60', 'min:10'],
                                        'es' => ['string', 'max:60', 'min:10'],
                                        'fr' => ['string', 'max:60', 'min:10'],
                                    ])
                                    ->columnSpanFull(),
    
                                TextInput::make('meta_description')
                                    ->label('Meta Description')
                                    ->helperText(str('✨ Description Best Practices:
                                    - Include primary & secondary keywords
                                    - Keep between 150-160 characters
                                    - Add a clear call-to-action
                                    - Match title intent
                                    - Make it compelling & clickable')->inlineMarkdown()->toHtmlString())
                                    ->translatable(true)
                                    ->columnSpanFull(),
    
                                TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->hiddenOn(['create'])
                                    ->helperText(str('✨ URL Optimization Tips:
                                    - Include main keyword
                                    - Keep it short (3-5 words)
                                    - Use hyphens between words
                                    - Avoid numbers unless necessary
                                    - Avoid updating once published bcs can break links
                                    - Make it readable')->inlineMarkdown()->toHtmlString())
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
                            ]),
    
                                Translate::make()
                                    ->locales(['en', 'es', 'fr'])
                                    ->schema([
                                        Forms\Components\MarkdownEditor::make('content')
                                            ->label('Article Content')
                                            ->helperText(str('✨ Content SEO Guidelines:
                                            - Write 1500+ words for comprehensive coverage
                                            - Use H2s & H3s with keywords
                                            - Include primary keyword in first 100 words
                                            - Add 2-3 internal links
                                            - Add 2-3 authoritative external links
                                            - Use bullet points & short paragraphs
                                            - Include relevant images with alt text
                                            - Optimize for featured snippets
                                            - Answer common user questions
                                            - Use transition words for readability')->inlineMarkdown()->toHtmlString())
                                            ->disableToolbarButtons(['table'])
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->suffixLocaleLabel(),
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
                                - Compress without quality loss
                                - Use relevant images')->inlineMarkdown()->toHtmlString())
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('3:2')
                                    ->required()
                                    ->collection('thumbnail'),
                            ]),

                            Forms\Components\Section::make('Content Organization')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->helperText('Group similar content for better SEO')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                    // author_id
                                Forms\Components\Select::make('author_id')
                                    ->relationship('author', 'name')
                                    ->helperText('Select the author of this post')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
    
                                SpatieTagsInput::make('tags')
                                    ->label('Topic Tags')
                                    ->helperText(str('✨ Topic Organization:
                                    - Use relevant industry terms
                                    - Include keyword variations
                                    - Add related subtopics
                                    - Stay consistent with tags')->inlineMarkdown()->toHtmlString())
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Publishing Settings')
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('Published')
                                    ->helperText('Make visible to search engines')
                                    ->default(true),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Featured Content')
                                    ->helperText('Prioritize in sitemaps'),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->default(now())
                                    ->helperText('Fresh content ranks better')
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
            // Thumbnail & Basic Info
            SpatieMediaLibraryImageColumn::make('thumbnail')
                ->label('Cover')
                ->collection('thumbnail')
                ->circular()
                ->defaultImageUrl(url('/images/placeholder.png'))
                ->size(40),
                
            Tables\Columns\TextColumn::make('name')
                ->label('Title')
                ->searchable()
                ->sortable()
                ->limit(50)
                ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                    $state = $column->getState();
                    return strlen($state) > 50 ? $state : null;
                }),

            // Author & Category
            Tables\Columns\TextColumn::make('author.name')
                ->label('Author')
                ->searchable()
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->searchable()
                ->sortable()
                ->toggleable(),

            // SEO & Analytics
            Tables\Columns\TextColumn::make('keywords')
                ->label('Keywords')
                ->searchable()
                ->toggleable()
                ->limit(30),

            Tables\Columns\TextColumn::make('time_to_read')
                ->label('Read Time')
                ->suffix(' min')
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('views_count')
                ->label('Views')
                ->sortable()
                ->toggleable(),

            // Status Indicators
            Tables\Columns\IconColumn::make('is_published')
                ->label('Status')
                ->boolean()
                ->sortable()
                ->toggleable()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),

            Tables\Columns\IconColumn::make('is_featured')
                ->label('Featured')
                ->boolean()
                ->sortable()
                ->toggleable()
                ->trueIcon('heroicon-o-star')
                ->falseIcon('heroicon-o-x-mark')
                ->trueColor('warning'),

            // Dates
            Tables\Columns\TextColumn::make('published_at')
                ->label('Published')
                ->dateTime('M j, Y')
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Last Updated')
                ->dateTime('M j, Y')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->defaultSort('published_at', 'desc')
        ->filters([
            Tables\Filters\TrashedFilter::make(),
            Tables\Filters\SelectFilter::make('category')
                ->relationship('category', 'name')
                ->multiple()
                ->preload(),
            Tables\Filters\SelectFilter::make('author')
                ->relationship('author', 'name')
                ->multiple()
                ->preload(),
            Tables\Filters\TernaryFilter::make('is_published')
                ->label('Published Status')
                ->placeholder('All Posts')
                ->trueLabel('Published Posts')
                ->falseLabel('Draft Posts'),
            Tables\Filters\TernaryFilter::make('is_featured')
                ->label('Featured Status'),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\BulkAction::make('togglePublish')
                    ->label('Toggle Publication')
                    ->icon('heroicon-o-globe-alt')
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update(['is_published' => !$record->is_published]);
                        }
                    }),
            ]),
        ])
        ->emptyStateHeading('No posts yet')
        ->emptyStateDescription('Start creating your first blog post.')
        ->emptyStateIcon('heroicon-o-document-text')
        ->defaultPaginationPageOption(25)
        ->reorderable('sort')
        ->striped();
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
