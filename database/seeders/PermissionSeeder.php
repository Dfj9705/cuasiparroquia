<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'posts.view',
            'posts.create',
            'posts.update',
            'posts.delete',

            'announcements.view',
            'announcements.create',
            'announcements.update',
            'announcements.delete',

            'downloads.view',
            'downloads.create',
            'downloads.update',
            'downloads.delete',

            'galleries.view',
            'galleries.create',
            'galleries.update',
            'galleries.delete',

            'contacts.view',

            'settings.manage',

            'users.manage',

            'roles.manage',

            'post_categories.view',
            'post_categories.create',
            'post_categories.update',
            'post_categories.delete',

            'download_categories.view',
            'download_categories.create',
            'download_categories.update',
            'download_categories.delete',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $role = Role::findByName('Super Admin');

        $role->syncPermissions(
            Permission::all()
        );
    }
}
