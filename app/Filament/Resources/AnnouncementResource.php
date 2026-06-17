<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Set;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?string $navigationLabel = 'Anuncios';

    protected static ?string $modelLabel = 'Anuncio';

    protected static ?string $pluralModelLabel = 'Anuncios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del anuncio')
                    ->schema([
                        Forms\Components\TextInput::make('ann_title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('ann_slug', Str::slug($state));
                            }),

                        Forms\Components\Textarea::make('ann_description')
                            ->label('Descripción')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('ann_slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Select::make('ann_status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'publicado' => 'Publicado',
                                'inactivo' => 'Inactivo',
                            ])
                            ->default('borrador')
                            ->required(),

                        Forms\Components\DateTimePicker::make('ann_published_at')
                            ->label('Fecha de publicación'),

                        Forms\Components\DateTimePicker::make('ann_expires_at')
                            ->label('Fecha de vencimiento'),

                        Forms\Components\TextInput::make('ann_priority')
                            ->label('Prioridad')
                            ->numeric()
                            ->default(0),

                        Forms\Components\FileUpload::make('ann_image')
                            ->label('Imagen')
                            ->image()
                            ->disk('public')
                            ->directory('announcements')
                            ->imageEditor()
                            ->imageCropAspectRatio('3:2')
                            ->imageResizeMode('cover')
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('ann_image')
                    ->label('Imagen')
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('ann_title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ann_status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'publicado' => 'success',
                        'borrador' => 'warning',
                        'inactivo' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('ann_priority')
                    ->label('Prioridad')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ann_published_at')
                    ->label('Publicado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ann_expires_at')
                    ->label('Vence')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('ann_status')
                    ->label('Estado')
                    ->options([
                        'borrador' => 'Borrador',
                        'publicado' => 'Publicado',
                        'inactivo' => 'Inactivo',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('ann_priority', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'view' => Pages\ViewAnnouncement::route('/{record}'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('announcements.view');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('announcements.create');
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('announcements.update');
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('announcements.delete');
    }
}
