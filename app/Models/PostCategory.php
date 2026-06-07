<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'pcat_name',
        'pcat_slug',
        'pcat_description',
        'pcat_status',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
