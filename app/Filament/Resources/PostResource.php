<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('post_category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('post_title')
                    ->required(),
                Forms\Components\TextInput::make('post_slug')
                    ->required(),
                Forms\Components\TextInput::make('post_summary'),
                Forms\Components\Textarea::make('post_content')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('post_image')
                    ->image(),
                Forms\Components\TextInput::make('post_status')
                    ->required(),
                Forms\Components\DateTimePicker::make('post_published_at'),
                Forms\Components\DateTimePicker::make('post_expires_at'),
                Forms\Components\TextInput::make('post_meta_title'),
                Forms\Components\Textarea::make('post_meta_description')
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('post_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('post_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_summary')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('post_image'),
                Tables\Columns\TextColumn::make('post_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('post_expires_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('post_meta_title')
                    ->searchable(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
