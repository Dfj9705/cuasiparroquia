<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'gallery_id',
        'git_title',
        'git_image',
        'git_order',
        'git_status',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
