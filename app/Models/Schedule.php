<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'title',
        'type',
        'date',
        'time',
        'location',
    ];
    protected $casts = [
        'date' => 'date',      // otomatis jadi Carbon (hanya tanggal)
        'time' => 'datetime:H:i', // supaya jadi objek waktu (jam dan menit)
    ];
}