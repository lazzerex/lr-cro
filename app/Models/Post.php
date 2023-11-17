<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kodeine\Metable\Metable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use HasSEO;
    use Metable;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'status',
        'comment_status',
        'comment_count',
        'published_at',
        'image'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $disableFluentMeta = true;

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (is_null($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    /*---------- Relationships ---------- */

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category')
            ->withPivot(['id', 'is_primary']);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(PostTag::class, 'taggable');
    }

    // public function metas(): HasMany
    // {
    //     return $this->hasMany(PostMeta::class);
    // }

    /*---------- Methods ---------- */

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }
}
