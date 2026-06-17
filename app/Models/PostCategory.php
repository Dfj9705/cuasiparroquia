<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'pcat_name',
        'pcat_slug',
        'pcat_description',
        'pcat_status',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // PostCategoryResource
    public static function canViewAny(): bool
    {
        return auth()->user()->can('post_categories.view');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('post_categories.create');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('post_categories.update');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('post_categories.delete');
    }
}
