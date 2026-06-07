<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadCategoryResource\Pages;
use App\Models\DownloadCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class DownloadCategoryResource extends Resource
{
    protected static ?string $model = DownloadCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Descargas';

    protected static ?string $navigationLabel = 'Categorías';

    protected static ?string $modelLabel = 'Categoría de descarga';

    protected static ?string $pluralModelLabel = 'Categorías de descargas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la categoría')
                    ->schema([
                        Forms\Components\TextInput::make('dcat_name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('dcat_slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('dcat_slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Textarea::make('dcat_description')
                            ->label('Descripción')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('dcat_status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'publicado' => 'Publicado',
                                'inactivo' => 'Inactivo',
                            ])
                            ->default('publicado')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dcat_name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('downloads_count')
                    ->label('Descargas')
                    ->counts('downloads'),

                Tables\Columns\TextColumn::make('dcat_status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'publicado' => 'success',
                        'borrador' => 'warning',
                        'inactivo' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('dcat_status')
                    ->label('Estado')
                    ->options([
                        'borrador' => 'Borrador',
                        'publicado' => 'Publicado',
                        'inactivo' => 'Inactivo',
                    ]),
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
            'index' => Pages\ListDownloadCategories::route('/'),
            'create' => Pages\CreateDownloadCategory::route('/create'),
            'edit' => Pages\EditDownloadCategory::route('/{record}/edit'),
        ];
    }
}