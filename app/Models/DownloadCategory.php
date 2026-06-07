<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadCategory extends Model
{
    protected $fillable = [
        'dca_name',
        'dca_slug',
        'dca_description',
        'dca_status',
    ];

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
