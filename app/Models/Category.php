<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'count',
        'display_order',
    ];

    /*---------- Relationships ---------- */

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_category')
            ->withPivot(['id', 'is_primary']);
    }
}
