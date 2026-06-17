<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Configuración';

    protected static ?string $navigationLabel = 'Ajustes del sitio';

    protected static ?string $modelLabel = 'Ajuste del sitio';

    protected static ?string $pluralModelLabel = 'Ajustes del sitio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Información general')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('site_name')
                            ->label('Nombre del sitio')
                            ->required(),

                        \Filament\Forms\Components\TextInput::make('site_slogan')
                            ->label('Eslogan'),

                        \Filament\Forms\Components\Select::make('site_status')
                            ->options([
                                'activo' => 'Activo',
                                'mantenimiento' => 'Mantenimiento',
                            ])
                            ->default('activo')
                            ->required(),
                    ]),
                \Filament\Forms\Components\Section::make('Contacto')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('site_email')
                            ->email(),

                        \Filament\Forms\Components\TextInput::make('site_phone'),

                        \Filament\Forms\Components\TextInput::make('site_whatsapp'),

                        \Filament\Forms\Components\Textarea::make('site_address')
                            ->rows(3),
                    ]),
                \Filament\Forms\Components\Section::make('Redes sociales')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('site_facebook')
                            ->url(),

                        \Filament\Forms\Components\TextInput::make('site_instagram')
                            ->url(),
                        \Filament\Forms\Components\TextInput::make('site_tiktok')
                            ->url(),

                        \Filament\Forms\Components\TextInput::make('site_youtube')
                            ->url(),
                    ]),

                \Filament\Forms\Components\Section::make('Identidad visual')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('site_logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings'),

                        \Filament\Forms\Components\FileUpload::make('site_favicon')
                            ->image()
                            ->disk('public')
                            ->directory('settings'),
                    ]),
                \Filament\Forms\Components\Section::make('SEO')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('site_meta_title')
                            ->label('Meta título')
                            ->maxLength(60)
                            ->helperText('Recomendado: máximo 60 caracteres.'),

                        \Filament\Forms\Components\Textarea::make('site_meta_description')
                            ->label('Meta descripción')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('Recomendado: máximo 160 caracteres.'),

                        \Filament\Forms\Components\FileUpload::make('site_og_image')
                            ->label('Imagen para compartir')
                            ->image()
                            ->disk('public')
                            ->directory('settings/seo')
                            ->helperText('Imagen usada al compartir el sitio en redes sociales.'),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('site_logo')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('site_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('site_email'),

                Tables\Columns\TextColumn::make('site_status')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('settings.manage');
    }


    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('settings.manage');
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->user()->can('settings.manage');
    }
}
