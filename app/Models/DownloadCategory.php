<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadCategory extends Model
{
    protected $fillable = [
        'dcat_name',
        'dcat_slug',
        'dcat_description',
        'dcat_status',
    ];

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('download_categories.view');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('download_categories.create');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('download_categories.update');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('download_categories.delete');
    }
}
