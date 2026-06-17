<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $title = 'Roles';

    protected static ?string $navigationGroup = 'Administración';

    protected static ?string $pluralModelLabel = 'Roles';

    protected static ?string $modelLabel = 'Rol';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nombre del rol')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            CheckboxList::make('permissions')
                ->label('Permisos')
                ->relationship('permissions', 'name')
                ->columns(2)
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Rol')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('permissions.name')
                    ->label('Permisos')
                    ->badge()
                    ->separator(', ')
                    ->limit(50),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('roles.manage');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('roles.manage');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('roles.manage');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('roles.manage');
    }
}
