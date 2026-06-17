<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?string $navigationLabel = 'Noticias / Posts';

    protected static ?string $modelLabel = 'Post';

    protected static ?string $pluralModelLabel = 'Posts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información principal')
                    ->schema([
                        Forms\Components\Select::make('post_category_id')
                            ->label('Categoría')
                            ->relationship('category', 'pcat_name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('post_title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('post_slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('post_slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Select::make('post_status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'publicado' => 'Publicado',
                                'inactivo' => 'Inactivo',
                            ])
                            ->default('borrador')
                            ->required(),

                        Forms\Components\DateTimePicker::make('post_published_at')
                            ->label('Fecha de publicación'),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Contenido')
                    ->schema([
                        Forms\Components\Textarea::make('post_summary')
                            ->label('Resumen')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('post_content')
                            ->label('Contenido')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('post_image')
                            ->label('Imagen principal')
                            ->disk('public')
                            ->directory('posts')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('post_meta_title')
                            ->label('Meta título')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('post_meta_description')
                            ->label('Meta descripción')
                            ->rows(3)
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('post_published_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('post_image')
                    ->label('Imagen')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('post_title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.pcat_name')
                    ->label('Categoría')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('post_status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'publicado' => 'success',
                        'borrador' => 'warning',
                        'inactivo' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('post_published_at')
                    ->label('Publicado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('post_status')
                    ->label('Estado')
                    ->options([
                        'borrador' => 'Borrador',
                        'publicado' => 'Publicado',
                        'inactivo' => 'Inactivo',
                    ]),

                Tables\Filters\SelectFilter::make('post_category_id')
                    ->label('Categoría')
                    ->relationship('category', 'pcat_name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('posts.view');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('posts.create');
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('posts.update');
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('posts.delete');
    }
}