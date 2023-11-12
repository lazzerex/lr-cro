<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'list' => 'Xem',
            'create' => 'Tạo',
            'edit' => 'Sửa',
            'edit_any' => 'Sửa toàn bộ',
            'delete' => 'Xoá',
            'force_delete' => 'Xoá hoàn toàn',
            'restore' => 'Khôi phục',
        ];

        /*---------- Hệ thống ---------- */
        $system = Permission::create([
            'name' => 'system',
            'description' => 'Hệ thống',
            'guard_name' => 'web',
            'display_order' => 0,
        ]);

        $system->children()->saveMany([
            new Permission([
                'name' => 'system.access-admin',
                'description' => 'Truy cập admin',
                'guard_name' => 'web',
                'display_order' => 0,
            ]),

            new Permission([
                'name' => 'system.settings',
                'description' => 'Cấu hình hệ thống',
                'guard_name' => 'web',
                'display_order' => 1,
            ]),

            new Permission([
                'name' => 'system.view_log',
                'description' => 'Xem log',
                'guard_name' => 'web',
                'display_order' => 2,
            ]),
        ]);

        /*---------- Quản lý tài khoản, phân quyền ---------- */

        $auth = Permission::create([
            'name' => 'auth',
            'description' => 'Tài khoản người dùng',
            'guard_name' => 'web',
            'display_order' => 1
        ]);

        $auth->children()->saveMany([
            new Permission([
                'name' => 'auth.users.manage',
                'description' => 'Quản lý users',
                'guard_name' => 'web',
                'display_order' => 0,
            ]),

            new Permission([
                'name' => 'auth.roles.manage',
                'description' => 'Quản lý roles',
                'guard_name' => 'web',
                'display_order' => 1,
            ]),
        ]);

        /*---------- Category ---------- */

        $category = Permission::create([
            'name' => 'category',
            'description' => 'Category',
            'guard_name' => 'web',
            'display_order' => 2
        ]);

        $categoryPermissions = collect(['list', 'create', 'edit', 'delete'])->map(function ($item, $key) use ($actions) {
            $description = $actions[$item];
            return new Permission([
                'name' => 'category.'.$item,
                'description' => $description." chuyên mục",
                'display_order' => $key,
                'guard_name' => 'web',
            ]);
        });

        $category->children()->saveMany($categoryPermissions);

        /*---------- Post tag ---------- */

        $postTag = Permission::create([
            'name' => 'post-tag',
            'description' => 'Tag bài viết',
            'guard_name' => 'web',
            'display_order' => 2
        ]);

        $postTagPermissions = collect(['list', 'create', 'edit', 'delete'])->map(function ($item, $key) use ($actions) {
            $description = $actions[$item];
            return new Permission([
                'name' => 'post-tag.'.$item,
                'description' => $description." tag bài viết",
                'display_order' => $key,
                'guard_name' => 'web',
            ]);
        });

        $postTag->children()->saveMany($postTagPermissions);

        /*---------- Post ---------- */

        $post = Permission::create([
            'name' => 'post',
            'description' => 'Bài viết',
            'guard_name' => 'web',
            'display_order' => 2
        ]);

        $postPermissions = collect([
            'list',
            'create',
            'edit',
            'edit_any',
            'delete',
            'force_delete',
            'restore',
        ])->map(function ($item, $key) use ($actions) {
            $description = $actions[$item];
            return new Permission([
                'name' => 'post.'.$item,
                'description' => $description." bài viết",
                'display_order' => $key,
                'guard_name' => 'web',
            ]);
        });

        $post->children()->saveMany($postPermissions);

        /*---------- Roles ---------- */

        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Editor',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Author',
            'guard_name' => 'web',
        ]);
    }
}
