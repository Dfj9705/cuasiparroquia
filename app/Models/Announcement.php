<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'ann_title',
        'ann_slug',
        'ann_description',
        'ann_image',
        'ann_status',
        'ann_starts_at',
        'ann_ends_at',
        'ann_priority',
    ];

    protected $casts = [
        'ann_starts_at' => 'datetime',
        'ann_ends_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query
            ->where('ann_status', 'publicado')
            ->where(function ($query) {
                $query->whereNull('ann_starts_at')
                    ->orWhere('ann_starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ann_ends_at')
                    ->orWhere('ann_ends_at', '>=', now());
            });
    }
}
