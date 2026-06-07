<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('con_name')
                    ->required(),
                Forms\Components\TextInput::make('con_email')
                    ->email(),
                Forms\Components\TextInput::make('con_phone')
                    ->tel(),
                Forms\Components\TextInput::make('con_subject'),
                Forms\Components\Textarea::make('con_message')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('con_status')
                    ->required(),
                Forms\Components\TextInput::make('con_ip'),
                Forms\Components\Textarea::make('con_user_agent')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('con_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('con_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('con_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('con_subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('con_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('con_ip')
                    ->searchable(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
