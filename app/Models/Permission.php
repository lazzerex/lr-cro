<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    public function children(): HasMany
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }
}
