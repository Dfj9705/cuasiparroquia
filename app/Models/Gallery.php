<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'gal_title',
        'gal_slug',
        'gal_description',
        'gal_status',
        'gal_published_at',
    ];

    protected $casts = [
        'gal_published_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('gal_status', 'publicado')
            ->where(function ($query) {
                $query->whereNull('gal_published_at')
                    ->orWhere('gal_published_at', '<=', now());
            });
    }
}
