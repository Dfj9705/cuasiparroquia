<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'ann_title',
        'ann_slug',
        'ann_content',
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
}
