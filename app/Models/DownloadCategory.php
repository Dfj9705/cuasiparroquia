<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadCategory extends Model
{
    protected $fillable = [
        'dcat_name',
        'dcat_slug',
        'dcat_description',
        'dcat_status',
    ];

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
