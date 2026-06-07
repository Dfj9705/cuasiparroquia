<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'pca_name',
        'pca_slug',
        'pca_description',
        'pca_status',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
