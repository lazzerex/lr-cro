<?php

namespace App\Models;

use App\Models\Enums\TagTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Parental\HasChildren;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;
    use HasChildren;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'display_order',
    ];

    protected $casts = [
        'type' => TagTypes::class
    ];

    protected $childTypes = [
        'post-tag' => PostTag::class,
        'portfolio-tag' => PortfolioTag::class,
    ];

    /*---------- Relationships ---------- */


    /*---------- Scopes ---------- */

    public function scopePostTags(Builder $query)
    {
        return $query->where('type', TagTypes::PostTag->value);
    }

    public function scopePortfolioTags(Builder $query)
    {
        return $query->where('type', TagTypes::PortofiloTag->value);
    }

    /*---------- Methods ---------- */

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }
}
