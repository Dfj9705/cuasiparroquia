<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'con_name',
        'con_email',
        'con_phone',
        'con_subject',
        'con_message',
        'con_status',
        'con_read_at',
    ];

    protected $casts = [
        'con_read_at' => 'datetime',
    ];
}
