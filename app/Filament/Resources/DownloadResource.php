<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Models\Download;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationGroup = 'Descargas';

    protected static ?string $navigationLabel = 'Archivos';

    protected static ?string $modelLabel = 'Descarga';

    protected static ?string $pluralModelLabel = 'Descargas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información principal')
                    ->schema([
                        Forms\Components\Select::make('download_category_id')
                            ->label('Categoría')
                            ->relationship('category', 'dcat_name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('down_title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('down_slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('down_slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Textarea::make('down_description')
                            ->label('Descripción')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('down_status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'publicado' => 'Publicado',
                                'inactivo' => 'Inactivo',
                            ])
                            ->default('borrador')
                            ->required(),

                        Forms\Components\DateTimePicker::make('down_published_at')
                            ->label('Fecha de publicación'),
                        Forms\Components\DateTimePicker::make('down_expires_at')
                            ->label('Fecha de expiración'),


                    ])
                    ->columns(2),

                Forms\Components\Section::make('Archivo')
                    ->schema([
                        Forms\Components\FileUpload::make('down_file')
                            ->label('Archivo')
                            ->disk('public')
                            ->directory('downloads')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->maxSize(10240)
                            ->downloadable()
                            ->openable()
                            ->required()
                            ->columnSpanFull()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('down_published_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('down_title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.dcat_name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('down_status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'publicado' => 'success',
                        'borrador' => 'warning',
                        'inactivo' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('down_published_at')
                    ->label('Publicado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('down_expires_at')
                    ->label('Expirado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('down_file_size')
                    ->label('Tamaño')
                    ->formatStateUsing(fn($state) => round($state / 1024 / 1024, 2) . ' MB'),

                Tables\Columns\TextColumn::make('down_file_type')
                    ->label('Tipo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('down_status')
                    ->label('Estado')
                    ->options([
                        'borrador' => 'Borrador',
                        'publicado' => 'Publicado',
                        'inactivo' => 'Inactivo',
                    ]),

                Tables\Filters\SelectFilter::make('download_category_id')
                    ->label('Categoría')
                    ->relationship('category', 'dcat_name'),
            ])
            ->actions([
                Tables\Actions\Action::make('descargar')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Download $record) => asset('storage/' . $record->down_file))
                    ->openUrlInNewTab(),

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
            'index' => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownload::route('/create'),
            'edit' => Pages\EditDownload::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('downloads.view');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('downloads.create');
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('downloads.update');
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('downloads.delete');
    }
}