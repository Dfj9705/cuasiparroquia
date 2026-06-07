<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_category_id',
        'user_id',
        'pos_title',
        'pos_slug',
        'pos_excerpt',
        'pos_content',
        'pos_image',
        'pos_status',
        'pos_published_at',
    ];

    protected $casts = [
        'pos_published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
