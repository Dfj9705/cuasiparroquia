<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_category_id',
        'user_id',
        'post_title',
        'post_slug',
        'post_summary',
        'post_content',
        'post_image',
        'post_status',
        'post_published_at',
        'post_order',
        'post_meta_title',
        'post_meta_description',
    ];

    protected $casts = [
        'post_published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('post_status', 'publicado')
            ->where(function ($query) {
                $query->whereNull('post_published_at')
                    ->orWhere('post_published_at', '<=', now());
            });
    }
}
