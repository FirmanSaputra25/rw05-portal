<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'date',
        'time',
        'description',
        'location',
    ];

    // Kalau date harus diperlakukan sebagai Carbon instance:
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
}
