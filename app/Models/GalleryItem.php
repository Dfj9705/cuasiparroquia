<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'gallery_id',
        'gitem_title',
        'gitem_description',
        'gitem_image',
        'gitem_order',
        'gitem_status',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
