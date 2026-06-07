<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'set_key',
        'set_value',
        'set_type',
        'set_group',
    ];
}
