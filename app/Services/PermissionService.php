<?php
namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    public function getAsTreeOptions()
    {
        $permissions = Permission::query()
            ->with('children')
            ->whereNull('parent_id')
            ->orderBy('display_order')
            ->get();

        $tree = $permissions->mapWithKeys(function (Permission $item, int $key) {
            return [$item->description => $item->children->pluck('description', 'id')->all()];
        });

        return $tree->all();
    }
}