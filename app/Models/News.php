<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',   // tambahkan ini
        'content',
        'author',
        'image',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}