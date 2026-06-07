<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?string $navigationLabel = 'Galerías';

    protected static ?string $modelLabel = 'Galería';

    protected static ?string $pluralModelLabel = 'Galerías';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información de la galería')
                    ->schema([

                        TextInput::make('gal_title')
                            ->label('Título')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('gal_slug', Str::slug($state));
                            }),

                        TextInput::make('gal_slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('gal_description')
                            ->label('Descripción')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('gal_status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'publicado' => 'Publicado',
                                'inactivo' => 'Inactivo',
                            ])
                            ->default('borrador')
                            ->required(),

                        Forms\Components\DateTimePicker::make('gal_published_at')
                            ->label('Fecha publicación'),

                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('gal_title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Elementos')
                    ->counts('items'),

                Tables\Columns\TextColumn::make('gal_status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'publicado' => 'success',
                        'borrador' => 'warning',
                        'inactivo' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('gal_published_at')
                    ->label('Publicado')
                    ->dateTime('d/m/Y'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gal_status')
                    ->options([
                        'borrador' => 'Borrador',
                        'publicado' => 'Publicado',
                        'inactivo' => 'Inactivo',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
