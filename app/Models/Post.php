<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
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

    /*---------- Relationships ---------- */

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category')
            ->withPivot(['id', 'is_primary']);
    }
}
