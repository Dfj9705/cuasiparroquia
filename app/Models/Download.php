<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'download_category_id',
        'user_id',
        'dow_title',
        'dow_slug',
        'dow_description',
        'dow_file',
        'dow_status',
        'dow_published_at',
    ];

    protected $casts = [
        'dow_published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
