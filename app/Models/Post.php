<?php

namespace App\Models;

use App\Models\Enums\PostStatus;
use App\Models\Traits\HasGallery;
use App\Models\Traits\HasJsonColumns;
use App\Models\Traits\HasSEO;
use App\Models\Traits\HasUserstamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Builder;
use Kodeine\Metable\Metable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use HasUserstamps;
    use HasJsonColumns;
    use HasSEO;
    use HasGallery;

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
        'image',
        'gallery_data',
        'note',
        'seo_data',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => PostStatus::class,
        'gallery_data' => 'array',
        'seo_data' => 'json'
    ];

    protected $disableFluentMeta = true;

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (is_null($post->published_at)) {
                $post->published_at = now();
            }
            $post->published_by = auth()->user()->id;
        });
    }

    /*---------- Relationships ---------- */

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category')
            ->withPivot(['id', 'is_primary']);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(PostTag::class, 'taggable');
    }

    /*---------- Scopes ---------- */

    public function scopeTableList(Builder $query)
    {
        return $query->select([
            'id',
            'title',
            'slug',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
            'published_by',
            'published_at',
            'note',
        ]);
    }

    public function scopeLatestId(Builder $query)
    {
        return $query->orderBy('id', 'desc');
    }

    /*---------- Methods ---------- */

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }
}
