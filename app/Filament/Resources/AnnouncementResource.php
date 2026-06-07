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

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ann_title')
                    ->required(),
                Forms\Components\TextInput::make('ann_slug')
                    ->required(),
                Forms\Components\Textarea::make('ann_description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('ann_image')
                    ->image(),
                Forms\Components\TextInput::make('ann_status')
                    ->required(),
                Forms\Components\DateTimePicker::make('ann_published_at'),
                Forms\Components\DateTimePicker::make('ann_expires_at'),
                Forms\Components\TextInput::make('ann_priority')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('created_by')
                    ->numeric(),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ann_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ann_slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('ann_image'),
                Tables\Columns\TextColumn::make('ann_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ann_published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ann_expires_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ann_priority')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
