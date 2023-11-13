<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofilo extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'title',
        'slug',
        'excerpt',
        'content',
        'status',
        'comment_status',
        'comment_count',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
