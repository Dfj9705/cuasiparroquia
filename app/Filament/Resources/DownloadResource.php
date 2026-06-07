<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Filament\Resources\DownloadResource\RelationManagers;
use App\Models\Download;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('download_category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('down_title')
                    ->required(),
                Forms\Components\TextInput::make('down_slug')
                    ->required(),
                Forms\Components\Textarea::make('down_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('down_file')
                    ->required(),
                Forms\Components\TextInput::make('down_file_type'),
                Forms\Components\TextInput::make('down_file_size')
                    ->numeric(),
                Forms\Components\TextInput::make('down_status')
                    ->required(),
                Forms\Components\DateTimePicker::make('down_published_at'),
                Forms\Components\DateTimePicker::make('down_expires_at'),
                Forms\Components\TextInput::make('down_downloads_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('download_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('down_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('down_slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('down_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('down_file_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('down_file_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('down_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('down_published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('down_expires_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('down_downloads_count')
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
            'index' => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownload::route('/create'),
            'edit' => Pages\EditDownload::route('/{record}/edit'),
        ];
    }
}
