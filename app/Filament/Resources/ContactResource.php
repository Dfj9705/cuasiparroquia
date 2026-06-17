<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $title = 'Mensajes de contacto';

    protected static ?string $navigationGroup = 'Administración';

    protected static ?string $pluralModelLabel = 'Mensajes de contacto';

    protected static ?string $modelLabel = 'Mensaje de contacto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('con_name')
                    ->label('Nombre')
                    ->disabled(),

                TextInput::make('con_email')
                    ->label('Correo')
                    ->disabled(),

                TextInput::make('con_phone')
                    ->label('Teléfono')
                    ->disabled(),

                TextInput::make('con_subject')
                    ->label('Asunto')
                    ->disabled(),

                Textarea::make('con_message')
                    ->label('Mensaje')
                    ->rows(8)
                    ->columnSpanFull()
                    ->disabled(),

                Select::make('con_status')
                    ->label('Estado')
                    ->options([
                        'nuevo' => 'Nuevo',
                        'leido' => 'Leído',
                        'respondido' => 'Respondido',
                        'archivado' => 'Archivado',
                    ])
                    ->required(),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([

                Tables\Columns\TextColumn::make('con_name')
                    ->label('Nombre')
                    ->searchable(),

                Tables\Columns\TextColumn::make('con_email')
                    ->label('Correo')
                    ->searchable(),

                Tables\Columns\TextColumn::make('con_subject')
                    ->label('Asunto')
                    ->searchable(),

                Tables\Columns\TextColumn::make('con_status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'nuevo' => 'danger',
                        'leido' => 'warning',
                        'respondido' => 'success',
                        'archivado' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Recibido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('con_status')
                    ->options([
                        'nuevo' => 'Nuevo',
                        'leido' => 'Leído',
                        'respondido' => 'Respondido',
                        'archivado' => 'Archivado',
                    ]),
            ])->actions([
                    Tables\Actions\Action::make('leido')
                        ->label('Marcar leído')
                        ->icon('heroicon-o-check')
                        ->action(function (Contact $record) {

                            $record->update([
                                'con_status' => 'leido',
                                'con_read_at' => now(),
                            ]);

                        })
                        ->visible(fn(Contact $record) => $record->con_status === 'nuevo'),
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

    public static function canCreate(): bool
    {
        return false;
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->can('contacts.view');
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
