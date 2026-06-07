<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'download_category_id',
        'user_id',
        'down_title',
        'down_slug',
        'down_description',
        'down_file',
        'down_file_size',
        'down_file_type',
        'down_status',
        'down_published_at',
    ];

    protected $casts = [
        'down_published_at' => 'datetime',
        'down_expires_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('down_status', 'publicado')
            ->where(function ($query) {
                $query->whereNull('down_published_at')
                    ->orWhere('down_published_at', '<=', now());
            });
    }
}
