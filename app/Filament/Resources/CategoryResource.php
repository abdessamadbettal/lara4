<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                        Forms\Components\Section::make('Category Details')
                            ->description('Basic category information')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Category Name')
                                    ->helperText('Enter a descriptive name for the category')
                                    ->translatable(true)
                                    // ->required()
                                    ->columnSpanFull(),

                                TextInput::make('description')
                                    ->label('Description')
                                    ->helperText('Brief description of what this category contains')
                                    ->translatable(true)
                                    ->columnSpanFull(),

                                TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->helperText('Auto-generated from name, can be customized')
                                    ->translatable(true)
                                    ->hiddenOn('create')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(2),

                    // Sidebar (spans 1 column)
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Organization')
                            ->schema([
                                Forms\Components\Select::make('parent_id')
                                    ->label('Parent Category')
                                    ->relationship('parent', 'name')
                                    ->helperText('Optional: Select a parent category')
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\TextInput::make('order_column')
                                    ->label('Display Order')
                                    ->helperText('Lower numbers appear first')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Visibility')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active Status')
                                    ->helperText('Enable or disable this category')
                                    ->default(true)
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Category Image')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('thumbnail')
                                    ->label('Category Image')
                                    ->helperText('Upload a representative image')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->collection('thumbnail'),
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
                    ->label('Image')
                    ->collection('thumbnail')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->size(40),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Parent Category')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('order_column')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order_column')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Parent Category')
                    ->relationship('parent', 'name')
                    ->multiple()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
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
                ]),
            ])
            ->emptyStateHeading('No categories yet')
            ->emptyStateDescription('Start by creating your first category.')
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->reorderable('order_column')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
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