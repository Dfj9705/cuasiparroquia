<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_slogan',
        'site_email',
        'site_phone',
        'site_whatsapp',
        'site_address',
        'site_logo',
        'site_favicon',
        'site_facebook',
        'site_instagram',
        'site_youtube',
        'site_meta_title',
        'site_meta_description',
        'site_status',
    ];
}
