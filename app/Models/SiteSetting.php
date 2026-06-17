<?php

namespace App\Models;

use Cache;
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
        'site_og_image',
        'site_header_image',
        'site_status',
    ];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('site_settings'));
        static::deleted(fn() => Cache::forget('site_settings'));
        static::updated(fn() => Cache::forget('site_settings'));
    }
}
